<?php

namespace App\Services;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DailyReportService
{
    public function buildForUser($user, ?Carbon $forDate = null): array
    {
        $date = $forDate?->copy() ?? now();

        // Lấy giao dịch trong ngày + join category -> groupType
        $query = Transaction::query()
            ->with(['category.groupType'])
            ->whereDate('date', $date->toDateString());

        // Lọc user hoặc ví
        if (Schema()->hasColumn('transactions', 'user_id')) {
            $query->where('user_id', $user->id);
        } elseif (method_exists($user, 'wallets') && $user->wallets()->exists()) {
            $walletIds = $user->wallets()->pluck('wallet_id')->all();
            $query->whereIn('wallet_id', $walletIds);
        }

        /** @var Collection $tx */
        $tx = $query->get();

        // ✅ Đếm số lượng giao dịch theo loại
        $incomeCount = $tx->filter(function ($t) {
            $type = optional(optional($t->category)->groupType)->name;
            return in_array(strtolower(trim($type)), ['khoản thu', 'thu nhập', 'income']);
        })->count();

        $expenseCount = $tx->filter(function ($t) {
            $type = optional(optional($t->category)->groupType)->name;
            return in_array(strtolower(trim($type)), ['khoản chi', 'chi tiêu', 'expense']);
        })->count();

        // ✅ Tổng giao dịch
        $totalCount = $tx->count();

        // ✅ Gom nhóm theo danh mục
        $byCategory = $tx->groupBy(fn($t) => optional($t->category)->name ?? 'Khác')
            ->map(function ($group) {
                $groupTypeName = optional(optional($group->first()->category)->groupType)->name;
                $guessType = str_contains(strtolower($groupTypeName), 'chi') ? 'expense' : 'income';

                return [
                    'count'  => $group->count(),
                    'type'   => $guessType,
                ];
            })
            ->sortByDesc('count');

        // ✅ Log để debug
        \Log::info('Daily report count only', [
            'date' => $date->toDateString(),
            'total' => $totalCount,
            'income_count' => $incomeCount,
            'expense_count' => $expenseCount,
        ]);

        return [
            'date'          => $date->toDateString(),
            'income_count'  => $incomeCount,
            'expense_count' => $expenseCount,
            'total_count'   => $totalCount,
            'byCategory'    => $byCategory,
            'transactions'  => $tx,
        ];
    }
}

if (!function_exists('Schema')) {
    function Schema()
    {
        return app('db.schema');
    }
}
