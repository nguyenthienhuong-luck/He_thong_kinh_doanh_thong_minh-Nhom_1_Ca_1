<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $walletIds = $user->wallets->pluck('wallet_id')->toArray();

        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();

        // 🔹 Tổng chi tháng này và tháng trước
        $thisExpense = Transaction::whereIn('wallet_id', $walletIds)
            ->whereHas('groupType', fn($q) => $q->where('name', 'Khoản chi'))
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $lastExpense = Transaction::whereIn('wallet_id', $walletIds)
            ->whereHas('groupType', fn($q) => $q->where('name', 'Khoản chi'))
            ->whereBetween('date', [$lastMonthStart, $lastMonthEnd])
            ->sum('amount');

        $pctChange = $lastExpense > 0
            ? round((($thisExpense - $lastExpense) / $lastExpense) * 100, 2)
            : null;

        // 🔹 Chi tiêu theo danh mục (trong tháng này)
        $byCategory = Transaction::whereIn('wallet_id', $walletIds)
            ->whereHas('groupType', fn($q) => $q->where('name', 'Khoản chi'))
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->orderByDesc('total')
            ->get()
            ->map(fn($r) => [
                'category' => $r->category?->name ?? 'Không phân loại',
                'total' => round($r->total, 0)
            ]);

        // 🔹 Thống kê 6 tháng gần nhất
        $months = [];
        $expenses = [];
        $incomes = [];

        for ($i = 5; $i >= 0; $i--) {
            $mStart = $now->copy()->subMonths($i)->startOfMonth();
            $mEnd = $now->copy()->subMonths($i)->endOfMonth();

            $expense = Transaction::whereIn('wallet_id', $walletIds)
                ->whereHas('groupType', fn($q) => $q->where('name', 'Khoản chi'))
                ->whereBetween('date', [$mStart, $mEnd])
                ->sum('amount');

            $income = Transaction::whereIn('wallet_id', $walletIds)
                ->whereHas('groupType', fn($q) => $q->where('name', 'Khoản thu'))
                ->whereBetween('date', [$mStart, $mEnd])
                ->sum('amount');

            $months[] = $mStart->format('m/Y');
            $expenses[] = (float)$expense;
            $incomes[] = (float)$income;
        }

        // 🔹 Gợi ý thông minh
        $suggestions = [];
        if ($pctChange !== null && $pctChange > 10) {
            $topCat = $byCategory->first();
            $suggestions[] = "Chi tiêu tháng này tăng {$pctChange}%. Bạn chi nhiều nhất cho '{$topCat['category']}' ({$topCat['total']} VND).";
        } elseif ($pctChange !== null && $pctChange < -10) {
            $suggestions[] = "Chi tiêu tháng này giảm {$pctChange}%. Bạn đang tiết kiệm tốt, tiếp tục duy trì nhé!";
        } else {
            $suggestions[] = "Chi tiêu ổn định trong tháng này.";
        }

        return response()->json([
            'this_month_expense' => $thisExpense,
            'last_month_expense' => $lastExpense,
            'pct_change' => $pctChange,
            'by_category' => $byCategory,
            'months' => $months,
            'expenses' => $expenses,
            'incomes' => $incomes,
            'suggestions' => $suggestions,
        ]);
    }
}
