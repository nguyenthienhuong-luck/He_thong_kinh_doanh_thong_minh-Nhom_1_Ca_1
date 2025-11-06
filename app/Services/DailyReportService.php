<?php

namespace App\Services;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DailyReportService
{
    /**
     * Tạo dữ liệu báo cáo thu/chi cho 1 user trong 1 ngày.
     *
     * @param  \App\Models\User  $user
     * @param  \Carbon\Carbon|null  $forDate
     * @return array
     */
    public function buildForUser($user, ?Carbon $forDate = null): array
    {
        $date = $forDate?->copy() ?? now();
        $start = $date->copy()->startOfDay();
        $end   = $date->copy()->endOfDay();

        // Lấy danh sách wallet_id thuộc user (nếu có quan hệ wallets)
        $walletIds = method_exists($user, 'wallets')
            ? $user->wallets()->pluck('wallet_id')->all()
            : [];

        // Truy vấn giao dịch trong ngày
        $query = Transaction::query()
            ->with(['groupType', 'category']) // ⚠️ dùng groupType trực tiếp
            ->whereBetween('date', [$start, $end]);

        if (!empty($walletIds)) {
            $query->whereIn('wallet_id', $walletIds);
        } elseif (Schema()->hasColumn('transactions', 'user_id')) {
            $query->where('user_id', $user->id);
        }

        /** @var Collection $tx */
        $tx = $query->get();

        // ✅ Xác định thu/chi theo group_types.name
        $income = $tx->filter(fn($t) => optional($t->groupType)->name === 'Khoản thu')
                     ->sum(fn($t) => (float)$t->amount);

        $expense = $tx->filter(fn($t) => optional($t->groupType)->name === 'Khoản chi')
                      ->sum(fn($t) => (float)$t->amount);

        $net = $income - $expense;

        // ✅ Gom nhóm theo danh mục
        $byCategory = $tx->groupBy(fn($t) => optional($t->category)->name ?? 'Khác')
            ->map(function ($group) {
                $groupTypeName = optional($group->first()->groupType)->name;
                $guessType = ($groupTypeName === 'Khoản chi') ? 'expense' : 'income';

                return [
                    'count'  => $group->count(),
                    'amount' => $group->sum(fn($t) => (float)$t->amount),
                    'type'   => $guessType,
                ];
            })
            ->sortByDesc('amount');

        return [
            'date'         => $start->toDateString(),
            'income'       => $income,
            'expense'      => $expense,
            'net'          => $net,
            'byCategory'   => $byCategory,
            'transactions' => $tx,
        ];
    }
}

/**
 * Helper nhẹ để check cột (tránh lỗi khi fallback user_id)
 */
if (!function_exists('Schema')) {
    function Schema()
    {
        return app('db.schema');
    }
}
