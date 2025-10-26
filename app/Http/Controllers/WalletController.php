<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Models\Transaction;
use App\Models\Wallet;

class WalletController extends Controller
{

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'amount' => 'required'
    ]);

    try {
      DB::beginTransaction();

      // Convert amount to USD
      $userCurrency = Auth::user()->currency;
      $rate = Helper::getExchangeRate($userCurrency);
      $amountUSD = $request->amount / $rate;

      // Create wallet
      $wallet = Wallet::create([
        'name' => $request->name,
        'balance' => $amountUSD,
        'user_id' => Auth::id()
      ]);

      // Create initial balance transaction
      $categoryId = $amountUSD >= 0 ? 25 : 26; // 25=Initial Balance Income, 26=Initial Balance Expense

      Transaction::create([
        'wallet_id' => $wallet->id,
        'category_id' => $categoryId,
        'amount' => abs($amountUSD),
        'date' => now(),
        'note' => 'Người dùng tạo ví'
      ]);

      DB::commit();
      return redirect()->back()
        ->with('message', 'Cập nhật ví thành công!')
        ->with('type', 'success')->withStatus(200);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error in WalletController@store', ['error' => $e->getMessage()]);
      return redirect()->back()
        ->with('message', 'Không tạo được ví. Vui lòng thử lại!')
        ->with('type', 'danger')->withStatus(500);
    }
  }
  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'amount' => 'required|numeric|min:0',
    ]);

    try {
      DB::beginTransaction();

      $wallet = Wallet::findOrFail($id);
      $currentBalance = $wallet->balance;

      // Convert new amount to USD
      $userCurrency = Auth::user()->currency;
      $rate = $this->getExchangeRate($userCurrency, 'USD');
      $newBalanceUSD = $request->amount / $rate;
      Log::info('Hello', [$wallet]);
      

      // Create balance adjustment transaction
      if ($newBalanceUSD != $currentBalance) {
        $adjustmentAmount = abs($newBalanceUSD - $currentBalance);
        $categoryId = ($newBalanceUSD > $currentBalance) ? 25 : 26; // 99=Income, 100=Expense

        Transaction::create([
          'wallet_id' => $wallet->id,
          'category_id' => $categoryId,
          'amount' => $adjustmentAmount,
          'date' => now(),
          'note' => 'Người dùng điều chỉnh số dư'
        ]);
      }

      // Update wallet
      $wallet->update([
        'name' => $request->name,
        'balance' => $newBalanceUSD
      ]);

      DB::commit();
      return redirect()->back()
        ->with('message', 'Cập nhật ví thành công!')
        ->with('type', 'success');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error updating wallet', ['error' => $e->getMessage()]);
      return redirect()->back()
        ->with('message', 'Không cập nhật được ví. Vui lòng thử lại!')
        ->with('type', 'danger');
    }
  }
  public function destroy($id)
  {
    try {
      DB::beginTransaction();

      $wallet = Wallet::findOrFail($id);

      // Delete related transactions first
      Transaction::where('wallet_id', $wallet->id)->delete();

      // Delete wallet
      $wallet->delete();

      DB::commit();
      return redirect()->back()
        ->with('message', 'Xóa ví thành công!')
        ->with('type', 'success');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error in WalletController@destroy', ['error' => $e->getMessage()]);
      return redirect()->back()
        ->with('message', 'Không xóa được ví. Vui lòng thử lại!')
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
