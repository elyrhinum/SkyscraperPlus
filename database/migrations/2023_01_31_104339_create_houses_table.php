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
            $table->foreignId('district_id')->constrained('districts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('street_id')->constrained('streets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('description');
            $table->text('images');
            $table->integer('building_number');
            $table->decimal('building_area');
            $table->integer('floors');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->string('bathroom_place');
            $table->integer('build_year');
            $table->string('building_material');
            $table->string('building_status');
            $table->decimal('plot_area');
            $table->string('plot_status');
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
