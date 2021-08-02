<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Product extends Controller
{
    public function index(){
        $products=[
            [
                "name"=>"Classic Watch", 
                "price"=>"123", 
                "image"=> "https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80",
            ],
            [
                "name"=>"Classic Watch2", 
                "price"=>"23", 
                "image"=> "https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
            ]
        ];
        return view('products')->with("products", $products);
    }
}
