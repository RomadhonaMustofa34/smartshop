<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'date');
        $view = (int) $request->query('view', 12);

        $query = Product::query();

        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        $products = $query->paginate($view)->appends(['sort' => $sort, 'view' => $view]);

        $categories = Category::all();

        return view('home.shop', compact('products', 'sort', 'view', 'categories'));
    }

    public function byCategory(Request $request, $id)
    {
        $sort = $request->query('sort', 'date');
        $view = (int) $request->query('view', 12);

        $query = Product::where('category_id', $id);

        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        $products = $query->paginate($view)->appends(['sort' => $sort, 'view' => $view]);

        $categories = Category::all();
        $selectedCategory = Category::findOrFail($id);

        return view('home.shop', compact('products', 'sort', 'view', 'categories', 'selectedCategory'));
    }
}
