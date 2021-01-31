<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {

    	return view('cart.index');
    }

    public function addToCart(Request $request) {

    	$product = Product::where('id', $request->id)->first();

    	if(!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
    	$uniqid = 0;
    	$cart_id = isset($_COOKIE['cart_id']) ? $_COOKIE['cart_id'] : $uniqid;

    	\Cart::session($cart_id);

    	Cart::add ([
     'id' => $product->id, // уникальный идентификатор строки 
    'name' => $product->title,
     'price' => $product->new_price ? $product->new_price : $product->price,
     'quantity' => (int)$request->$qty,
     'attributes' => [
     	'img' => isset($product->images[0]) ? $product->images[0] : 'discout.png'
     	]
	]);

    	return responce()->json(['id' => $request->id]);
    }
}
