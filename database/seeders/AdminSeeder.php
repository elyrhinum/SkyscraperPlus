<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['role_id' => 3,
                'name' => 'Мария',
                'surname' => 'Рахимьянова',
                'patronymic' => 'Юрьевна',
                'login' => 'oktiabor82',
                'password' => Hash::make('Qwerty123!')]
        ]);
    }
}
