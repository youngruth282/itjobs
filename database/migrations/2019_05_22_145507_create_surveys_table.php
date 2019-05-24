<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid');//
            $table->string('mainswitch', 1);//
            $table->string('nameX', 100)->nullable();//
            $table->string('contentX', 100)->nullable();//
            $table->string('switchA', 1)->nullable();//
            $table->string('serviceA', 100)->nullable();//
            $table->string('contentA', 100)->nullable();//
            $table->string('switchB', 1)->nullable();//
            $table->string('serviceB', 100)->nullable();//
            $table->string('contentB', 100)->nullable();//
            $table->string('switchC', 1)->nullable();//
            $table->string('servicC', 100)->nullable();//
            $table->string('contentC', 100)->nullable();//
            $table->string('switchD', 1)->nullable();//
            $table->string('serviceD', 100)->nullable();//
            $table->string('contentD', 100)->nullable();//
            $table->string('switchE', 1)->nullable();//
            $table->string('serviceE', 100)->nullable();//
            $table->string('contentE', 100)->nullable();//
            $table->string('switchF', 1)->nullable();//
            $table->string('serviceF', 100)->nullable();//
            $table->string('contentF', 100)->nullable();//
            $table->string('switchG', 1)->nullable();//
            $table->string('serviceG', 100)->nullable();//
            $table->string('contentG', 100)->nullable();//
            $table->string('switchH', 1)->nullable();//
            $table->string('serviceH', 100)->nullable();//
            $table->string('contentH', 100)->nullable();//
            $table->string('switchM', 1)->nullable();//
            $table->string('serviceM', 100)->nullable();//
            $table->string('content', 100)->nullable();//
            $table->string('switchZ', 1)->nullable();//
            $table->string('serviceZ', 100)->nullable();//
            $table->string('contentZ', 100)->nullable();//
            $table->string('memo', 200)->nullable();//
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
        Schema::dropIfExists('surveys');
    }
}
