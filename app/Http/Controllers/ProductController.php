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
//            "image"=>"required",
//            "description"=>"required",
            "price"=>"required",
            "qty"=>"required",
            "category_id"=>"required|numeric|min:1"
        ],[
            "name.required"=>"Vui lòng nhập sản phẩm",
            "category_id.min"=>"Vui lòng nhập danh mục"
        ]);
        // up load
        $image = null;
        if ($request->has("image")){
            $file = $request->file("image");
//            $fileName = $file->getClientOriginalName();// lay ten file
            $exName = $file->getClientOriginalExtension(); // lay duoi file(vd:PNG,JPG)
            $fileName = time().".".$exName;
            $fileSize = $file->getSize(); // lay kich thuoc file
//            dd($fileName);
            $allow = ["png","jpg","jpeg","gif"]; // chi cho phep nhung file nay up len
            if (in_array($exName,$allow)){ // neu duoi file trong dnah sach dc up len
                if ($fileSize <10000000){ // kich thuoc phai nho hon 10MB
                    try {
                        $file->move("upload",$fileName);
                        $image = $fileName;
                    }catch (\Exception $e){}
                }
            }
        }

        try {
            Product::create([
                "name"=>$request->get("name"),
                "image" =>$image,
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
