<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use App\Models\Category;

class AddCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert(
            [
                [
                    'name' => 'Pets',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Transporatation',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Rentals',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Farm & Garden',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Real Estate',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Employemment',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
            ]
        );
    }
}
