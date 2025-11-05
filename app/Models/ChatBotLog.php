<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBotLog extends Model
{
  protected $table = 'chatbot_logs';
  protected $primaryKey = 'log_id';
  public $timestamps = false;
  protected $fillable = [
    'user_id',
    'message',
    'is_bot',
    'created_at',
  ];
}
