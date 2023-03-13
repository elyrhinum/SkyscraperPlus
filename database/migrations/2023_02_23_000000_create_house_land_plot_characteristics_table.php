<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_land_plot_characteristics', function (Blueprint $table) {
            $table->morphs('object');
            $table->boolean('parking_space')->nullable();
            $table->boolean('playground')->nullable();
            $table->boolean('sports_ground')->nullable();
            $table->boolean('security')->nullable();
            $table->boolean('terrace')->nullable();
            $table->boolean('sewerage');
            $table->boolean('water_supply');
            $table->boolean('gas');
            $table->boolean('heating')->nullable();
            $table->boolean('electricity');
            $table->boolean('garage')->nullable();
            $table->boolean('bathhouse')->nullable();
            $table->boolean('pool')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_land_plot_characteristics');
    }
};
