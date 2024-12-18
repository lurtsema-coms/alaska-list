<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AddUserSeeder::class);
        $this->call(AddCategorySeeder::class);
        $this->call(AddSubCategorySeeder::class);
        $this->call(AddAdvertisingPlan::class);
    }
}
