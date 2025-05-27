@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Upload Produk Baru</h2>

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tampilkan error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Upload --}}
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <table class="table table-borderless" style="max-width: 600px;">
            <tr>
                <td><label for="name" class="form-label">Nama Produk</label></td>
                <td>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </td>
            </tr>
            <tr>
                <td><label for="price" class="form-label">Harga Produk</label></td>
                <td>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
                </td>
            </tr>
            <tr>
                <td><label for="description" class="form-label">Deskripsi Produk</label></td>
                <td>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Masukkan deskripsi produk..." required>{{ old('description') }}</textarea>
                </td>
            </tr>
            <tr>
                <td><label for="image" class="form-label">Gambar Produk</label></td>
                <td>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">Upload Produk</button></td>
            </tr>
        </table>
    </form>

    {{-- Tabel Daftar Produk --}}
    <h3 class="mb-3">Daftar Produk</h3>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="gambar" width="80"></td>
                <td>{{ $product->name }}</td>
                <td>{{ Str::limit($product->description, 50) }}</td>
                <td>Rp.{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
