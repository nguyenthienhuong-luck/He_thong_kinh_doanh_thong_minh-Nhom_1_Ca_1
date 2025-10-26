<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('events', function (Blueprint $table) {
      $table->engine = 'InnoDB'; // ✅ đảm bảo hỗ trợ foreign key
      $table->id('event_id');
      $table->unsignedBigInteger('user_id'); // ✅ đổi sang unsignedBigInteger
      $table->string('name');
      $table->dateTime('date');
      $table->decimal('spent_amount', 10, 2);

      // ✅ định nghĩa ràng buộc khóa ngoại sau cùng
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('events');
  }
};
