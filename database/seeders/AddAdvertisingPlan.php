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
                [
                    'name' => '7 Days with Boost',
                    'description' => 'Kickstart your visibility with a quick boost. Pair it with a Featured Listing for maximum exposure and reach, ensuring your product stands out prominently for a week.',
                    'duration_days' => 7,
                    'cost' => 4.99,
                    'price_id' => 'price_1Q5ttFCsTn7FILMRwJIdZNvR',
                    'with_boost_id' => '1',
                ],
                [
                    'name' => '30 Days with Boost',
                    'description' => 'Enjoy sustained exposure for a month with an added boost, making sure your product captures the attention it deserves with enhanced visibility throughout the period.',
                    'duration_days' => 30,
                    'cost' => 5.99,
                    'price_id' => 'price_1Q5ttvCsTn7FILMRlWZaqMlh',
                    'with_boost_id' => '2',
                ],
                [
                    'name' => '60 Days with Boost',
                    'description' => 'Enjoy sustained exposure for a month with an added boost, making sure your product captures the attention it deserves with enhanced visibility throughout the period.',
                    'duration_days' => 60,
                    'cost' => 8.99,
                    'price_id' => 'price_1Q5tv7CsTn7FILMRwapO9mR6',
                    'with_boost_id' => '3',
                ],
                [
                    'name' => '90 Days with Boost',
                    'description' => 'The ultimate value—maximize your product’s reach and presence for three months with an extra boost, ensuring prominent placement and ongoing visibility.',
                    'duration_days' => 90,
                    'cost' => 10.99,
                    'price_id' => 'price_1Q5ttvCsTn7FILMRlWZaqMlh',
                    'with_boost_id' => '4',
                ],
            ]
        );
    }
}
