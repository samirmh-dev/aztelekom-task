<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->char('count',1);
	        $table->integer('fk_product_id')->unsigned();
	        $table->foreign( 'fk_product_id')
	              ->references('id')->on('products')
	              ->onDelete('cascade');
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
        Schema::dropIfExists('product__ratings');
    }
}
