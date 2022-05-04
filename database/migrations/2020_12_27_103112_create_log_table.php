<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->integer('items_id');
            $table->integer('items_specification_id');
            $table->string('old_size')->nullable();
            $table->string('size');
            $table->string('old_color')->nullable();
            $table->string('color');
            $table->integer('old_qty')->nullable();
            $table->integer('qty');
            $table->float('old_price')->nullable();
            $table->float('price')->nullable();
            $table->string('old_remark')->nullable();
            $table->string('remark')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('log');
    }
}