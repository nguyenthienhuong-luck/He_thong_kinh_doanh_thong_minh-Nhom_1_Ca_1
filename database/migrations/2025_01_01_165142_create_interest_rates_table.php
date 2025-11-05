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
    Schema::create('interest_rates', function (Blueprint $table) {
       $table->increments('rate_id'); 
      $table->float('rate_percentage');
      $table->decimal('amount', 10, 2);
      $table->dateTime('start_date');
      $table->dateTime('end_date')->nullable();
      $table->enum('interest_type', ['Lãi đơn ', 'Lãi kép']);
      $table->enum('time_period', ['Hàng tuần', 'Hàng tháng', 'Hàng quý', 'Nửa năm', 'Hàng năm']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('interest_rates');
  }
};
