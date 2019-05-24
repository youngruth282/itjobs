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

Route::get('/', function () {
    return redirect('jobs');
});

Route::get('conn/clear', 'ChkusersessionController@clear')->name('conn.clear');
Route::get('conn/{id}', 'ChkusersessionController@decode');

Route::get('posts/export/{deptid}','PostController@export')->name('posts.export');//很奇怪，{deptid}不能改名字
// Route::get('jobs/export/{deptid}','JobsController@export')->name('jobs.export');//很奇怪，{deptid}不能改名字

/*2019/02/17 修改
Route::get('jobs/search/{status?}', 'JobsController@search')->name('jobs.search');
Route::post('jobs/getsearch', 'JobsController@getsearch')->name('jobs.getsearch');
// Route::get('jobs/export/{deptid}','JobsController@export')->name('jobs.export');

//2019/01/23
Route::resource('jobs','JobsController'); */

Route::get('search/{status?}', 'JobsController@search')->name('jobs.search');
Route::post('getsearch', 'JobsController@getsearch')->name('jobs.getsearch');
// Route::get('jobs/export/{deptid}','JobsController@export')->name('jobs.export');

//2019/01/23
Route::resource('jobs','JobsController'); 
