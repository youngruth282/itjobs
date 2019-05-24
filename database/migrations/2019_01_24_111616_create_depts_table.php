<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hr_sn')->nullable();  //部門內碼
            $table->string('hr_no', 10)->nullable();  //部門編碼
            $table->string('dept_name', 100)->nullable();  //部門名稱
            $table->text('memo')->nullable();  //註解
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
        Schema::dropIfExists('depts');
    }
}
