<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter dari query string
        $sort = $request->query('sort', 'date'); // default sorting by date
        $view = (int) $request->query('view', 12); // default 12 produk per halaman

        // Query builder produk
        $query = Product::query();

        // Sorting produk sesuai pilihan user
        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } else {
            // default atau 'date'
            $query->orderBy('created_at', 'asc');
        }
        // Pagination dengan jumlah per halaman sesuai pilihan user
        $products = $query->paginate($view)->appends(['sort' => $sort, 'view' => $view]);

        return view('home.shop', compact('products', 'sort', 'view'));
    }
}
