<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product as ModelProduct;

class Product extends Controller
{
    public function index(){
        
        $categories=[
            ["name"=>"Fashion","id"=>1],
            ["name"=>"Tech","id"=>3],
        ];
        // $products=[
        //     [
        //         "name"=>"Classic Watch", 
        //         "price"=>"123", 
        //         "category_id"=>"1",
        //         "image_url"=> "https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80",
        //     ],
        //     [
        //         "name"=>"Classic Watch2", 
        //         "price"=>"23", 
        //         "category_id"=>"2",
        //         "image_url"=> "https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
        //     ],
        //     [
        //         "name"=>"Classic Watch3", 
        //         "price"=>"23", 
        //         "category_id"=>"1",
        //         "image_url"=> "https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
        //     ]
        // ];
        
        $productfromdb = ModelProduct::all();
        // $categoriesfromdb = Category::all();
        // dd($categoriesfromdb);
        return view('products',[
            "products"=> $productfromdb,
            "categories"=> $categories
        ]);
    }
}
