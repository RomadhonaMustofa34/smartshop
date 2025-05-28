<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        $subtotal = $cartItems->sum(function ($item) {
            return optional($item->product)->price * $item->quantity;
        });

        // Hitung total quantity barang
        $totalItems = $cartItems->sum('quantity');

        // Ongkir per item
        $ongkir_per_item = 3000;

        // Threshold subtotal untuk gratis ongkir
        $threshold = 100000;

        // Logika ongkir
        if ($subtotal >= $threshold) {
            $delivery = 0;
        } else {
            $delivery = $totalItems * $ongkir_per_item;
        }

        $total = $subtotal + $delivery;

        return view('home.checkout', compact('cartItems', 'subtotal', 'delivery', 'total'));
    }


}
