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



Auth::routes();
//Route::group(['middleware'=>['role:super-admin']],function(){
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('admin/permission', 'Admin\\PermissionController');
	Route::resource('admin/role', 'Admin\\RoleController');
	Route::resource('user', 'UserController');
	Route::resource('movie/movie', 'Movie\\MovieController');
//});

// Route::group(['middleware'=>['role:author']],function(){
// 	Route::get('admin/permission','Admin\\PermissionController@index');//view
// 	Route::post('admin/permission','Admin\\PermissionController@store');//create
// 	Route::get('admin/permission/{permission}/edit','Admin\\PermissionController@edit');//edit
// 	Route::put('admin/permission/{permission}','Admin\\PermissionController@update');	//update
// });
// Route::group(['middleware'=>['role:viewer']],function(){
// 	Route::get('/movie', 'HomeController@index')->name('home');
// 	Route::get('/movie/movie/{movie}', 'Movie\\MovieController@show');
// });


Route::get('/test','Admin\\PermissionController@test');



Route::resource('blog/blog', 'Blog\\BlogController');

Route::get('/article',function(){
	return view('article.articles');
});