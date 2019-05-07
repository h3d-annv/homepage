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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::prefix('admin')->group(function(){

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:web'], 'namespace' => 'Admin'], function() {
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

        Route::get('/product-category', 'ProductCategoryController@index')->name('admin.product-category.index');
        Route::get('/product-category/create', 'ProductCategoryController@create')->name('admin.product-category.create');
        Route::post('/product-category/store', 'ProductCategoryController@store')->name('admin.product-category.store');
        Route::get('/product-category/update/{id}', 'ProductCategoryController@update')->name('admin.product-category.update');
        Route::put('/product-category/modify', 'ProductCategoryController@modify')->name('admin.product-category.modify');
        Route::put('/product-category/activate', 'ProductCategoryController@activate')->name('admin.product-category.activate');
        Route::delete('/product-category', 'ProductCategoryController@remove')->name('admin.product-category.remove');

        Route::get('/product', 'ProductController@index')->name('admin.product.index');
        Route::get('/product/create', 'ProductController@create')->name('admin.product.create');
        Route::post('/product/store', 'ProductController@store')->name('admin.product.store');
        Route::get('/product/update/{id}', 'ProductController@update')->name('admin.product.update');
        Route::put('/product/modify', 'ProductController@modify')->name('admin.product.modify');
        Route::put('/product/activate', 'ProductController@activate')->name('admin.product.activate');
        Route::delete('/product', 'ProductController@remove')->name('admin.product.remove');






        Route::get('/product/create', 'ProductController@create')->name('admin.product.create');
    });

});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


