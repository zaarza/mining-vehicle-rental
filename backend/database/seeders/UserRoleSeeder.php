<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = UserRole::create([
            'id' => 1,
            'name' => 'admin'
        ]);

        $admin = UserRole::create([
            'id' => 2,
            'name' => 'approver'
        ]);
    }
}
