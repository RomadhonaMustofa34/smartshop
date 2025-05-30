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
                                <th>Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkouts as $checkout)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: left;">{{ $checkout->nama }}</td>
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
                                    <td>{{ $checkout->created_at->format('d-m-Y') }}</td>
                                    <td>
    @php
    $statusClass = '';
    $statusClass = match ($checkout->status) {
    'diproses'   => 'bg-info text-white',
    'dikemas'    => 'bg-warning text-dark',
    'dikirim'    => 'bg-primary text-white',
    'selesai'    => 'bg-success text-white',
    'return'     => 'bg-warning text-white',
    'ditolak'    => 'bg-danger text-white',
    'dibatalkan' => 'bg-secondary text-white',
    default      => 'bg-light text-dark',
};
@endphp

<form action="{{ route('admincheckout.updateStatus', $checkout->id) }}" method="POST">
    @csrf
    @method('PUT')
    <select name="status" class="form-select form-select-sm {{ $statusClass }}" onchange="this.form.submit()">
    <option value="diproses" {{ $checkout->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
    <option value="dikemas" {{ $checkout->status == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
    <option value="dikirim" {{ $checkout->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
    <option value="selesai" {{ $checkout->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    <option value="return" {{ $checkout->status == 'return' ? 'selected' : '' }}>Return</option>
    <option value="ditolak" {{ $checkout->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
    <option value="dibatalkan" {{ $checkout->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
</select>

</form>

</td>

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
