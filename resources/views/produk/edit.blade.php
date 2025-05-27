@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Produk</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga Produk</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label><br>
            <img src="{{ asset('storage/' . $product->image) }}" alt="gambar" width="100" class="mb-2">
            <input type="file" name="image" id="image" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
