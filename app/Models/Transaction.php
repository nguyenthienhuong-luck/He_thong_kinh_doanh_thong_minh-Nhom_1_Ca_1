<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Helpers\Helper;

class Transaction extends Model
{
  use HasFactory;
  protected $primaryKey = 'transaction_id';
  public $timestamps = false;

  protected $fillable = [
    'wallet_id',
    'category_id',
    'event_id',
    'amount',
    'date',
    'note',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
  public function groupType()
  {
    return $this->hasOneThrough(
      GroupType::class,
      Category::class,
      'category_id', // Foreign key on Category table...
      'group_type_id', // Foreign key on GroupType table...
      'category_id', // Local key on Transaction table...
      'group_type_id' // Local key on Category table...
    );
  }
  public function event()
  {
    return $this->belongsTo(Event::class, 'event_id', 'event_id');
  }
  public function wallet()
  {
    return $this->belongsTo(Wallet::class, 'wallet_id', 'wallet_id');
  }
  public function getIdAttribute()
  {
    return $this->transaction_id;
  }
  public function getFormattedDateAttribute()
  {
    return Carbon::parse($this->date)->format('d/m/Y');
  }
  public function getAmountValueAttribute()
  {
    $rate = Helper::getExchangeRate($this->wallet->user->currency);
    return $this->amount * $rate;
  }
  public function getFormattedAmountAttribute()
  {
    $rate = Helper::getExchangeRate($this->wallet->user->currency);
    return number_format($this->amount * $rate, 0, ',', '.') . ' ' . $this->wallet->user->currency;
  }
}
