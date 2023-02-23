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
            $table->id();
            $table->foreignId('house_id')->constrained('houses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('landplot_id')->constrained('land_plots')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('balcony');
            $table->boolean('loggia');
            $table->boolean('parking_space');
            $table->boolean('garbage_chute');
            $table->boolean('concierge');
            $table->boolean('childrens_playgroud');
            $table->boolean('sports_ground');
            $table->boolean('sewage_system');
            $table->boolean('water_supply');
            $table->boolean('gas');
            $table->boolean('electricity');
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
