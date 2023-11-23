<?php

namespace Database\Seeders;

use App\Models\VehicleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peopleCategory = VehicleCategory::create([
            'id' => 1,
            'name' => "PEOPLE",
        ]);

        $goodsCategory = VehicleCategory::create([
            'id' => 2,
            'name' => "GOODS",
        ]);
    }
}
