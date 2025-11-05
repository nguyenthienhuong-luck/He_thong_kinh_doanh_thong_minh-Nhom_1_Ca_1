<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RecurringTransaction extends Model
{
  use HasFactory;
  protected $primaryKey = 'recurring_transaction_id';
  protected $fillable = [
    'wallet_id',
    'category_id',
    'frequency',
    'start_date',
    'end_date',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
  public function getFormattedStartDateAttribute()
  {
    return Carbon::parse($this->start_date)->format('d/m/Y');
  }
  public function getFormattedEndDateAttribute()
  {
    return Carbon::parse($this->end_date)->format('d/m/Y');
  }
  public function getIdAttribute()
  {
    return $this->recurring_transaction_id;
  }
}
