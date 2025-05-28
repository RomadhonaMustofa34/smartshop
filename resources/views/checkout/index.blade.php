@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📦 Data Checkout</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($checkouts->isEmpty())
        <div class="alert alert-warning">Belum ada data checkout.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Metode</th>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkouts as $checkout)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $checkout->nama }}</td>
                                    <td>{{ $checkout->alamat }}</td>
                                    <td>{{ $checkout->no_hp }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ strtoupper($checkout->payment_method) }}</span>
                                    </td>
                                    <td>{{ $checkout->product->name ?? '-' }}</td>
                                    <td>{{ $checkout->quantity }}</td>
                                    <td>
                                        @if($checkout->product)
                                            Rp.{{ number_format($checkout->product->price * $checkout->quantity, 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $checkout->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total Keseluruhan -->
                <div class="mt-4 text-end">
                    <h5>Total Semua Transaksi:
                        <strong class="text-success">Rp.{{ number_format($totalKeseluruhan, 2) }}</strong>
                    </h5>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
