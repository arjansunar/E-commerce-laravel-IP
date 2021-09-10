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

    public function search($product_name){

        $products = ModelProduct::query()
            ->where('name', 'LIKE', "%{$product_name}%")
            ->get();

        return view('search',[
            "products"=> $products,
        ]);
    }


    public function homeProducts(){

        $random_products=ModelProduct::all()->random(3); 
        $hero_product= $random_products[0];
        $sub_products= [$random_products[1], $random_products[2]];
       
        $categories= Category::all(); 
        $products=[];

        foreach ($categories as $category) {
            $id= $category["id"];
            $products_with_category_id= ModelProduct::where("category_id", $id)->limit(5)->get();
            $products[$id]=["data"=>$products_with_category_id, "category"=> $category["name"]];
        }
        return view('index',[
            "hero"=> $hero_product,
            "sub_hero"=> $sub_products,
            "products"=> $products
        ]);
    }

    public function productDescription($product_id){
        $product= ModelProduct::where("id",$product_id)->get();
        $products= ModelProduct::all()->random(4);
        return view("product",[
            "main"=> $product[0],
            "products"=>$products
        ]);
    }

    public function checkout(Request $req){
        $prev_cookie= (array)json_decode($req->cookie("cart"));
        // dd($prev_cookie);
        return view("checkout",[
            "products"=> $prev_cookie
        ]);
    }
}
