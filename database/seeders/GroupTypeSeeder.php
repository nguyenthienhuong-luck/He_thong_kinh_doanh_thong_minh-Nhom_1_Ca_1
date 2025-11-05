<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroupType;

class GroupTypeSeeder extends Seeder
{
  public function run(): void
  {
    $groupTypes = [
      ['group_type_id' => 1, 'name' => 'Khoản chi'],
      ['group_type_id' => 2, 'name' => 'Khoản thu'],
      ['group_type_id' => 3, 'name' => 'Khoản vay'],
      ['group_type_id' => 4, 'name' => 'Khoản nợ'],
    ];

    foreach ($groupTypes as $groupType) {
      GroupType::create($groupType);
    }
  }
}
