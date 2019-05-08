<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodStorage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_storage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('driver_id');
            $table->string('description');
            $table->string('status');
            $table->string('region_id');
            $table->string('truck_id')->nullable();
            $table->string('weight')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('length')->nullable();
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
        Schema::dropIfExists('good_storage');
    }
}
