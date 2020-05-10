<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('prod_id');
            $table->string('prod_name');
            $table->integer('prod_price');
            $table->integer('prod_amount');
            $table->string('prod_img');
            $table->string('prod_warranty');
            $table->string('prod_accessories');
            $table->string('prod_condition');
            $table->string('prod_promotion');
            $table->boolean('prod_status');
            $table->text('prod_description');
            $table->integer('prod_featured')->unsigned();
            $table->integer('prod_cate')->unsigned();
            $table->integer('prod_brand')->unsigned();
            $table->foreign('prod_cate')->references('category_id')->on('category')->onDelete('cascade');
            $table->foreign('prod_brand')->references('brand_id')->on('brand')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
