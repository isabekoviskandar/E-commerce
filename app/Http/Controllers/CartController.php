<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, $locale, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
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

    public function update(Request $request , $locale)
    {
        $cart = session()->get('cart');

        if ($request->quantities) {
            foreach ($request->quantities as $id => $quantity) {
                if ($quantity <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]["quantity"] = $quantity;
                }
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index' , ['locale' , $locale])->with('success', 'Cart updated successfully!');
    }

    public function index($locale) // locale qo'shing
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function remove($locale, $id) // locale qo'shing
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index', ['locale' => $locale])->with('success', 'Product removed from cart!');
    }

    public function clear($locale) // locale qo'shing
    {
        session()->forget('cart');
        return redirect()->route('cart.index', ['locale' => $locale])->with('success', 'Cart cleared successfully!');
    }
}
