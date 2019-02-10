<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myusers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->nullable();  //填寫人
            $table->string('user_name', 30)->nullable();  //姓名
            $table->string('hashname', 100)->nullable();  //MD5(姓名)為密碼
            $table->integer('hr_sn')->nullable();  //部門
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
        Schema::dropIfExists('myusers');
    }
}
