<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman checkout.');
    }

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
    $delivery = $subtotal >= $threshold ? 0 : $totalItems * $ongkir_per_item;

    $total = $subtotal + $delivery;

    return view('home.checkout', compact('cartItems', 'subtotal', 'delivery', 'total'));
}


    public function submit(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_hp' => 'required|string|max:20',
        'payment_method' => 'required|string',
    ]);

    $userId = Auth::id();

    // Ambil data cart user dari database
    $cartItems = Cart::where('user_id', $userId)->get();

    if ($cartItems->isEmpty()) {
        return back()->withErrors('Keranjang belanja kosong.');
    }

    // Simpan tiap item cart ke tabel checkout
    foreach ($cartItems as $item) {
        Checkout::create([
            'user_id' => $userId,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'payment_method' => $request->payment_method,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'status' => 'diproses',
        ]);
    }

    // Hapus cart user setelah checkout berhasil
    Cart::where('user_id', $userId)->delete();

    // Redirect ke halaman pesanan atau checkout dengan notifikasi sukses
    return redirect()->route('checkout')->with('success', 'Checkout berhasil! Terima kasih telah berbelanja.');
}



}
