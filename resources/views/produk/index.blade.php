@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('content')
<div class="container mt-5">
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

      /* Custom styling for inputs */
      input.form-control,
      select.form-select,
      textarea.form-control {
        border-radius: 0.5rem;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
      }
      input.form-control:focus,
      select.form-select:focus,
      textarea.form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
        outline: none;
      }

      /* Label styling */
      label.form-label {
        font-weight: 600;
        color: #212529;
      }

      /* Button styling */
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

      /* Responsive textarea */
      textarea.form-control {
        resize: vertical;
        min-height: 120px;
      }

      /* Small helper text */
      small.text-muted {
        font-size: 0.85rem;
      }

      /* Flex container for kategori fields */
      .kategori-row {
        display: flex;
        gap: 1rem;
      }

      .kategori-row > div {
        flex: 1;
        min-width: 0; /* prevent flex overflow */
      }
    </style>

    <h2 class="mb-4 section-title text-center">Upload Produk Baru</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Upload --}}
    <div class="card shadow-sm mb-5 mx-auto" style="max-width: 700px;">
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input placeholder="Masukkan nama produk" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Harga Produk (Rp)</label>
                    <input placeholder="Masukkan harga produk" type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" min="0" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 kategori-row">
                    <div>
                        <label for="category_id" class="form-label">Kategori Produk</label> <br>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="new_category" class="form-label">Atau Tambah Kategori Baru</label>
                        <input type="text" name="new_category" id="new_category" class="form-control @error('new_category') is-invalid @enderror" placeholder="Masukkan kategori baru" value="{{ old('new_category') }}">
                        <small class="text-muted">Kosongkan jika memilih dari daftar di atas</small>
                        @error('new_category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Deskripsi Produk</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Masukkan deskripsi produk..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">Upload Produk</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Produk --}}
    <h3 class="mb-3 text-secondary fw-semibold">Daftar Produk</h3>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 10%">Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th style="width: 15%">Harga</th>
                    <th style="width: 18%">Tanggal Upload</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="gambar {{ $product->name }}" class="img-thumbnail" style="max-width: 80px; height: auto;">
                    </td>
                    <td class="fw-semibold">{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Tidak ada' }}</td>
                    <td>{{ Str::limit($product->description, 70) }}</td>
                    <td class="text-success fw-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('produk.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center fst-italic text-muted">Belum ada produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

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

        if (newCategoryInput.value.trim().length > 0) {
            categorySelect.disabled = true;
        } else {
            categorySelect.disabled = false;
        }
    }

    categorySelect.addEventListener('change', toggleInputs);
    newCategoryInput.addEventListener('input', toggleInputs);

    toggleInputs();
});
</script>
@endsection
