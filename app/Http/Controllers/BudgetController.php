<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Budget;
use Carbon\Carbon;

class BudgetController extends Controller
{
  private function getNextPeriodDates($currentEnd, $periodType)
  {
    $start = Carbon::parse($currentEnd)->addDay();

    switch ($periodType) {
      case 'week':
        $end = $start->copy()->addDays(6);
        break;
      case 'month':
        $end = $start->copy()->endOfMonth();
        break;
      case 'quarter':
        $end = $start->copy()->addMonths(3)->endOfQuarter();
        break;
      case 'year':
        $end = $start->copy()->endOfYear();
        break;
    }

    return [
      'start_date' => $start->format('Y-m-d'),
      'end_date' => $end->format('Y-m-d')
    ];
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'amount' => 'required|numeric|min:0',
      'start_date' => 'required|date',
      'end_date' => 'required|date|after_or_equal:start_date',
      'wallet_id' => 'required',
      'date' => 'required|in:week,month,quarter,year',
      'repeat_budget' => 'boolean'
    ], [
      'category_id.required' => 'Vui lòng chọn nhóm',
      'amount.required' => 'Vui lòng nhập số tiền',
      'amount.min' => 'Số tiền phải lớn hơn 0',
      'amount.numeric' => 'Số tiền không hợp lệ',
      'date.required' => 'Vui lòng chọn khoảng thời gian',
      'wallet_id.required' => 'Vui lòng chọn ví',
      'end_date.after_or_equal' => 'Ngày kết thúc phải sau ngày bắt đầu'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'errors' => $validator->errors()
      ], 422);
    }


    try {
      DB::beginTransaction();
      Log::info($request->amount);
      // Create current budget
      $rate = $this->getExchangeRate(Auth::user()->currency, 'USD');
      Log::info($rate);
      Budget::create([
        'category_id' => $request->category_id,
        'wallet_id' => $request->wallet_id,
        'amount' => $request->amount / $rate,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'user_id' => Auth::id()
      ]);

      Log::info("Hello");

      // Create repeating budget if enabled
      if ($request->repeat_budget) {
        $nextPeriod = $this->getNextPeriodDates(
          $request->end_date,
          $request->date
        );

        Budget::create([
          'category_id' => $request->category_id,
          'wallet_id' => $request->wallet_id,
          'amount' => $request->amount / $rate,
          'start_date' => $nextPeriod['start_date'],
          'end_date' => $nextPeriod['end_date'],
          'user_id' => Auth::id()
        ]);
      }

      DB::commit();
      return redirect()->back()
        ->with('message', 'Tạo ngân sách thành công!')
        ->with('type', 'success');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error in BudgetController@store', ['error' => $e->getMessage()]);
      return redirect()->back()
        ->with('message', 'Không tạo được ngân sách. Vui lòng thử lại!')
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
