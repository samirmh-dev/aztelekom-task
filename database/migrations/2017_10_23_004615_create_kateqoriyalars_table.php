<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKateqoriyalarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kateqoriyalar', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'ad',30);
            $table->string('slug',20)->unique();
            $table->boolean( 'alt_kateqoriya')->default(0)->comment('0 - yoxdur, 1 - var');
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
        Schema::dropIfExists('kateqoriyalars');
    }
}
