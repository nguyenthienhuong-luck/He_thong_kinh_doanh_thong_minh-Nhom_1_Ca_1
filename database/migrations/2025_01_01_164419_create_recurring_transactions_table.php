<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('recurring_transactions', function (Blueprint $table) {
      $table->engine = 'InnoDB'; // ✅ đảm bảo hỗ trợ foreign key
      $table->id('recurring_transaction_id');
      $table->unsignedBigInteger('wallet_id');    // ✅ sửa lại cho khớp kiểu
      $table->unsignedBigInteger('category_id');  // ✅ sửa lại cho khớp kiểu
      $table->enum('frequency', ['Hàng ngày', 'Hàng tuần', 'Hàng tháng', 'Hàng năm']);
      $table->date('start_date');
      $table->date('end_date')->nullable();

      $table->foreign('wallet_id')->references('wallet_id')->on('wallets')->onDelete('cascade');
      $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('recurring_transactions');
  }
};
