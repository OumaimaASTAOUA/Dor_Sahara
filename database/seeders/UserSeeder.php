<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run(): void
{
    User::create([
        'name' => 'Admin Principal',
        'email' => 'admin@example.com',
        'password' => Hash::make('admin123'),
        'phone' => '0600000000',
        'payment_method' => 1,
        'role' => 'admin',
        'is_admin' => true,
        'status' => true,
    ]);

}
}
