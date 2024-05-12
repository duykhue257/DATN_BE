<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductVariants;
use App\Models\Size;
use Illuminate\Pagination\Paginator;
use Cart;
class HomeController extends Controller
{
    //
public function home()
{
    $products = Products::with(['category', 'variants'])->get();
    // dd($products->name_cate);
    $categories = Category::all();
    return view('client.homepage', compact('products', 'categories'));
}

    
    
    
public function shop( Request $request){
    $categories = Category::all();
    $colors = Color::all();
    $sizes = Size::all();
    $product= ProductVariants::find($request->id);
    $productsQuery = Products::with('variants');
    // dd($productsQuery);

    // Sắp xếp sản phẩm theo giá (giảm dần hoặc tăng dần)
    $sort = $request->input('sort');
    if ($sort == 'desc_price') {
    $productsQuery->orderBy('price', 'desc');
    } elseif ($sort == 'asc_price') {
        $productsQuery->orderBy('price', 'asc');
    }

    //Phân trang và đếm
    $products = $productsQuery->paginate(9);
    $totalProducts = $products->total();

    Paginator::useBootstrap();

    return view('client.shop', compact('products','colors','sizes','categories'));
}

public function ProductDetail(Request $request) {
       
    $productId = $request->input('id') ?? $request->query('id');
    $product = Products::with('variants')->find($productId);
    
    $categoryProducts = Products::where('category_id', 2)->with('variants')->get();

    $numbers = range(1, 6);
        
    return view('client.detail_product', compact('product', 'categoryProducts', 'numbers'));
}

public function showHome(){
    $categories = Category::all();
    // dd($category);
    return view('client.homepage',compact('categories'));
   
} 
    
}
