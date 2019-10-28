<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPostReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_reviews', function (Blueprint $table) {
            $table->integer('like')->default(0)->nullable();
            $table->integer('unlike')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_reviews', function ($table) {
            $table->dropColumn('like');
            $table->dropColumn('unlike');
        });
    }
}
