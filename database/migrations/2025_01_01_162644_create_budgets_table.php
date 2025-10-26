<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('budgets', function (Blueprint $table) {
      $table->id('budget_id');
      $table->unsignedBigInteger('user_id');      // ✅ sửa
      $table->unsignedBigInteger('category_id');  // ✅ sửa
      $table->decimal('amount', 10, 2);
      $table->dateTime('start_date');
      $table->dateTime('end_date')->nullable();

      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('budgets');
  }
};
