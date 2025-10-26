<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('debts', function (Blueprint $table) {
      $table->engine = 'InnoDB'; // để chắc chắn hỗ trợ foreign key
      $table->id('debt_id');
      
      $table->unsignedBigInteger('user_id'); // ✅ sửa lại
      $table->unsignedBigInteger('category_id'); // ✅ sửa lại

      $table->decimal('amount', 10, 2)->default(0);
      $table->string('lender_borrower_name');
      $table->date('date');

      // ✅ foreign key
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('debts');
  }
};
