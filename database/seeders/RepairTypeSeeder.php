<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepairTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plot_types')->insert([
            ['name' => 'Косметический'],
            ['name' => 'Евро'],
            ['name' => 'Дизайнерский'],
            ['name' => 'Без ремонта']
        ]);
    }
}
