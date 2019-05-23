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
    Route::group(['middleware' => ['auth:web'], 'namespace' => 'Auth'], function() {
        Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');
    });

    Route::group(['middleware' => ['auth:web'], 'namespace' => 'Admin'], function() {
        Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

        Route::get('/product-category', 'ProductCategoryController@index')->name('admin.product-category.index');
        Route::get('/product-category/create', 'ProductCategoryController@create')->name('admin.product-category.create');
        Route::post('/product-category/store', 'ProductCategoryController@store')->name('admin.product-category.store');
        Route::get('/product-category/update/{id}', 'ProductCategoryController@update')->name('admin.product-category.update');
        Route::put('/product-category/modify', 'ProductCategoryController@modify')->name('admin.product-category.modify');
        Route::put('/product-category/activate', 'ProductCategoryController@activate')->name('admin.product-category.activate');
        Route::delete('/product-category', 'ProductCategoryController@remove')->name('admin.product-category.remove');
        Route::put('/product-category/sort', 'ProductCategoryController@sort')->name('admin.product-category.sort');

        Route::get('/product', 'ProductController@index')->name('admin.product.index');
        Route::get('/product/create', 'ProductController@create')->name('admin.product.create');
        Route::post('/product/store', 'ProductController@store')->name('admin.product.store');
        Route::get('/product/update/{id}', 'ProductController@update')->name('admin.product.update');
        Route::put('/product/modify', 'ProductController@modify')->name('admin.product.modify');
        Route::put('/product/activate', 'ProductController@activate')->name('admin.product.activate');
        Route::delete('/product', 'ProductController@remove')->name('admin.product.remove');
        Route::put('/product/sort', 'ProductController@sort')->name('admin.product.sort');

        Route::get('/download','DownloadController@index')->name('admin.download.index');
        Route::get('/download/operation-system','OperationSystemController@index')->name('admin.download.operation-system.index');
        Route::post('/download/operation-system/store','OperationSystemController@store')->name('admin.download.operation-system.store');
        Route::get('/download/operation-system/update','OperationSystemController@update')->name('admin.download.operation-system.update');

        Route::get('/download/version/update', 'VersionController@update')->name('admin.download.version.update');
        Route::post('/download/version/store', 'VersionController@store')->name('admin.download.version.store');
        Route::get('/download/version/showVer', 'VersionController@showVer')->name('admin.download.version.showVer');

        Route::post('/download/log/store', 'LogController@store')->name('admin.download.log.store');
        Route::get('/download/log/index', 'LogController@index')->name('admin.download.log.index');

        Route::get('/vr-gallery', 'VrGalleryController@index')->name('admin.vr-gallery.index');
        Route::get('/vr-gallery/create', 'VrGalleryController@create')->name('admin.vr-gallery.create');
        Route::post('/vr-gallery/store', 'VrGalleryController@store')->name('admin.vr-gallery.store');
        Route::get('/vr-gallery/update/{id}', 'VrGalleryController@update')->name('admin.vr-gallery.update');
        Route::put('/vr-gallery/modify', 'VrGalleryController@modify')->name('admin.vr-gallery.modify');
        Route::put('/vr-gallery/activate', 'VrGalleryController@activate')->name('admin.vr-gallery.activate');
        Route::delete('/vr-gallery', 'VrGalleryController@remove')->name('admin.vr-gallery.remove');
        Route::put('/vr-gallery/sort', 'VrGalleryController@sort')->name('admin.vr-gallery.sort');
    });

});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', function(){
   return redirect('/');
});

Route::get('/vr-gallery', 'VrGalleryController@index')->name('vr-gallery.index');

Route::get('/products', 'ProductCategoryController@index')->name('product-category.index');

Route::get('/products/{param}', 'ProductCategoryController@show')->name('product-category.show');

Route::get('/{param}', 'ProductCategoryController@show')->name('product-category.show');



