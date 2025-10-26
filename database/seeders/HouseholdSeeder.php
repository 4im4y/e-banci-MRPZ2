<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = Zone::all();

        $households = [
            [
                'household_number' => 'KK001',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 123, Jalan Mawar 1, Taman Bunga',
                'postcode' => '15000',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => '4000_5999',
                'notes' => 'Keluarga berdaftar sejak 2020',
            ],
            [
                'household_number' => 'KK002',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 45, Jalan Cempaka 3, Taman Cempaka',
                'postcode' => '15050',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => '6000_7999',
                'notes' => null,
            ],
            [
                'household_number' => 'KK003',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 78, Jalan Melati 2, Taman Melati',
                'postcode' => '15100',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => 'below_2000',
                'notes' => 'Keluarga asnaf',
            ],
            [
                'household_number' => 'KK004',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 234, Jalan Orkid 5, Taman Orkid',
                'postcode' => '15150',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => 'above_10000',
                'notes' => null,
            ],
            [
                'household_number' => 'KK005',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 89, Jalan Ros 4, Taman Ros',
                'postcode' => '15200',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => '2000_3999',
                'notes' => null,
            ],
            [
                'household_number' => 'KK006',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 156, Jalan Teratai 1, Taman Teratai',
                'postcode' => '15250',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => '8000_9999',
                'notes' => null,
            ],
            [
                'household_number' => 'KK007',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 67, Jalan Dahlia 3, Taman Dahlia',
                'postcode' => '15300',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => '4000_5999',
                'notes' => null,
            ],
            [
                'household_number' => 'KK008',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 345, Jalan Kenanga 2, Taman Kenanga',
                'postcode' => '15350',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => '6000_7999',
                'notes' => null,
            ],
            [
                'household_number' => 'KK009',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 12, Jalan Anggerik 6, Taman Anggerik',
                'postcode' => '15400',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => '2000_3999',
                'notes' => null,
            ],
            [
                'household_number' => 'KK010',
                'zone_id' => $zones->random()->id,
                'address' => 'No. 98, Jalan Bakawali 7, Taman Bakawali',
                'postcode' => '15450',
                'city' => 'Kota Bharu',
                'state' => 'Kelantan',
                'income_range' => 'above_10000',
                'notes' => null,
            ],
        ];

        foreach ($households as $household) {
            Household::create($household);
        }

        $this->command->info('10 households created successfully!');
    }
}