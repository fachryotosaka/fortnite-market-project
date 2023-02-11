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
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
				$table->unsignedBigInteger('order_id');
				$table->unsignedBigInteger('product_id');
				$table->integer('qty');
				$table->decimal('base_price', 16, 2)->default(0);
				$table->decimal('base_total', 16, 2)->default(0);
				$table->string('name');
				$table->timestamps();

				$table->foreign('order_id')->references('id')->on('orders');
				$table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
