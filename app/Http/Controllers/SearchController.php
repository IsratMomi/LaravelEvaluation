<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request){
        $category_wise = Product::where('category_id',$request->category)->get();
        $subcategory_wise = Product::where('subcategory_id', $request->sub_category)->get();
        $price_wise = Product::where('price', $request->price)->get();
        if($category_wise){
            return view('welcome')->with('datas', $category_wise);
        }
        elseif($subcategory_wise){
            return view('welcome')->with('datas', $subcategory_wise);
        }
        else{
            return view('welcome')->with('datas', $price_wise);
        }
        // $products = Product::all();
        // foreach($products as $product){
        //     if($product->category_id == $request->category || $product->subcategory_id == $request->sub_category || $product->price == $request->price){

        //         return view('welcome')->with('data', $product);
        //     }
        // }

    }
}
