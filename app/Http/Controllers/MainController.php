<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $footer_categories = Category::limit(5)->get();
        return view('about' , compact('footer_categories'));
    }

    public function shop(Request $request)
    {

        $footer_categories = Category::limit(4)->get();
        $query = Product::with('category');

        $categories = Category::all();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name_uz', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name_uz', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->get();

        return view('store', compact('products', 'categories' , 'footer_categories'));
    }

    public function single($locale, $id)
    {
        $footer_categories = Category::limit(4)->get();
        app()->setLocale($locale);

        $product = Product::findOrFail($id);

        return view('single', compact('product' , 'footer_categories'));
    }

}
