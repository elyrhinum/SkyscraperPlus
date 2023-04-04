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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('plot_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('street_number');
            $table->integer('plot_number')->nullable();
            $table->decimal('building_area');
            $table->integer('floors')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('bathroom_place')->nullable();
            $table->integer('building_year')->nullable();
            $table->string('building_material')->nullable();
            $table->text('building_status')->nullable();
            $table->decimal('plot_area');
            $table->text('plot_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
};
