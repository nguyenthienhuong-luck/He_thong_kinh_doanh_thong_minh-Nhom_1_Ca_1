<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InterestRate extends Model
{
  use HasFactory;
  protected $primaryKey = 'rate_id';
  protected $fillable = [
    'rate_percentage',
    'amount',
    'start_date',
    'end_date',
    'interest_type',
    'time_period',
  ];

  public function getFormattedStartDateAttribute()
  {
    return Carbon::parse($this->start_date)->format('d/m/Y');
  }
  public function getFormattedEndDateAttribute()
  {
    return Carbon::parse($this->end_date)->format('d/m/Y');
  }
  public function getFormattedAmountAttribute()
  {
    return number_format($this->amount, 0, ',', '.') . ' VND';
  }
  public function getFormattedRatePercentageAttribute()
  {
    return number_format($this->rate_percentage, 2) . '%';
  }
  public function setRatePercentageAttribute($value)
  {
    $this->attributes['rate_percentage'] = str_replace('%', '', $value);
  }
  public function getIdAttribute()
  {
    return $this->rate_id;
  }
}
