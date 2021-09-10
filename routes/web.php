<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Product;
use App\Models\Product as ModelProduct;
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

Route::get('/', [Product::class,'homeProducts']);

// shop route
Route::get('/shop',[Product::class,'index']);
Route::get('/shop/{category_id}',[Product::class,'withCategory']);
Route::get('/shop/sub/{category_id}/{sub_category_id}',[Product::class,'subCategory']);

// search route
Route::get('/search/{product_name}',[Product::class,'search']);

// checkout route
Route::get('/checkout',[Product::class,'checkout']);

// singular product
Route::get('/product/{product_id}',[Product::class,'productDescription']);

//generating bill
Route::get('/bill', [BillController::class, 'generatePDF']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
