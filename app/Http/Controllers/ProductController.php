<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request){
//        $products = Product::all();
        // noi bang de lay category
//        $products = Product::leftJoin("categories","categories.id","=","products.category_id")
//            ->select("products.*","categories.name as category_name")->get();
        //dung relationship
        $s = $request->get("search");
        $products = Product::with("Category")
//            ->where("category_id",1)
//            ->whereDate("created_ay","2021-06-18")'
//                ->whereMonth("created_at",6)
//                ->where("price",">",500)
//                ->where("name","LIKE","$s") // tim kiem theo ten
//                ->orderBy("price","asc")
//                ->take(1)
//                ->limit(1) // so luong lay
//                ->skip(1) // so luong bo qua
            ->get();
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
