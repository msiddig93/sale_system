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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'users'], function() {
        Route::get('/','UserController@index')->name('user.index');
        Route::get('/create','UserController@create')->name('user.create');
        Route::post('/store','UserController@store')->name('user.store');
        Route::get('/edit/{id}','UserController@edit')->name('user.edit');
        Route::post('/update','UserController@update')->name('user.update');    
        Route::get('/delete/{id}','UserController@destroy')->name('user.delete');
    });

    Route::group(['prefix' => 'category'], function() {
        Route::get('/','CategoryController@index')->name('category.index');
        Route::get('/create','CategoryController@create')->name('category.create');
        Route::post('/store','CategoryController@store')->name('category.store');
        Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
        Route::post('/update','CategoryController@update')->name('category.update');    
        Route::get('/delete/{id}','CategoryController@destroy')->name('category.delete');
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/','ProductController@index')->name('product.index');
        Route::get('/create','ProductController@create')->name('product.create');
        Route::post('/store','ProductController@store')->name('product.store');
        Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
        Route::get('/report','ProductController@report')->name('product.report');
        Route::post('/update','ProductController@update')->name('product.update');    
        Route::get('/delete/{id}','ProductController@destroy')->name('product.delete');
    });

    Route::group(['prefix' => 'vendor'], function() {
        Route::get('/','VendoorController@index')->name('vendor.index');
        Route::get('/create','VendoorController@create')->name('vendor.create');
        Route::post('/store','VendoorController@store')->name('vendor.store');
        Route::get('/edit/{id}','VendoorController@edit')->name('vendor.edit');
        Route::post('/update','VendoorController@update')->name('vendor.update');    
        Route::get('/delete/{id}','VendoorController@destroy')->name('vendor.delete');
    });

    Route::group(['prefix' => 'sales_bill'], function() {
        Route::get('/','SalesBillController@index')->name('sales_bill.index');
        Route::get('/create','SalesBillController@create')->name('sales_bill.create');
        Route::get('/report','SalesBillController@report')->name('sales_bill.report');
        Route::post('/store','SalesBillController@store')->name('sales_bill.store');
        Route::get('/edit/{id}','SalesBillController@edit')->name('sales_bill.edit');
        Route::post('/update','SalesBillController@update')->name('sales_bill.update');    
        Route::get('/delete/{id}','SalesBillController@destroy')->name('sales_bill.delete');
    });

    Route::group(['prefix' => 'sales_detail'], function() {
        Route::get('/create','SaleDetailController@create')->name('sales_detail.create');
        Route::post('/store','SaleDetailController@store')->name('sales_detail.store');
        Route::get('/edit/{id}','SaleDetailController@edit')->name('sales_detail.edit');
        Route::post('/update','SaleDetailController@update')->name('sales_detail.update');    
        Route::get('/delete/{id}','SaleDetailController@destroy')->name('sales_detail.delete');
    });

    Route::group(['prefix' => 'purchase'], function() {
        Route::get('/','PurchaseController@index')->name('purchase.index');
        Route::get('/create','PurchaseController@create')->name('purchase.create');
        Route::get('/report','PurchaseController@report')->name('purchase.report');
        Route::post('/store','PurchaseController@store')->name('purchase.store');
        Route::get('/edit/{id}','PurchaseController@edit')->name('purchase.edit');
        Route::post('/update','PurchaseController@update')->name('purchase.update');    
        Route::get('/delete/{id}','PurchaseController@destroy')->name('purchase.delete');
    });

    Route::group(['prefix' => 'purchase_detail'], function() {
        Route::get('/create','PurchaseDetailController@create')->name('purchase_detail.create');
        Route::post('/store','PurchaseDetailController@store')->name('purchase_detail.store');
        Route::get('/edit/{id}','PurchaseDetailController@edit')->name('purchase_detail.edit');
        Route::post('/update','PurchaseDetailController@update')->name('purchase_detail.update');    
        Route::get('/delete/{id}','PurchaseDetailController@destroy')->name('purchase_detail.delete');
    });

    // Route::group(['prefix' => 'report'], function() {
    //     Route::get('/create','ReportControlle@create')->name('repoet.create');
    //     Route::post('/store','PurchaseDetailController@store')->name('purchase_detail.store');
    //     Route::get('/edit/{id}','PurchaseDetailController@edit')->name('purchase_detail.edit');
    //     Route::post('/update','PurchaseDetailController@update')->name('purchase_detail.update');    
    //     Route::get('/delete/{id}','PurchaseDetailController@destroy')->name('purchase_detail.delete');
    // });

});




