<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('about');
    }

    public function shop(Request $request)
    {
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

        return view('store', compact('products', 'categories'));
    }

    public function single($locale, $id)
    {
        app()->setLocale($locale);

        $product = Product::findOrFail($id);

        return view('single', compact('product'));
    }

    public function footerCategory()
    {
        $categories = Category::limit(5)->get();
        return view('helpers.footer' , compact('categories'));
    }
}
