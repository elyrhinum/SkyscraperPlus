<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplexClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complex_classes')->insert([
            ['name' => 'Эконом'],
            ['name' => 'Комфорт'],
            ['name' => 'Бизнес'],
            ['name' => 'Премиум']
        ]);
    }
}
