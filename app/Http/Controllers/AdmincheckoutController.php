<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Product;

class AdmincheckoutController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::with('product')->latest()->get();

        // Hitung total seluruh transaksi (price x quantity)
        $totalKeseluruhan = $checkouts->sum(function ($checkout) {
            return optional($checkout->product)->price * $checkout->quantity;
        });

        return view('admincheckout.index', compact('checkouts', 'totalKeseluruhan'));
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:diproses,dikemas,dikirim,selesai,return,ditolak,dibatalkan',
    ]);

    $checkout = Checkout::findOrFail($id);
    $checkout->status = $request->status;
    $checkout->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
}


}
