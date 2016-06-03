<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transaction_money', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type_money');
            $table->decimal('money');
            $table->integer('wallet_id')->unsigned();
            $table->foreign('wallet_id')->references('id')->on('Wallets');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('Categories');
            $table->string('note')->nullable();
            $table->string('image')->nullable();
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
        Schema::drop('Transaction_money');
    }
}
