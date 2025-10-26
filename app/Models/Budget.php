<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Helpers\Helper;

class Budget extends Model
{
  use HasFactory;
  protected $primaryKey = 'budget_id';
  public $timestamps = false;
  protected $fillable = [
    'user_id',
    'category_id',
    'amount',
    'start_date',
    'end_date'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
  public function getIdAttribute()
  {
    return $this->budget_id;
  }
  public function getFormattedAmountAttribute()
  {
    $rate = Helper::getExchangeRate($this->user->currency);
    return number_format($this->amount * $rate, 0, ',', '.') . ' ' . $this->user->currency;
  }
  public function getFormattedStartDateAttribute()
  {
    return Carbon::parse($this->start_date)->format('d/m/Y');
  }
  public function getFormattedEndDateAttribute()
  {
    return Carbon::parse($this->end_date)->format('d/m/Y');
  }
  public function getRemainingValueAttribute()
{
    // Get total transactions for this budget's category & date range
    $totalTransactions = Transaction::join('wallets', 'transactions.wallet_id', '=', 'wallets.wallet_id')
        ->where('transactions.category_id', $this->category_id)
        ->where('wallets.user_id', $this->user_id)
        ->whereBetween('transactions.date', [$this->start_date, $this->end_date])
        ->sum('transactions.amount');

    // Return remaining amount
    return $this->amount - $totalTransactions;
}

  public function getProgressAttribute()
  {
    $spent = $this->amount - $this->getRemainingValueAttribute();
    return min(($spent / $this->amount) * 100, 100);
  }

  public function getFormattedRemainingValueAttribute()
  {
    $rate = Helper::getExchangeRate($this->user->currency);
    $remainingInLocalCurrency = $this->getRemainingValueAttribute() * $rate;
    return number_format($remainingInLocalCurrency, 0, ',', '.') . ' ' . $this->user->currency;
  }
}
