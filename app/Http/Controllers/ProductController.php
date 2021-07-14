<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(){
//        $products = Product::all();
        // noi bang de lay category
//        $products = Product::leftJoin("categories","categories.id","=","products.category_id")
//            ->select("products.*","categories.name as category_name")->get();
        //dung relationship
        $products = Product::with("category")->get();
        return view("product.list",[
            "products"=>$products
        ]);
    }

    public function form(){
        $categories = Category::all();
        return view("product.form",[
            "categories"=>$categories
        ]);
    }

    public function save(Request $request){
        $request->validate([
           "name"=>"required",
            "image"=>"required",
            "description"=>"required",
            "price"=>"required",
            "qty"=>"required",
            "category_id"=>"required|numeric|min:1"
        ]);
        try {
            Product::create([
                "name"=>$request->get("name"),
                "image" =>$request->get("image"),
                "description" =>$request->get("description"),
                "price" =>$request->get("price"),
                "qty"=>$request->get("qty"),
                "category_id"=>$request->get("category_id")
            ]);
        }
        catch (\Exception $e){
            abort(404);
        }
        return redirect()->to("products");
    }
}
