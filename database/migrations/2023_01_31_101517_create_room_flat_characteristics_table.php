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
        Schema::create('room_flat_characteristics', function (Blueprint $table) {
            //полиморфная связь с квартирой
            //полиморфная связь с комнатной
            $table->decimal('ceiling_high');
            $table->integer('floors');
            $table->integer('living_rooms_amount');
            $table->integer('bathrooms_amount');
            $table->boolean('bathroom_type');
            $table->decimal('living_area');
            $table->decimal('total_area');
            $table->decimal('kitchen_area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_flat_characteristics');
    }
};
