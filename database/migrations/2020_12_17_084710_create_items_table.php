<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('name')->nullable();
            $table->string('item_code')->nullable();

            $table->integer('categories_id');
            $table->integer('countries_id');
            $table->integer('brands_id')->nullable();
            $table->string('url')->nullable();
            $table->integer('cargo_fee')->nullable();
            $table->integer('shipping_fee')->nullable();
            $table->integer('profit_id');

            $table->string('image_url1');
            $table->string('image_url2')->nullable();
            $table->string('image_url3')->nullable();
            $table->string('image_url4')->nullable();
            $table->string('image_url5')->nullable();
            $table->string('image_url6')->nullable();
            $table->string('image_url7')->nullable();
            $table->string('image_url8')->nullable();

            $table->string('image_url9')->nullable();
            $table->integer('sale_type')->default(1);

            //Detail Info is Image_url10//
            $table->string('image_url10')->nullable();

            $table->string('description')->nullable();
            $table->string('remark')->nullable();

            $table->integer('additional_charges')->nullable();
            $table->float('purchase_price');
            $table->integer('sale_price')->nullable();

            $table->integer('status')->default(1);

            $table->date('inactive_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('items');
    }
}