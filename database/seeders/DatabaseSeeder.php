<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\HouseLandPlotCharacteristic;
use App\Models\Role;
use App\Models\Basket;
use App\Models\Category;
use App\Models\Info_Order;
use App\Models\Item;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Psy\Util\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ComplexClassSeeder::class,
            ContractTypeSeeder::class,
            DistrictSeeder::class,
            PlotTypeSeeder::class,
            RepairTypeSeeder::class,
            RoleSeeder::class,
            StatusSeeder::class,
            StreetSeeder::class,
            AdminSeeder::class
        ]);
    }
}
