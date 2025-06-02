@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 700px;">
    <style>
      .section-title {
        color: #000;
        font-weight: 700;
        border-bottom: 3px solid #000;
        padding-bottom: 8px;
        max-width: max-content;
      }
    </style>

    <h2 class="mb-4 section-title">Edit Produk</h2>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                    <div class="invalid-feedback">Nama produk wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">Harga Produk (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control" min="0" required>
                    <div class="invalid-feedback">Harga produk wajib diisi dan tidak boleh negatif.</div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-semibold">Kategori Produk</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="" disabled {{ old('category_id', $product->category_id) ? '' : 'selected' }}>Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Kategori produk wajib dipilih.</div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                    <div class="invalid-feedback">Deskripsi produk wajib diisi.</div>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="gambar produk" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Optional: Bootstrap 5 client-side validation --}}
<script>
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
@endsection
