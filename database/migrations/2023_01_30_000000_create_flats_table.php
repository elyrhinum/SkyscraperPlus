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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complex_id')->nullable()->constrained('residential_complexes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('district_id')->constrained('districts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('street_id')->constrained('streets')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('repair_id')->constrained('repair_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('street_number');
            $table->integer('entrance');
            $table->integer('floor');
            $table->integer('number');
            $table->text('layout');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flats');
    }
};
