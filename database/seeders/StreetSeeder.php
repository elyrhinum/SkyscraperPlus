<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('streets')->insert([
            ['name' => 'ул. Труда'],
            ['name' => 'ул. Кирова'],
            ['name' => 'ул. Российская'],
            ['name' => 'ул. Лесопарковая'],
            ['name' => 'ул. Омская'],
            ['name' => 'ул. Молодогвардейцев'],
            ['name' => 'ул. Худякова'],
            ['name' => 'ул. 30-летия Октября'],
            ['name' => 'ул. 40-летия Октября'],
            ['name' => 'ул. 50 лет ВЛКСМ'],
            ['name' => 'ул. Бажова'],
            ['name' => 'ул. Гагарина'],
            ['name' => 'ул. Завалишина'],
            ['name' => 'ул. Савина'],
            ['name' => 'ул. Хариса Юсупова'],
        ]);
    }
}
