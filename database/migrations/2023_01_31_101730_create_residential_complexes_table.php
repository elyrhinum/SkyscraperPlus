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
        Schema::create('residential_complexes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('images');
            $table->foreignId('class_id')->constrained('complex_classes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('district_id')->constrained('districts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('street_id')->constrained('streets')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residential_complexes');
    }
};
