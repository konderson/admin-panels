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
    return view('welcome');
});

Route::match(['get','post'],'/admin','AdminController@login');
Route::get('/logout','AdminController@logout');
Auth::routes();
Route::group(['middleware'=>['auth']],function (){
    Route::get('admin/dashboard','AdminController@dashboard');
    Route::get('admin/settings','AdminController@settings');
    Route::get('admin/check_pwd','AdminController@checkPassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePwd');



    /* Category route*/

    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::get('/admin/view-category','CategoryController@viewCategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::get('/admin/delete-category/{id}','CategoryController@deleteCategory');

    /* Products route*/
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::get('/admin/view-product','ProductsController@viewProduct');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');

    /*  Products attribute  */


    Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
    Route::get('/admin/delete-attributes/{id}','ProductsController@deleteAttributes');

});
Route::get('/home', 'HomeController@index')->name('home');
