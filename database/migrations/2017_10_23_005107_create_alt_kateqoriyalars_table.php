<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAltKateqoriyalarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alt_kateqoriyalar', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('ad',30);
	        $table->string('slug',20)->unique();
	        $table->integer('foreign_kateqoriya_id')->unsigned();
	        $table->foreign( 'foreign_kateqoriya_id')
	              ->references('id')->on('kateqoriyalar')
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
        Schema::dropIfExists('alt_kateqoriyalars');
    }
}
