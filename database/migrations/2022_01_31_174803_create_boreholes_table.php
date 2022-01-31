<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoreholesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boreholes', function (Blueprint $table) {
            $table->id();
            $table->integer('deposit_id');
            $table->string('title');
            $table->string('type');
            $table->string('condition');
            $table->integer('level_id');
            $table->double('q_liquids')->nullable();
            $table->double('water_cut')->nullable();
            $table->double('oil_density');
            $table->boolean('saved');
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
        Schema::dropIfExists('boreholes');
    }
}
