<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

// use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public $cart=array();
    public function addToCart(Request $req){
        $product_id= $req->input('product_id');
        $quantity= $req-> input('quantity');
        $product = Product::find($product_id);

        $prev_cookie= (array)json_decode($req->cookie("cart"));
       
        //if cookie already exists
        if (!empty($prev_cookie)){
            //checking if product to be added is already in cart
            $this->cart=(array)$prev_cookie;

            if (!empty($prev_cookie[$product_id])){
                if (!empty($this->cart[$product_id])){
                    $this->cart[$product_id]->quantity = $prev_cookie[$product_id]->quantity+$quantity;
                } 
            }else {
                $this->cart[$product_id]=["quantity"=> $quantity,"id"=> $product->id,"name"=> $product->name, "price"=> $product->price , "image"=> $product->image_url];
            }
        }else{
            if ($product){   
                $this->cart[$product["id"]]=["quantity"=> $quantity,"id"=> $product->id, "name"=> $product->name,"price"=> $product->price , "image"=> $product->image_url];
            }
        }
        $minutes=60;
        return response()->json(["cart"=> $this->cart])->withCookie("cart",json_encode($this->cart),$minutes,null, null, false, false);
    }

    // public function modifyCart(Request $req){
    //     return ;
    // }
}
