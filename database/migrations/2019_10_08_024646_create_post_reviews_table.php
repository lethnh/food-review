<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('shop_id');
            $table->longText('content');
            $table->string('feature_image')->nullable();
            $table->integer('user_id');
            $table->double('money');
            $table->integer('stars');
            $table->enum('is_approve', [-1, 0, 1])->default(0);
            $table->integer('like')->default(0)->nullable();
            $table->integer('unlike')->default(0)->nullable();
            $table->integer('total_view')->default(0)->nullable();
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
        Schema::dropIfExists('post_reviews');
    }
}
