<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 楊品嫺  88b27a9e72e0c8e2749c859b5eea8993
// 陳源湘  35b9db98f7748e2a5996cc0058f8704c
// 黄心怡  f93e2a32e3cf975e4b3a1c01ed8c30aa
// 劉惠年  ffcf3a6762d614b6e4800ed21b02998d
// 蔡元正  af4fb5ddf7bc24ece857090697f04b12


Route::get('/', function () {
    return redirect('jobs');
});
// Route::get('conn2/{id}', 'C_JobsController@decode');

Route::get('conn/clear', 'ChkusersessionController@clear')->name('conn.clear');
Route::get('conn/{id}', 'ChkusersessionController@decode');

Route::get('posts/export/{crewid?}','PostController@export')->name('posts.export');//很奇怪，{deptid}不能改名字
// Route::get('jobs/export/{deptid}','JobsController@export')->name('jobs.export');//很奇怪，{deptid}不能改名字


Route::get('search/{status?}', 'JobsController@search')->name('jobs.search');
Route::post('getsearch', 'JobsController@getsearch')->name('jobs.getsearch');
// Route::get('jobs/export/{deptid}','JobsController@export')->name('jobs.export');

//2019/01/23
Route::resource('jobs','JobsController'); 

// 2019/04/19
Route::get('memconfirm/{id}', 'JobsController@memconfirm')->name('mem.memconfirm');


// 20190523 同工主崇聚會
Route::resource('survey','SurveyController');