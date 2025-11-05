<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;
  protected $primaryKey = 'category_id';
  protected $fillable = [
    'name',
    'group_type_id',
  ];
  public $timestamps = false;

  public function budgets()
  {
    return $this->hasMany(Budget::class, 'category_id', 'category_id');
  }
  public function recurringTransactions()
  {
    return $this->hasMany(RecurringTransaction::class, 'category_id', 'category_id');
  }
  public function transactions()
  {
    return $this->hasMany(Transaction::class, 'category_id', 'category_id');
  }
  public function debts()
  {
    return $this->hasMany(Debt::class, 'category_id', 'category_id');
  }
  public function groupType()
  {
    return $this->belongsTo(GroupType::class, 'group_type_id', 'group_type_id');
  }
  public function getIdAttribute()
  {
    return $this->category_id;
  }
}
