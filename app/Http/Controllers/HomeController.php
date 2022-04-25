<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'categories' => Category::all(),
            'subCategories' => Subcategory::all(),
        ]);
    }
    public function addProduct(Request $request){
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->price = $request->price;
        $product->thumbnail = $request->thumbnail;
        $product->save();
        // return response()->json($product);
    }
    public function fetchProduct(){
        $product = Product::all();
        return response()->json([
            'products' => $product
        ]);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status'=>200,
            'message' => 'Product deleted',
        ]);

    }
}
