<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Wallet extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $primaryKey = 'wallet_id';
  protected $fillable = [
    'user_id',
    'name',
    'balance',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function transactions()
  {
    return $this->hasMany(Transaction::class, 'wallet_id', 'wallet_id');
  }
  protected function getExchangeRate($toCurrency)
  {
    $exchangeRates = [
      'USD' => 1,
      'VND' => 25000,
      'EUR' => 0.96,
    ];
    if ($toCurrency === 'USD') {
      return 1;
    }

    return 1 * $exchangeRates[$toCurrency];
  }
  public function getFormattedBalanceAttribute()
  {
    $rate = Helper::getExchangeRate($this->user->currency);
    return number_format($this->balance * $rate, 0, ',', '.') . ' ' . $this->user->currency;
  }
  public function getIdAttribute()
  {
    return $this->wallet_id;
  }
  public function getBalanceAfterConvertAttribute()
  {
    $rate = $this->getExchangeRate($this->user->currency);
    return $this->balance * $rate;
  }
}
