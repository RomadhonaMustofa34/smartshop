<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan daftar produk
    public function index()
    {
        $products = Product::latest()->get();
        return view('produk.index', compact('products'));
    }

    // Simpan produk baru
   public function store(Request $request)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'description' => 'required|string',
        'image'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePath = $request->file('image')->store('products', 'public');

    Product::create([
        'name'        => $request->name,
        'price'       => $request->price,
        'description' => $request->description,
        'image'       => $imagePath,
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diupload!');
}


    // Tampilkan form edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('produk.edit', compact('product'));
    }

    // Update data produk
    public function update(Request $request, $id)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'description' => 'required|string',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $product = Product::findOrFail($id);

    // Jika ada file gambar baru, simpan dan update pathnya
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    // Update data lainnya
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    $product->save();

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
}


    // Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
