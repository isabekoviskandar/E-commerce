<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function getCart()
    {
        $sessionId = session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function add(Request $request, $locale, $id)
    {
        $product = Product::findOrFail($id);
        $cart = $this->getCart();

        $item = $cart->items()->where('product_id', $id)->first();

        if ($item) {
            $item->increment('quantity', $request->get('quantity', 1));
        } else {
            $cart->items()->create([
                'product_id' => $id,
                'quantity' => $request->get('quantity', 1),
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $locale)
    {
        $cart = $this->getCart();

        if ($request->quantities) {
            foreach ($request->quantities as $id => $quantity) {
                $item = $cart->items()->where('product_id', $id)->first();
                if ($item) {
                    if ($quantity <= 0) {
                        $item->delete();
                    } else {
                        $item->update(['quantity' => $quantity]);
                    }
                }
            }
        }

        return redirect()->route('cart.index', ['locale' => $locale])
            ->with('success', 'Cart updated successfully!');
    }

    public function index($locale)
    {
        $footer_categories = Category::limit(4)->get();
        $cart = $this->getCart()->load('items.product');

        return view('cart', compact('cart', 'footer_categories'));
    }

    public function remove($locale, $id)
    {
        $cart = $this->getCart();
        $cart->items()->where('product_id', $id)->delete();

        return redirect()->route('cart.index', ['locale' => $locale])
            ->with('success', 'Product removed from cart!');
    }

    public function clear($locale)
    {
        $cart = $this->getCart();
        $cart->items()->delete();

        return redirect()->route('cart.index', ['locale' => $locale])
            ->with('success', 'Cart cleared successfully!');
    }

    public function checkout($locale)
    {
        $footer_categories = Category::limit(4)->get();

        $cart = $this->getCart();
        $cartItems = $cart ? $cart->items()->with('product')->get() : collect();

        return view('checkout', compact('cartItems', 'footer_categories'));
    }
}
