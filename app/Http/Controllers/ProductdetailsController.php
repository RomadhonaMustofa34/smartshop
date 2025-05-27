<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductdetailsController extends Controller
{
    public function index()
    {
        return view('home.productdetails');
    }

     public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('home.productdetails', compact('product'));
    }

}
