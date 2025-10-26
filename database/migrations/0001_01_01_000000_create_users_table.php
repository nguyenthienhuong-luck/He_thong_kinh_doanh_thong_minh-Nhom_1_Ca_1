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
    Schema::create('users', function (Blueprint $table) {
      $table->id('user_id');
      $table->string('name', 100);
      $table->string('email', 40)->unique();
      $table->boolean('isStudent')->default('0');
      $table->boolean('isPremium')->default('0');
      $table->boolean('isAdmin')->default('0');
      $table->boolean('gender'); // 0 - M, 1 - F
      $table->date('birthday');
      $table->string('identify_card')->unique()->nullable();
      $table->string('password');
      $table->datetime('created_at')->useCurrent();
      $table->enum('currency', ['VND', 'USD', 'EUR'])->nullable();
    });
    Schema::create('sessions', function (Blueprint $table) {
      $table->string('id')->primary();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
    Schema::dropIfExists('sessions');
  }
};
