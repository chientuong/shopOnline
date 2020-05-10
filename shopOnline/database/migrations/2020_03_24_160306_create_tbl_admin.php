<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('full_name',100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 100)->nullable();
            $table->text('address')->nullable();
            $table->integer('number_phone')->unsigned()->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('gender')->nullable();
            $table->boolean('role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
