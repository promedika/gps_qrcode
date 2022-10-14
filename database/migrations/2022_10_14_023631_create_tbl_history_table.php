<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_history', function (Blueprint $table) {
            $table->id('th_id')->autoIncrement();
            $table->integer('th_tbl_rs_tr_id')->nullable();
            $table->bigInteger('th_no')->nullable();
            $table->dateTime('th_date')->nullable();
            $table->integer('th_jumlah')->nullable();
            $table->string('th_requestby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_history');
    }
}
