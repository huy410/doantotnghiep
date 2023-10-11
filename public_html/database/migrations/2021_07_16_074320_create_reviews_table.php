<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->tinyInteger('price_review_star');
            $table->tinyInteger('quality_review_star');
            $table->tinyInteger('ship_review_star');
            $table->tinyInteger('total_star');
            $table->string('nick_name');
            $table->string('title');
            $table->text('review_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
