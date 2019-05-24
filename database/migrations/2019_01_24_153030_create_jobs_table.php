<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('req_id')->nullable();  //填寫人
            $table->string('app_no', 12)->nullable();  //編號
            $table->integer('app_deptid')->nullable();  //部門
            $table->string('app_crewname', 50)->nullable();  //負責同工
            $table->text('app_item', 255)->nullable();  //項目
            $table->text('app_content')->nullable();  //內容描述
            $table->text('app_progress')->nullable();  //執行進度
            $table->text('app_memo')->nullable();  //備註
            $table->date('app_duedate')->nullable();  //預計完成日期
            $table->date('app_donedate')->nullable();  //完成日期
            $table->string('app_status', 1)->default('N');  //狀態
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
        Schema::dropIfExists('jobs');
    }
}
