<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->get('quantity', 1);
        } else {
            $cart[$id] = [
                "name" => $product->name_uz,
                "quantity" => $request->get('quantity', 1),
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart');
        
        if($request->quantities) {
            foreach($request->quantities as $id => $quantity) {
                if($quantity <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]["quantity"] = $quantity;
                }
            }
        }
        
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach($cart as $item) {
            $count += $item['quantity'];
        }
        
        return response()->json(['count' => $count]);
    }
}