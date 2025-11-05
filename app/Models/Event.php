<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  use HasFactory;
  protected $primaryKey = 'event_id';
  protected $fillable = [
    'user_id',
    'name',
    'date',
    'spent_amount',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  public function transactions()
  {
    return $this->hasMany(Transaction::class, 'event_id', 'event_id');
  }
  public function getIdAttribute()
  {
    return $this->event_id;
  }
}
