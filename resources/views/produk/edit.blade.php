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
        margin-left: auto;
        margin-right: auto;
      }
      button.btn-primary {
        border-radius: 2rem;
        padding: 0.5rem 2rem;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
      }
      button.btn-primary:hover {
        background-color: #0b5ed7;
        box-shadow: 0 6px 12px rgba(11, 94, 215, 0.5);
      }
      img#imagePreview {
        max-width: 150px;
        margin-top: 10px;
        display: none;
        border-radius: 0.5rem;
      }
      .kategori-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
      }
      .kategori-row > div {
        flex: 1;
        min-width: 0;
      }
    </style>

    <h2 class="mb-4 section-title text-center">Edit Produk</h2>

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
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                           class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Nama produk wajib diisi.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">Harga Produk (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" 
                           class="form-control @error('price') is-invalid @enderror" min="0" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Harga produk wajib diisi dan tidak boleh negatif.</div>
                    @enderror
                </div>

                <div class="kategori-row">
                    <div>
                        <label for="category_id" class="form-label fw-semibold">Kategori Produk</label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="new_category" class="form-label fw-semibold">Atau Tambah Kategori Baru</label>
                        <input type="text" name="new_category" id="new_category" 
                               class="form-control @error('new_category') is-invalid @enderror" 
                               placeholder="Masukkan kategori baru" value="{{ old('new_category') }}">
                        <small class="text-muted">Kosongkan jika memilih dari daftar di atas</small>
                        @error('new_category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="4" 
                              class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="invalid-feedback">Deskripsi produk wajib diisi.</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="gambar produk" class="img-thumbnail" id="currentImage" style="border-radius: 0.5rem;">
                    </div>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>

                    <img id="imagePreview" alt="Preview Gambar Baru" />
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

{{-- Bootstrap 5 client-side validation --}}
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

{{-- Toggle disable input kategori baru dan select kategori --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category_id');
    const newCategoryInput = document.getElementById('new_category');

    function toggleInputs() {
        if (categorySelect.value) {
            newCategoryInput.disabled = true;
        } else {
            newCategoryInput.disabled = false;
        }

        if (newCategoryInput.value.trim() !== '') {
            categorySelect.disabled = true;
        } else {
            categorySelect.disabled = false;
        }
    }

    toggleInputs();

    categorySelect.addEventListener('change', toggleInputs);
    newCategoryInput.addEventListener('input', toggleInputs);
});
</script>

{{-- Preview image before upload --}}
<script>
document.getElementById('image').addEventListener('change', function(event) {
    const preview = document.getElementById('imagePreview');
    const currentImage = document.getElementById('currentImage');

    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if(currentImage) currentImage.style.display = 'none';
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
        if(currentImage) currentImage.style.display = 'block';
    }
});
</script>

@endsection
