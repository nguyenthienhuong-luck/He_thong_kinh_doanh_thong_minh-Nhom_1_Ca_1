<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('transactions', function (Blueprint $table) {
      $table->engine = 'InnoDB'; // đảm bảo hỗ trợ foreign key
      $table->id('transaction_id');
      
      $table->unsignedBigInteger('category_id'); // ✅ sửa lại
      $table->unsignedBigInteger('event_id')->nullable(); // ✅ sửa lại
      $table->unsignedBigInteger('wallet_id'); // ✅ sửa lại

      $table->decimal('amount', 10, 2);
      $table->date('date')->useCurrent();
      $table->string('note')->nullable();

      // ✅ foreign keys
      $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
      $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
      $table->foreign('wallet_id')->references('wallet_id')->on('wallets')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('transactions');
  }
};
