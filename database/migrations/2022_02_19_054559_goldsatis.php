<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Goldsatis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goldsatis', function (Blueprint $table) {
            $table->id();
            $table->string('saticiadi');
            $table->integer('gold');
            $table->double('dolarpergold', 8, 5)->nullable();
            $table->double('elegecengold', 8, 5);
            $table->smallInteger('toplandimi');
            $table->dateTime("tarih")->nullable();
            $table->timestamps();
            $table->dateTime("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
