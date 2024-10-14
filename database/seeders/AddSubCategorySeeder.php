<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use App\Models\SubCategory;

class AddSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::insert(
            [
                [
                    'category_id' => 1,
                    'name' => 'Alaska Land',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Alaska Cabins',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Alaska Housing',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 3,
                    'name' => 'Firearms Parts | Accessories',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 3,
                    'name' => 'Optics | Mounts | Scopes',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 3,
                    'name' => 'Rifles | Pistols | Other Firearms',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Aircraft | Part & Accessories',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => "Auto's",
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'ATV | UTV | Part & Accessories',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'ATV | UTV | Wheels & Tires',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Boats | Part & Accessories',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => "RV's",
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Snowmachines | Part & Accessories',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Trailers',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Archery',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Camping Gear',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Fishing',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Outdoor Clothing',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Outdoor Recreation',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
            ]
        );
    }
}
