<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product as ModelProduct;
use App\Models\SubCategory;

class Product extends Controller
{
    public function index(){
        $productfromdb = ModelProduct::all();
        $categoriesfromdb = Category::all();

        return view('products',[
            "products"=> $productfromdb,
            "categories"=> $categoriesfromdb,
            "has_category"=> true,
            "next_route_prefix"=> "/shop"
        ]);
    }

    public function withCategory($category_id){
        $productfromdb = ModelProduct::where("category_id", $category_id)->get();
        $sub_categories=[];
        // $sub_categories_id= ModelProduct::where("category_id", $category_id)->distinct("sub_category_id")->get("sub_category_id");
        $sub_categories_id = Category::find($category_id)->subCategories;
        // dd($sub_categories_id[0]);
        
        foreach ($sub_categories_id as $id){
            array_push($sub_categories, ["id"=> $id["id"],"name"=>$id["name"]]);
        }

        // dd($sub_categories);

        return view('products',[
            "products"=> $productfromdb,
            "categories"=> $sub_categories,
            "has_category"=> true,
            "next_route_prefix"=> "/shop/sub/".$category_id
        ]);
    } 
    
    public function subCategory($category_id,$sub_category_id){
        $productfromdb = ModelProduct::where([
                ["category_id", $category_id],
                ["sub_category_id", $sub_category_id]
            ])->get();

        return view('products',[
            "products"=> $productfromdb,
            "has_category"=> false
        ]);
    }
}
