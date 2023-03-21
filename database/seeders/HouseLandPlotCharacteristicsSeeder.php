<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseLandPlotCharacteristicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('house_land_plot_characteristics')->insert([
            ['name' => 'Парковка', 'is_landplot' => 0],
            ['name' => 'Детская площадка', 'is_landplot' => 0],
            ['name' => 'Спортивная площадка', 'is_landplot' => 0],
            ['name' => 'Охрана', 'is_landplot' => 0],
            ['name' => 'Терраса', 'is_landplot' => 0],
            ['name' => 'Канализация', 'is_landplot' => 1],
            ['name' => 'Водоснабжение', 'is_landplot' => 1],
            ['name' => 'Газ', 'is_landplot' => 1],
            ['name' => 'Электричество', 'is_landplot' => 1],
            ['name' => 'Отопление', 'is_landplot' => 0],
            ['name' => 'Гараж', 'is_landplot' => 0],
            ['name' => 'Баня', 'is_landplot' => 0],
            ['name' => 'Бассейн', 'is_landplot' => 0],
        ]);
    }
}
