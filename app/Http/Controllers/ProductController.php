<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function show($cat, $product_id) {
    	$item = Product::where('id', $product_id)->first();

    	return view('product.show', ['item' => $item]);
    }

    public function showCategory(Request $request, $cat_alias) {
    	$cat = Category::where('alias', $cat_alias)->first();

    	$pagination = 2;
    	$products = Product::where('category_id', $cat->id)->paginate($pagination);
    		if(isset($request->orderBy)){

    			if($request->orderBy == 'price-low-high'){
    			$products = Product::where('category_id', $cat->id)->orderBy('price')->paginate($pagination);
    			}

    			if($request->orderBy == 'price-high-low'){
    			$products = Product::where('category_id', $cat->id)->orderBy('price', 'desc')->paginate($pagination);
    			}

    			if($request->orderBy == 'name-a-z'){
    			$products = Product::where('category_id', $cat->id)->orderBy('title')->paginate($pagination);
    			}

    			if($request->orderBy == 'name-z-a'){
    			$products = Product::where('category_id', $cat->id)->orderBy('title', 'desc')->paginate($pagination);
    			}
    		}
    	
    	if($request->ajax()){
    		return view('ajax.order-by', ['products' => $products])->render();
    	}
    	
    	return view('categories.index', ['cat' => $cat, 'products' => $products]);

    }
}
 