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
            //полиморфная связь с риелтором
            //полиморфная связь с пользователем
            //полиморфная связь с квартирой
            //полиморфная связь с комнатой
            //полиморфная связь с домом
            //полиморфная связь с земельным участком
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
