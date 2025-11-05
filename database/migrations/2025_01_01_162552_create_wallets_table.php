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
    Schema::create('wallets', function (Blueprint $table) {
      $table->increments('wallet_id'); 
      $table->unsignedInteger('user_id');
      $table->string('name');
      $table->decimal('balance', 10, 2)->default(0);
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('wallets');
  }
};
