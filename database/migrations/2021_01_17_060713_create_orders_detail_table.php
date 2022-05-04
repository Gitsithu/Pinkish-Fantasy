<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_detail', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('order_id');
            $table->integer('item_id');
            $table->integer('specification_id');
            $table->integer('price');
            $table->integer('promotion_id')->nullable();
            $table->integer('quantity');
            $table->integer('sub_total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_detail');
    }
}
