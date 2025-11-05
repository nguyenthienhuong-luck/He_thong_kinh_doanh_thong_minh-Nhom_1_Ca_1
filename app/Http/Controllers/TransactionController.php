<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Wallet;

class TransactionController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'amount' => 'required|numeric|min:0',
      'category_id' => 'required|exists:categories,category_id',
      'note' => 'nullable|string|max:255',
      'date' => 'required|date',
      'wallet_id' => 'required|exists:wallets,wallet_id',
    ]);

    // Get the user's currency
    $userCurrency = Auth::user()->currency;

    // Get the exchange rate from the user's currency to USD
    $rate = $this->getExchangeRate($userCurrency, 'USD');

    // Convert the amount to USD
    $amountInUSD = $request->input('amount') / $rate;

    // Create the transaction
    try {
      DB::beginTransaction();
      // Get category's group type
      $category = Category::findOrFail($request->input('category_id'));
      $groupType = $category->groupType;

      // Get wallet and current balance
      $wallet = Wallet::findOrFail($request->input('wallet_id'));
      $currentBalance = $wallet->balance;

      // Convert amount to USD
      $amountInUSD = $request->input('amount') / $rate;

      // Update wallet balance based on group type
      if ($groupType->name === 'Khoản thu') {
        $wallet->balance = $currentBalance + $amountInUSD;
      } else {
        // For 'Khoản chi' and 'Khoản vay'
        $wallet->balance = $currentBalance - $amountInUSD;
      }

      $wallet->save();

      Transaction::create([
        'amount' => $amountInUSD,
        'category_id' => $request->input('category_id'),
        'note' => $request->input('note', ''),
        'date' => $request->input('date'),
        'wallet_id' => $request->input('wallet_id'),
      ]);

      DB::commit();

      // Redirect or return response (you can adjust this based on your needs)
      return redirect()->back()->with('message', 'Thêm giao dịch thành công!')->with('type', 'success');
    } catch (\Exception $e) {
      Log::error('Error in TransactionController@store', ['error' => $e->getMessage()]);

      DB::rollBack();
      return redirect()->back()->with('message', 'Không tạo được giao dịch. Vui lòng thử lại')->with('type', 'danger');
    }
  }
  public function update(Request $request, $id)
  {
    // Validate input
    $validator = Validator::make($request->all(), [
      'amount' => 'required|numeric|min:0',
      'category_id' => 'required|exists:categories,category_id',
      'note' => 'nullable|string|max:255',
      'date' => 'required|date',
      'wallet_id' => 'required|exists:wallets,wallet_id',
    ]);


    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => 'Validation failed',
        'errors' => $validator->errors()
      ], 422);
    }

    try {
      DB::beginTransaction();

      // Get current transaction
      $transaction = Transaction::findOrFail($id);
      $oldAmount = $transaction->amount;
      $oldWallet = $transaction->wallet;
      $oldCategory = $transaction->category;

      // Get new data
      $newWallet = Wallet::findOrFail($request->wallet_id);
      $newCategory = Category::findOrFail($request->category_id);

      // Get exchange rate
      $userCurrency = Auth::user()->currency;
      $rate = $this->getExchangeRate($userCurrency, 'USD');
      $newAmountUSD = $request->amount / $rate;

      // Update old wallet balance
      if ($oldCategory->groupType->name === 'Khoản thu') {
        $oldWallet->balance -= $oldAmount;
      } else {
        $oldWallet->balance += $oldAmount;
      }
      $oldWallet->save();

      if ($newCategory->groupType->name === 'Khoản thu') {
        $newWallet->balance += $newAmountUSD;
      } else {
        $newWallet->balance -= $newAmountUSD;
      }
      $newWallet->save();

      $transaction->update([
        'amount' => $newAmountUSD,
        'category_id' => $request->category_id,
        'note' => $request->note,
        'date' => $request->date,
        'wallet_id' => $request->wallet_id,
      ]);

      DB::commit();
      return redirect()->back()->with('message', 'Cập nhật giao dịch thành công!')->with('type', 'success');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error in TransactionController@update', ['error' => $e->getMessage()]);
      return redirect()->back()->with('message', 'Không cập nhật được giao dịch. Vui lòng thử lại!')->with('type', 'danger');
    }
  }
  public function destroy($id)
  {
    try {
      DB::beginTransaction();

      // Find transaction
      $transaction = Transaction::findOrFail($id);
      $wallet = $transaction->wallet;
      $amount = $transaction->amount;

      // Update wallet balance based on transaction type
      if ($transaction->groupType->name === 'Khoản chi') {
        $wallet->balance += $amount;
      } else {
        $wallet->balance -= $amount;
      }

      // Save wallet changes
      $wallet->save();

      // Delete transaction
      $transaction->delete();

      DB::commit();
      return redirect()->back()
        ->with('message', 'Xóa giao dịch thành công!')
        ->with('type', 'success');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error in TransactionController@destroy', ['error' => $e->getMessage()]);
      return redirect()->back()
        ->with('message', 'Không xóa được giao dịch. Vui lòng thử lại!')
        ->with('type', 'danger');
    }
  }
  protected function getExchangeRate($fromCurrency, $toCurrency)
  {
    $exchangeRates = [
      'USD' => 1,
      'VND' => 25000,
      'EUR' => 0.96,
    ];

    if ($fromCurrency === $toCurrency) {
      return 1;
    }

    return $exchangeRates[$fromCurrency] / $exchangeRates[$toCurrency];
  }
}
