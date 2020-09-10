<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//新闻练习
// Route::get('news/login','News\NewsController@login');//登录
// Route::post('news/logindo','News\NewsController@logindo');//执行登录
// Route::middleware('CheckUser')->group(function(){
// 	Route::get('news/newsadd','News\NewsController@newsadd');//添加
// 	Route::post('news/newsaddDo','News\NewsController@newsaddDo');//执行添加
// 	Route::get('news/newslist','News\NewsController@newslist');//展示
// 	Route::get('news/details/{id}','News\NewsController@details');//详情页
// });

//后台
Route::get('/brand/create','Admin\BrandController@create')->name('brand.create');//添加页面
Route::post('/brand/store','Admin\BrandController@store');//执行添加
Route::post('/brand/upload','Admin\BrandController@upload');//文件上传
Route::get('/brand','Admin\BrandController@index')->name('brand');//列表页
Route::get('/brand/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');//修改页面
Route::post('/brand/update/{brand_id}','Admin\BrandController@update');//执行修改
Route::any('/brand/brand_name','Admin\BrandController@brand_name');//即点即改
Route::get('/brand/delete/{brand_id?}','Admin\BrandController@destroy');//删除