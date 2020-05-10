<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('bill_id');
            $table->integer('bill_customer_id')->unsigned()->nullable();
            $table->date('date_purchase')->nullable();
            $table->integer('totalPrice')->unsigned();
            $table->string('receiver')->nullable();
            $table->text('address')->nullable();
            $table->integer('number_phone')->unsigned();
            $table->boolean('status')->nullable();
            $table->text('noteShip')->nullable()->default('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill');
    }
}
