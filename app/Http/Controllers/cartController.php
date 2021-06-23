<?php

namespace App\Http\Controllers;

use Cart;
use App\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // add the product to cart
        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'description'=> $product->description,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));



        return redirect()->route('cart.index');

    }

    public function index()
    {

        $cartItems = \Cart::session(auth()->id())->getContent();


        return view('cart.index', compact('cartItems'));
    }
}