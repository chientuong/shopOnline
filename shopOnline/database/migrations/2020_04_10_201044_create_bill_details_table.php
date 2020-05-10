<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->integer('bill_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quanty')->unsigned()->nullable()->default(12);
            $table->primary(['bill_id', 'product_id']);
            // $table->foreign('bill_id')->references('bill_id')->on('bill')->onDelete('cascade');
            // $table->foreign('product_id')->references('prod_id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_details');
    }
}
