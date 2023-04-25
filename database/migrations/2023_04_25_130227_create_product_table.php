<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->unsignedBigInteger('id_category');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_type');
            $table->text('product_description');
            $table->decimal('product_price', 10, 2);
            $table->integer('product_quantity');
            $table->json('product_specification');
            $table->boolean('product_status');
            $table->timestamps();

            $table->foreign('id_category')->references('id_product')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
