<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('chatbot_logs', function (Blueprint $table) {
      $table->engine = 'InnoDB'; // đảm bảo hỗ trợ foreign key
      $table->id('log_id');
      
      $table->unsignedBigInteger('user_id'); // ✅ sửa lại cho đúng kiểu
      $table->text('message');
      $table->boolean('is_bot');
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->dateTime('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('chatbot_logs');
  }
};
