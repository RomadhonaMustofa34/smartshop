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
  }
</style>

<h2 class="mb-4 section-title">Upload Produk Baru</h2>


    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form Upload --}}
    <div class="card shadow-sm mb-5" style="max-width: 700px;">
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Produk</label>
                    <input placeholder="Masukkan nama produk" type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label fw-semibold">Harga Produk (Rp)</label>
                    <input placeholder="Masukkan harga produk" type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" min="0" required>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Masukkan deskripsi produk..." required>{{ old('description') }}</textarea>
                </div>

                <div class="col-12">
                    <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                </div>

                <div class="col-12 text-end">
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
                    <td>{{ Str::limit($product->description, 70) }}</td>
                    <td class="text-success fw-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('produk.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center fst-italic text-muted">Belum ada produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
