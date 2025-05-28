<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{

public function add(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to add items to cart.');
    }

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = Cart::where('user_id', Auth::id())
        ->where('product_id', $request->product_id)
        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity', $request->quantity);
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
    }

    return redirect()->back()->with('success', 'Product added to cart!');
}



    public function index()
    {
        $cartItems = Cart::with('product') // eager load produk
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Hitung total item (jumlah barang)
        $totalItems = $cartItems->sum('quantity');

        // Ongkir per item (misal Rp 3000)
        $ongkir_per_item = 3000;

        // Threshold subtotal agar dapat gratis ongkir (misal Rp 100000)
        $threshold = 100000;

        // Logika ongkir
        if ($subtotal >= $threshold) {
            $delivery = 0;
        } else {
            $delivery = $totalItems * $ongkir_per_item;
        }

        $total = $subtotal + $delivery;

        return view('home.cart', compact('cartItems', 'subtotal', 'delivery', 'total'));
    }

    public function update(Request $request, $itemId)
    {
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity === 0) {
            // Hapus item dari keranjang
            Cart::where('id', $itemId)->delete();
        } else {
            // Update quantity biasa
            Cart::where('id', $itemId)->update(['quantity' => $quantity]);
        }

        return redirect()->back();
    }

    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }


}
