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
    Schema::create('events', function (Blueprint $table) {
      $table->increments('event_id');
      $table->unsignedInteger('user_id');
      $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
      $table->string('name');
      $table->dateTime('date');
      $table->decimal('spent_amount', 10, 2);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('events');
  }
};
