<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'first_name' => 'Test',
                    'last_name' => 'User',
                    'email' => 'test@user.com',
                    'contact_number' => '09162097072',
                    'home_address' => 'Alaska',
                    'role' => 'user',
                    'password' => Hash::make('qwerty')
                ],
                [
                    'first_name' => 'Test',
                    'last_name' => 'Admin',
                    'email' => 'test@admin.com',
                    'contact_number' => '09162097072',
                    'home_address' => 'Alaska',
                    'role' => 'admin',
                    'password' => Hash::make('qwerty')
                ],
                [
                    'first_name' => 'Test',
                    'last_name' => 'Admin1',
                    'email' => 'test@admin1.com',
                    'contact_number' => '09162097072',
                    'home_address' => 'Alaska',
                    'role' => 'admin',
                    'password' => Hash::make('qwerty')
                ],
            ]
        );
    }
}
