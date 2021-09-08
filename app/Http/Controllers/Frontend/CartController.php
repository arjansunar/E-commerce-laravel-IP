<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

// use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public $cart=array();
    public function addToCart(Request $req){
        $product_id= $req->input('product_id');
        $quantity= $req-> input('quantity');
        $product = Product::find($product_id);

        dd($product);
        array_push($this->cart,[$product_id]);
        $minutes=1;

        return response()->json(['status'=> [$product_id,$quantity]])->withCookie("cart",json_encode($this->cart),$minutes);
    }
}
