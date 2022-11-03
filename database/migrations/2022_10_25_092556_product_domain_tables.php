<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 16);
            $table->string('value', 16);
            $table->timestamps();
        });

        Schema::create('sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value', 16);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32)->unique();
            $table->string('description', 500)->nullable();
            $table->float('price');
            $table->string('a_side', 100)->nullable();
            $table->string('b_side', 100)->nullable();
            $table->enum('sex', ['male', 'female', 'uni'])->default('uni');
            $table->timestamps();
        });

        Schema::create('product_instances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('article')->unique();
            $table->integer('stock_balance');
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
        Schema::drop('product_instances');
        Schema::drop('colors');
        Schema::drop('sizes');
        Schema::drop('products');

    }
};
