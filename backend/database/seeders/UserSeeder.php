<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin01',
            'password' => Hash::make('admin01'),
            'role_id' => 1,
        ]);

        $approver = User::create([
            'name' => 'Approver',
            'username' => 'approver01',
            'password' => Hash::make('approver01'),
            'role_id' => 2,
        ]);
    }
}
