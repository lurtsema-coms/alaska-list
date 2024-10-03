<?php

namespace Database\Seeders;

use App\Models\AdvertisingPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddAdvertisingPlan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdvertisingPlan::insert(
            [
                [
                    'name' => '7 Days',
                    'description' => 'A quick boost to kickstart visibility.',
                    'duration_days' => 7,
                    'cost' => 3.99,
                    'price_id' => 'price_1Q5tm9CsTn7FILMRcMDRaWFE'
                ],
                [
                    'name' => '30 Days',
                    'description' => 'Gain sustained exposure to attract more customers.',
                    'duration_days' => 30,
                    'cost' => 4.99,
                    'price_id' => 'price_1Q5tmlCsTn7FILMRKvC8c211'
                ],
                [
                    'name' => '60 Days',
                    'description' => 'A long-term boost for ongoing visibility and engagement',
                    'duration_days' => 60,
                    'cost' => 6.99,
                    'price_id' => 'price_1Q5tnJCsTn7FILMRjtIscRGy'
                ],
                [
                    'name' => '90 Days',
                    'description' => 'The best value for maximizing your reach and presence over an extended period.',
                    'duration_days' => 90,
                    'cost' => 8.99,
                    'price_id' => 'price_1Q5to9CsTn7FILMRmsAfysh2'
                ],
            ]
        );
    }
}
