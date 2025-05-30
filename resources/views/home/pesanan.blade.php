<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Amado - Furniture Ecommerce Template | Cart</title>

    <link rel="icon" href="dist/img/core-img/favicon.ico">
    <link rel="stylesheet" href="dist/css/core-style.css">
    <link rel="stylesheet" href="dist/style.css">

    <!-- Penyesuaian font agar konsisten dengan menu -->
    <style>
        /* Samakan font dan ukuran dengan menu navigasi */
        .container .card-body,
        .container h2,
        .container .alert,
        .container ul,
        .container li,
        .container span,
        .container strong {
            font-family: 'Open Sans', sans-serif; /* Sesuaikan dengan font utama template */
            font-size: 16px; /* Ukuran font dasar di menu */
            color: #333;
        }

        .container h5 {
            font-size: 18px;
            font-weight: 600;
        }

        .badge {
            font-size: 14px;
        }

        .list-unstyled.small {
            font-size: 15px;
        }

        .alert-info {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit">
                                <img src="dist/img/core-img/search.png" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- Main Content Wrapper Start -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav -->
        <div class="mobile-nav">
            <div class="amado-navbar-brand">
                <a href="{{ url('/') }}">
                    <img src="dist/img/core-img/logo.png" alt="">
                </a>
            </div>
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>

            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="dist/img/core-img/logo.png" alt="">
                </a>
            </div>

            <nav class="amado-nav">
                <ul>
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/profil" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="brand-text font-weight-bold"><b>{{ Auth::user()->name }}</b></span>
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

            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>

            <div class="cart-fav-search mb-100">
                <a href="{{ route('cart') }}" class="cart-nav">
                    <img src="{{ asset('dist/img/core-img/cart.png') }}" alt=""> Cart <span>({{ $cartItemCount }})</span>
                </a>
                <a href="#" class="fav-nav">
                    <img src="dist/img/core-img/favorites.png" alt=""> Favourite
                </a>
                <a href="#" class="search-nav">
                    <img src="dist/img/core-img/search.png" alt=""> Search
                </a>
            </div>

            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

       <!-- Detail Pesanan -->
<div class="container my-5">
    <h2 class="text-left fw-bold mb-4 text-dark">🛒 Detail & Riwayat Pesanan Anda</h2>

    @if($checkouts->isEmpty())
        <div class="alert alert-info text-center shadow-sm rounded-3">
            <i class="fa fa-box-open fa-2x mb-2 d-block"></i>
            Belum ada pesanan yang dilakukan.
        </div>
    @else
        <div class="row g-4">
            @foreach($checkouts as $checkout)
                @php
                    $statusInfo = match($checkout->status) {
                        'diproses'   => ['color' => '#5bc0de', 'icon' => 'fa-hourglass-half'],
                        'dikemas'    => ['color' => '#f0ad4e', 'icon' => 'fa-cube'],
                        'dikirim'    => ['color' => '#0275d8', 'icon' => 'fa-truck'],
                        'selesai'    => ['color' => '#5cb85c', 'icon' => 'fa-check-circle'],
                        'ditolak'    => ['color' => '#d9534f', 'icon' => 'fa-times-circle'],
                        'dibatalkan' => ['color' => '#6c757d', 'icon' => 'fa-ban'],
                        'return' => ['color' => '#6c757d', 'icon' => 'fa-ban'],
                        default      => ['color' => '#6c757d', 'icon' => 'fa-question-circle'],
                    };
                @endphp

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                @if($checkout->product && $checkout->product->image)
                                    <img src="{{ asset('storage/' . $checkout->product->image) }}"
                                        alt="{{ $checkout->product->name }}"
                                        class="rounded me-3"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded me-3 d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                                        <i class="fa fa-image text-muted"></i>
                                    </div>
                                @endif
                                
                                <!-- Container teks dengan flex kolom, center align -->
                                <div class="flex-grow-1 d-flex flex-column justify-content-center align-items-center text-center">
                                    <h5 class="mb-1 text-capitalize">{{ $checkout->product->name ?? 'Produk tidak tersedia' }}</h5>
                                    <div style="display: flex; align-items: center; gap: 6px; font-weight: normal; color: {{ $statusInfo['color'] }}80;">
                                        <i class="fa {{ $statusInfo['icon'] }}" aria-hidden="true"></i>
                                        <span style="text-transform: capitalize;">{{ $checkout->status }}</span>
                                    </div>
                                </div>

                            </div>

                            <ul class="list-unstyled small mb-0 mt-auto">
                                <li><strong>Jumlah:</strong> {{ $checkout->quantity }}</li>
                                <li>
                                    <strong>Total:</strong>
                                    @if($checkout->product)
                                        Rp{{ number_format($checkout->product->price * $checkout->quantity, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<!-- Detail Pesanan End -->



    </div>
    <!-- Main Content Wrapper End -->

    <!-- Newsletter Area -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
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
                            <a href="index.html">
                                <img src="dist/img/core-img/logo2.png" alt="">
                            </a>
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

    <!-- JS Plugins -->
    <script src="dist/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="dist/js/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/plugins.js"></script>
    <script src="dist/js/active.js"></script>

</body>

</html>
