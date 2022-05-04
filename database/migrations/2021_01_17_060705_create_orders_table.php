<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->primary(['id']);
            $table->string('id');
            $table->date('order_date');

            $table->integer('user_id');
            $table->string('customer_name');
            $table->text('delivery_address');
            $table->integer('delivery_id');
            $table->string('phone');
            $table->string('email')->nullable();

            $table->integer('total_quantity');
            $table->float('cart_total')->nullable();
            $table->float('delivery_cost');
            $table->integer('promo_code_id')->nullable();
            $table->integer('final_cost');

            $table->string('payment_type');
            $table->integer('bank_id');
            $table->string('payment_screenshot');

            $table->integer('preorder_status')->default(0);
            $table->integer('status')->default(1);

            $table->integer('created_by')->default(4);
            $table->integer('updated_by')->nullable();
            
            $table->date('preordered_date')->nullable();
            $table->date('received_date')->nullable();
            $table->date('delivered_date')->nullable();
            $table->text('remark')->nullable();


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
        Schema::dropIfExists('orders');
    }
}
