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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('statuses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('contract_id')->constrained('contracts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('realtor_id')->constrained('realtors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('user')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('flat_id')->constrained('flats')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('house_id')->constrained('houses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('landplot_id')->constrained('land_plots')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
