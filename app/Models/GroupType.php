<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
  protected $table = 'group_types';
  protected $primaryKey = 'group_type_id';
  protected $fillable = ['name'];
  public $timestamps = false;

  public function categories()
  {
    return $this->hasMany(Category::class, 'group_type_id', 'group_type_id');
  }
  public function getIdAttribute()
  {
    return $this->group_type_id;
  }
}
