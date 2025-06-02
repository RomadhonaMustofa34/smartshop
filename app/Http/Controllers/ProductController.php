<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan daftar produk
    public function index()
    {
        if (Auth::check()) {
            $products = Product::latest()->get();
            $categories = Category::all();
            return view('produk.index', compact('products', 'categories'));
        }

        return redirect()->route('login')->with('error', 'You need to login first.');
    }


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'category_id' => 'nullable|exists:categories,id',
        'new_category' => 'nullable|string|max:255',
    ]);

    // Validasi minimal salah satu kategori diisi
    if (!$request->category_id && !$request->new_category) {
        return back()->withErrors(['category_id' => 'Pilih kategori atau tambah kategori baru.'])->withInput();
    }

    // Jika ada kategori baru, buat
    if ($request->filled('new_category')) {
        $category = Category::firstOrCreate(['name' => $request->new_category]);
        $category_id = $category->id;
    } else {
        $category_id = $request->category_id;
    }

    // Upload gambar
    $imagePath = $request->file('image')->store('products', 'public');

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imagePath,
        'category_id' => $category_id,
    ]);

    return redirect()->back()->with('success', 'Produk berhasil diupload.');
}
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('produk.edit', compact('product', 'categories'));
    }


    // Update data produk
    public function update(Request $request, $id)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'description' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
        'new_category' => 'nullable|string|max:255',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if (!$request->category_id && !$request->new_category) {
        return back()->withErrors(['category_id' => 'Pilih kategori atau tambah kategori baru.'])->withInput();
    }

    if ($request->filled('new_category')) {
        $category = Category::firstOrCreate(['name' => $request->new_category]);
        $category_id = $category->id;
    } else {
        $category_id = $request->category_id;
    }

    $product = Product::findOrFail($id);

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        Storage::disk('public')->delete($product->image);

        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->category_id = $category_id;
    $product->save();

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
}


    // Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
