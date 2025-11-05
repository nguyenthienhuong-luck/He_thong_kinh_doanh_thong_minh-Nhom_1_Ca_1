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
    Schema::create('budgets', function (Blueprint $table) {
     $table->increments('budget_id');
      $table->unsignedInteger('user_id');
      $table->unsignedInteger('category_id');
      $table->decimal('amount', 10, 2);
      $table->dateTime('start_date');
      $table->dateTime('end_date')->nullable();
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('budgets');
  }
};
