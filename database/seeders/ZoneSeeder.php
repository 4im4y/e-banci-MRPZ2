<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zones = [
            [
                'name' => 'Zon 1',
                'code' => '01',
                'description' => 'Kawasan Zon 1',
                'is_active' => true,
            ],
            [
                'name' => 'Zon 2',
                'code' => '02',
                'description' => 'Kawasan Zon 2',
                'is_active' => true,
            ],
            [
                'name' => 'Zon 3',
                'code' => '03',
                'description' => 'Kawasan Zon 3',
                'is_active' => false,
            ],
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }

        $this->command->info('3 Zon berjaya ditambah ke dalam pangkalan data.');
    }
}
