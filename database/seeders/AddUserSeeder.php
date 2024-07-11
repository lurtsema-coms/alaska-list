<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

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
                    'status' => 'ACTIVE',
                    'email' => 'test@user.com',
                    'contact_number' => '09162097072',
                    'home_address' => 'Alaska',
                    'role' => 'seller',
                    'email_verified_at' => Date::now(),
                    'password' => Hash::make('password')
                ],
                [
                    'first_name' => 'Test',
                    'last_name' => 'Admin',
                    'status' => 'ACTIVE',
                    'email' => 'test@admin.com',
                    'contact_number' => '09162097072',
                    'home_address' => 'Alaska',
                    'role' => 'admin',
                    'email_verified_at' => Date::now(),

                    'password' => Hash::make('password')
                ],
                [
                    'first_name' => 'Test',
                    'last_name' => 'Admin1',
                    'status' => 'ACTIVE',
                    'email' => 'test@admin1.com',
                    'contact_number' => '09162097072',
                    'home_address' => 'Alaska',
                    'role' => 'admin',
                    'email_verified_at' => Date::now(),
                    'password' => Hash::make('password')
                ],
                [
                    'first_name' => 'Test',
                    'last_name' => 'Approver',
                    'status' => 'ACTIVE',
                    'email' => 'test@approver.com',
                    'contact_number' => '09162097072',
                    'home_address' => 'Alaska',
                    'role' => 'approver',
                    'email_verified_at' => Date::now(),
                    'password' => Hash::make('password')
                ],
            ]
        );
    }
}
