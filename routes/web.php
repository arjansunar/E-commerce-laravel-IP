<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/shop',[Product::class,'index']);
Route::get('/shop/{category_id}',[Product::class,'withCategory']);
Route::get('/shop/sub/{category_id}/{sub_category_id}',[Product::class,'subCategory']);


Route::get('/checkout',function(){
    return view('checkout');
});

Route::get('/products',function(){
    $product = ModelProduct::all();
    dd($product);
    return "all products";
});

Route::get('/product', function(){
    return view('product');
});

// Route::get('/subcategory/{category_id}',);