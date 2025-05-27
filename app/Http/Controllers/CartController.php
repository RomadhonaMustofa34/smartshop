<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // public function index()
    // {
    //     return view('home.cart');
    // }

    public function add(Request $request)
    {
        // Validasi input minimal
        $request->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Contoh sederhana: simpan data keranjang di session
        $cart = session()->get('cart', []);

        if(isset($cart[$productId])){
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Biasanya ambil produk dari DB, tapi disini dummy:
            $cart[$productId] = [
                "quantity" => $quantity,
                // tambahkan data lain jika perlu, misal nama, harga
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Contoh method index untuk lihat isi keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('home.cart', compact('cart'));
    }
}
