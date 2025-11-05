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
    Schema::create('debts', function (Blueprint $table) {
     $table->increments('debt_id');
      $table->unsignedInteger('user_id');
      $table->decimal('amount', 10, 2)->default(0);
      $table->string('lender_borrower_name');
      $table->unsignedInteger('category_id');
      $table->date('date');
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('debts');
  }
};
