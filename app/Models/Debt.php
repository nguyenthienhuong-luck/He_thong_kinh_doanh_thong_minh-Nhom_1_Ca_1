<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Debt extends Model
{
  use HasFactory;
  protected $primaryKey = 'debt_id';
  protected $fillable = [
    'user_id',
    'amount',
    'lender_borrower_name',
    'category_id',
    'date',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'category_id');
  }
  public function getFormattedAmountAttribute()
  {
    return number_format($this->amount, 0, ',', '.') . ' VND';
  }
  public function getFormattedDateAttribute()
  {
    return Carbon::parse($this->date)->format('d/m/Y');
  }
  public function getIdAttribute()
  {
    return $this->debt_id;
  }
}
