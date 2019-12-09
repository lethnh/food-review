<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('google_map_id');
            $table->unique('google_map_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('city_id');
            $table->string('district_id');
            $table->string('address');
            $table->text('feature_image')->nullable();
            $table->string('begin_time');
            $table->string('close_time');
            $table->float('lat', 10, 6);
            $table->float('lng', 10, 6);
            $table->string('type');
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
        Schema::dropIfExists('shops');
    }
}