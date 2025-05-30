<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Amado - Furniture Ecommerce Template | Checkout</title>
    <link rel="icon" href="dist/img/core-img/favicon.ico" />
    <link rel="stylesheet" href="dist/css/core-style.css" />
    <link rel="stylesheet" href="dist/style.css" />
</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close" role="button" aria-label="Close search">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <!-- Search form -->
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav -->
        <div class="mobile-nav">
            <div class="amado-navbar-brand">
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt="Amado Logo" /></a>
            </div>
            <div class="amado-navbar-toggler" role="button" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close" role="button" aria-label="Close navigation">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt="Amado Logo" /></a>
            </div>

            <!-- Navigation -->
            <nav class="amado-nav" role="navigation" aria-label="Primary Navigation">
                <ul>
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/profil" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                <b>{{ Auth::user()->name }}</b>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                        @csrf
                                        <button type="submit" class="btn btn-link dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"><b>Guest (Login)</b></a></li>
                    @endif

                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="{{ request()->routeIs('shop') ? 'active' : '' }}">
                        <a href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="{{ request()->routeIs('pesanan') ? 'active' : '' }}">
                        <a href="{{ route('pesanan') }}">Order</a>
                    </li>
                </ul>
            </nav>

            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>

            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="{{ route('cart') }}" class="cart-nav" aria-label="View cart">
                    <img src="{{ asset('dist/img/core-img/cart.png') }}" alt="Cart icon" /> Cart <span>({{ $cartItemCount ?? 0 }})</span>
                </a>
                <a href="#" class="fav-nav" aria-label="View favourites"><img src="dist/img/core-img/favorites.png" alt="Favorites icon" /> Favourite</a>
                <a href="#" class="search-nav" aria-label="Search products"><img src="dist/img/core-img/search.png" alt="Search icon" /> Search</a>
            </div>

            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between" role="list">
                <a href="#" role="listitem" aria-label="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#" role="listitem" aria-label="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#" role="listitem" aria-label="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#" role="listitem" aria-label="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">

                    {{-- Notifikasi sukses dan error --}}
                    <div class="col-12 mb-3">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('checkout.submit') }}" method="POST" class="row w-100 needs-validation" novalidate>
                        @csrf
                        <div class="col-12 col-lg-8">
                            <div class="checkout_details_area mt-50 clearfix">

                                <div class="cart-title">
                                    <h2>Checkout</h2>
                                </div>

                                <!-- Checkbox Pesan untuk diri sendiri -->
                                <div class="col-12 mb-3 px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="isi_dari_profil" aria-describedby="profilHelp" onclick="isiDariProfil()">
                                        <label class="form-check-label" for="isi_dari_profil">
                                            Pesan untuk diri sendiri (gunakan data dari profil)
                                        </label>
                                        <small id="profilHelp" class="form-text text-muted">Gunakan data yang tersimpan pada profil Anda.</small>
                                    </div>
                                </div>

                                <!-- Input Nama -->
                                <div class="col-12 mb-3 px-0">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required value="{{ old('nama') }}" />
                                    <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                                </div>

                                <!-- Input Alamat -->
                                <div class="col-12 mb-3 px-0">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" required value="{{ old('alamat') }}" />
                                    <div class="invalid-feedback">Alamat lengkap wajib diisi.</div>
                                </div>

                                <!-- Input No HP -->
                                <div class="col-12 mb-3 px-0">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" pattern="^[0-9+\-\s]*$" required value="{{ old('no_hp') }}" />
                                    <div class="invalid-feedback">Nomor HP wajib diisi dan hanya boleh angka, spasi, tanda + dan -.</div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="cart-summary">
                                <h5>Cart Total</h5>
                                <ul class="summary-table">
                                    <li><span>Subtotal:</span> <span>Rp.{{ number_format($subtotal ?? 0, 2) }}</span></li>
                                    <li><span>Delivery:</span> <span>{{ ($delivery ?? 0) == 0 ? 'Free' : 'Rp.' . number_format($delivery ?? 0, 2) }}</span></li>
                                    <li><span>Total:</span> <span>Rp.{{ number_format($total ?? 0, 2) }}</span></li>
                                </ul>

                                <!-- Payment Method -->
                                <fieldset class="payment-method mt-4" aria-label="Payment Method">
                                    <legend>Pilih Metode Pembayaran</legend>
                                    <div class="custom-control custom-radio mr-sm-2">
                                        <input type="radio" class="custom-control-input" id="cod" name="payment_method" value="cod" checked />
                                        <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                    </div>

                                    <div class="custom-control custom-radio mr-sm-2 mt-2">
                                        <input type="radio" class="custom-control-input" id="qris" name="payment_method" value="qris" />
                                        <label class="custom-control-label" for="qris">
                                            Qris
                                            <img class="ml-2" src="dist/img/core-img/qris.png" alt="Logo QRIS" style="height: 20px;" />
                                        </label>
                                    </div>
                                </fieldset>

                                <div class="cart-btn mt-4">
                                    <button type="submit" class="btn amado-btn w-100">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
     <!-- ##### Main Content Wrapper End ##### -->

    <!-- Newsletter Area -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur.</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <div class="footer-logo mr-50">
                            <a href="{{ route('home') }}"><img src="{{ asset('dist/img/core-img/logo2.png') }}" alt=""></a>
                        </div>
                        <p class="copywrite">
                            &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |
                            Template by <a href="https://colorlib.com" target="_blank">Colorlib</a> |
                            Redistributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="dist/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper -->
    <script src="dist/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="dist/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins -->
    <script src="dist/js/plugins/plugins.js"></script>
    <!-- Active -->
    <script src="dist/js/active.js"></script>

    <script>
        function isiDariProfil() {
            const checkbox = document.getElementById('isi_dari_profil');
            const namaInput = document.getElementById('nama');
            const alamatInput = document.getElementById('alamat');
            const noHpInput = document.getElementById('no_hp');

            if (!checkbox.checked) {
                // Kosongkan jika tidak dicentang
                namaInput.value = '';
                alamatInput.value = '';
                noHpInput.value = '';
                return;
            }

            @if(Auth::check())
                // Isi dari data user yang sudah login
                namaInput.value = @json(Auth::user()->name);
                alamatInput.value = @json(Auth::user()->alamat ?? '');
                noHpInput.value = @json(Auth::user()->no_hp ?? '');
            @else
                alert('Silakan login untuk menggunakan fitur ini.');
                checkbox.checked = false;
            @endif
        }

        // Validasi form bootstrap 4+
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>
