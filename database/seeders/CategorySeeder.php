<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    $categories = [
      ['category_id' => 1, 'name' => 'Ăn uống', 'group_type_id' => 1, 'icon' => '<i class="fas fa-utensils"></i>'],
      ['category_id' => 2, 'name' => 'Hóa đơn & Tiện ích', 'group_type_id' => 1, 'icon' => '<i class="fas fa-receipt"></i>'],
      ['category_id' => 3, 'name' => 'Mua sắm', 'group_type_id' => 1, 'icon' => '<i class="fas fa-shopping-cart"></i>'],
      ['category_id' => 4, 'name' => 'Gia đình', 'group_type_id' => 1, 'icon' => '<i class="fas fa-home"></i>'],
      ['category_id' => 5, 'name' => 'Di chuyển', 'group_type_id' => 1, 'icon' => '<i class="fas fa-car"></i>'],
      ['category_id' => 6, 'name' => 'Sức khỏe', 'group_type_id' => 1, 'icon' => '<i class="fas fa-heartbeat"></i>'],
      ['category_id' => 7, 'name' => 'Giáo dục', 'group_type_id' => 1, 'icon' => '<i class="fas fa-graduation-cap"></i>'],
      ['category_id' => 8, 'name' => 'Giải trí', 'group_type_id' => 1, 'icon' => '<i class="fas fa-laugh-beam"></i>'],
      ['category_id' => 9, 'name' => 'Quà tặng & Quyên góp', 'group_type_id' => 1, 'icon' => '<i class="fas fa-gift"></i>'],
      ['category_id' => 10, 'name' => 'Bảo hiểm', 'group_type_id' => 1, 'icon' => '<i class="fas fa-shield-alt"></i>'],
      ['category_id' => 11, 'name' => 'Đầu tư', 'group_type_id' => 1, 'icon' => '<i class="fas fa-chart-line"></i>'],
      ['category_id' => 12, 'name' => 'Các chi phí khác', 'group_type_id' => 1, 'icon' => '<i class="fas fa-money-check-alt"></i>'],
      ['category_id' => 13, 'name' => 'Tiền chuyển đi', 'group_type_id' => 1, 'icon' => '<i class="fas fa-exchange-alt"></i>'],
      ['category_id' => 14, 'name' => 'Trả lãi', 'group_type_id' => 1, 'icon' => '<i class="fas fa-credit-card"></i>'],
      ['category_id' => 15, 'name' => 'Chưa phân loại', 'group_type_id' => 1, 'icon' => '<i class="fas fa-question-circle"></i>'],
      ['category_id' => 16, 'name' => 'Lương', 'group_type_id' => 2, 'icon' => '<i class="fas fa-wallet"></i>'],
      ['category_id' => 17, 'name' => 'Thu nhập khác', 'group_type_id' => 2, 'icon' => '<i class="fas fa-hand-holding-usd"></i>'],
      ['category_id' => 18, 'name' => 'Tiền chuyển đến', 'group_type_id' => 2, 'icon' => '<i class="fas fa-exchange-alt"></i>'],
      ['category_id' => 19, 'name' => 'Thu lãi', 'group_type_id' => 2, 'icon' => '<i class="fas fa-coins"></i>'],
      ['category_id' => 20, 'name' => 'Chưa phân loại', 'group_type_id' => 2, 'icon' => '<i class="fas fa-question-circle"></i>'],
      ['category_id' => 21, 'name' => 'Cho vay', 'group_type_id' => 3, 'icon' => '<i class="fas fa-hand-holding-usd"></i>'],
      ['category_id' => 22, 'name' => 'Đi vay', 'group_type_id' => 3, 'icon' => '<i class="fas fa-money-bill-wave"></i>'],
      ['category_id' => 23, 'name' => 'Trả nợ', 'group_type_id' => 4, 'icon' => '<i class="fas fa-exclamation-circle"></i>'],
      ['category_id' => 24, 'name' => 'Thu nợ', 'group_type_id' => 4, 'icon' => '<i class="fas fa-handshake"></i>'],
      ['category_id' => 25, 'name' => 'Điều chỉnh số dư tăng', 'group_type_id' => 2, 'icon' => '<i class="fas fa-arrow-up"></i>'],
      ['category_id' => 26, 'name' => 'Điều chỉnh số dư giảm', 'group_type_id' => 1, 'icon' => '<i class="fas fa-arrow-down"></i>'],
    ];

    foreach ($categories as $category) {
      Category::create($category);
    }
  }
}
