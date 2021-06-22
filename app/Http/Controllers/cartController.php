<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class cartController extends Controller
{
    public function add(Product $product)
    {
        dd($product);

        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'description'=> $product->description,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));
        return back();
    }
    public function index()
    {
        return view('cart.index');
    }
}
