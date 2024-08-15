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
                    'name' => 'Dog',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Dog Breeding',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Cat',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Rabbits',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Birds',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Fish',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Reptiles',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 1,
                    'name' => 'Rodents',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Pickups',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Sport Utility Vehicles',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Automobiles',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Vans | Mini Vans',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Classics | Racing',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Commercial',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Heavy Equipment',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Campers | Toppers',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Motorhomes',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Travel Trailers',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Utility Trailers',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Parts | Accessories',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Tires | Wheels ',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Car Audio',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Motorcycles',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Bicycles',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'All-terrain Vehicles ',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Snowmachines',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 2,
                    'name' => 'Aircraft',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 3,
                    'name' => 'Residential',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 3,
                    'name' => 'Vacation | Lodging',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Hourse',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Livestock',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Poultry | Fowl',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Fresh Products',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Lawn | Garden',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 4,
                    'name' => 'Ag Equipment',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Homes',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Condos | Townhomes',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Commercial',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Lot | Acreage',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 5,
                    'name' => 'Recreational',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
                [
                    'category_id' => 6,
                    'name' => 'Job Opportunities',
                    'created_by' => 2,
                    'created_at' => Date::now(),
                ],
            ]
        );
    }
}
