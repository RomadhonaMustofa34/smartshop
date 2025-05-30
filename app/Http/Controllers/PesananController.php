<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Checkout;

class PesananController extends Controller
{
    public function index()
{
    if (!Auth::check()) {
        // Bisa redirect ke halaman login dengan pesan notifikasi
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk mengakses menu pesanan.');
    }

    $user = Auth::user();
    $checkouts = Checkout::with('product')->where('user_id', $user->id)->latest()->get();

    return view('home.pesanan', compact('user', 'checkouts'));
}

}
