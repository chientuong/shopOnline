<?php

use App\Http\Controllers\adminBrand;
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

Route::get('/','homeController@home');

Route::get('home','homeController@home');
Route::get('cate/{id}','fontendCate@cate');
Route::get('brand/{id}','fontendBrand@brand' );
Route::get('prodDetails/{id}','homeController@prodDetails');
Route::get('addToCart/{prodId}','cartController@addCart');
Route::get('prodDetails/addToCart/{prodId}','cartController@addCart');
Route::get('cart','cartController@cart');
Route::get('deleteItemCart/{prodId}','cartController@deleteItemCart');
Route::get('addQuanty/{prodId}','cartController@addQuanty');
Route::get('subtractQuanty/{prodId}','cartController@subtractQuanty');

Route::get('loginCustomer','customerController@loginCustomer');
Route::post('loginCustomer','customerController@loginProcessCustomer');

Route::post('signInCustomer','customerController@signInCustomer');
Route::get('logoutCustomer','customerController@logout');

Route::get('checkOut','customerController@checkOut');
Route::post('checkOut','customerController@checkOutProcess');
Route::get('searchProd','seachController@searchProdCustomer');


Route::group(['prefix' => 'admin'], function () {
    //xu ly dang nhap
    Route::get('/','adminController@adminDashboard');
    Route::get('adminLogin','adminController@adminLogin');
    Route::post('adminLogin','adminController@processLogin');
    Route::get('adminDashboard','adminController@adminDashboard');
    Route::get('logout','adminController@logout');
    //category
    Route::get('getFormInsert','adminCategory@getFormInsert');
    Route::post('getFormInsert','adminCategory@postFormInsert');

    Route::get('getFormUpdate/{id}','adminCategory@getFormUpdate' );
    Route::post('getFormUpdate/{id}','adminCategory@postFormUpdate' );

    Route::get('deleteCategory/{id}','adminCategory@deleteCategory' );

    //brand
    Route::get('brand','adminBrand@brand');
    Route::post('brand','adminBrand@postBrand');

    Route::post('brandUpdate/{id}','adminBrand@brandUpdate');
    Route::get('brandDelete/{id}','adminBrand@brandDelete');

    //product
    Route::get('addProduct','adminProduct@addProduct');
    Route::post('addProduct','adminProduct@postAddProduct');
    Route::get('product','adminProduct@product' );
    Route::get('updateProduct/{id}','adminProduct@updateProduct');
    Route::post('updateProduct/{id}','adminProduct@postUpdateProduct');
    Route::get('deleteProduct/{id}','adminProduct@deleteProduct');
    //bill
    Route::get('showBill','adminBill@showBill');
    Route::get('approveBill/{billId}','adminBill@approveBill');
    Route::get('approveBill','adminBill@showApproveBill');

    Route::get('cancelBill/{billId}','adminBill@cancelBill');
    Route::get('cancelBill','adminBill@showCancelBill');

    Route::get('resetCancelBill/{billId}','adminBill@resetCancelBill');

    //Banner
    Route::get('addSlider','adminBanner@addBanner');
    Route::post('addSlider','adminBanner@postAddBanner');
    Route::get('showSlider','adminBanner@showBanner');
    Route::post('showSlider','adminBanner@showBanner');
    Route::get('updateSlider/{id}','adminBanner@updateSlider');
    Route::post('updateSlider/{id}','adminBanner@postUpdateSlider');
    Route::get('deleteSlider/{id}','adminBanner@deleteSlider');

    //details bill
    Route::get('detailsBill/{idBill}','adminBill@detailsBill');

    //Search
    Route::get('searchCategory','seachController@searchCategory');
    Route::get('searchBrand','seachController@searchBrand');
    Route::get('searchProdAdmin','seachController@searchProdAdmin');
    Route::get('searchBill','seachController@searchBill');
    Route::get('searchApproveBill','seachController@searchApproveBill');
    Route::get('searchCancelBill','seachController@searchCancelBill');
});
