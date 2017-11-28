<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fayl',60);
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
        Schema::dropIfExists('product__photos');
    }
}
