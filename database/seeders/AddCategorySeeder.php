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
                    'name' => 'Alaska Real Estate',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => ' Recreational Property',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Firearms',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Outdoor Transportation',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'name' => 'Sporting Goods',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],

            ]
        );
    }
}
