<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Amado - Furniture Ecommerce Template | Checkout</title>

    <!-- Favicon  -->
    <link rel="icon" href="dist/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="dist/css/core-style.css">
    <link rel="stylesheet" href="dist/style.css">

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
                            <button type="submit"><img src="dist/img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt=""></a>
            </div>
           <!-- Amado Nav -->
<nav class="amado-nav">
    <ul>
        @if(Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/profil" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="brand-text font-weight-bold">
                        <b>{{ Auth::user()->name }}</b>
                    </span>
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

<!-- <li class="{{ request()->routeIs('cart') ? 'active' : '' }}">
    <a href="{{ route('cart') }}">Cart</a>
</li> -->
<!-- <li class="{{ request()->routeIs('checkout') ? 'active' : '' }}">
    <a href="{{ route('checkout') }}">Checkout</a>
</li> -->
    </ul>
</nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="{{ route('cart') }}" class="cart-nav">
    <img src="{{ asset('dist/img/core-img/cart.png') }}" alt=""> Cart <span>({{ $cartItemCount }})</span>
</a>
                <a href="#" class="fav-nav"><img src="dist/img/core-img/favorites.png" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="dist/img/core-img/search.png" alt=""> Search</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('checkout.submit') }}" method="POST" class="row w-100">
                @csrf
                
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h2>Checkout</h2>
                        </div>

                        <!-- Checkbox untuk memilih memesan untuk siapa -->
                        <div class="col-12 mb-3 px-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="isi_dari_profil" onclick="isiDariProfil()">
                                <label class="form-check-label" for="isi_dari_profil">
                                    Pesan untuk diri sendiri (gunakan data dari profil)
                                </label>
                            </div>
                        </div>

                        <!-- Input Nama -->
                        <div class="col-12 mb-3 px-0">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                        </div>

                        <!-- Input Alamat -->
                        <div class="col-12 mb-3 px-0">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" required>
                        </div>

                        <!-- Input No HP -->
                        <div class="col-12 mb-3 px-0">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required>
                        </div>

                        <!-- Hilangkan payment method di sini untuk hindari duplikat -->
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Cart Total</h5>
                        <ul class="summary-table">
                            <li><span>Subtotal:</span> <span>Rp.{{ number_format($subtotal, 2) }}</span></li>
                            <li><span>Delivery:</span> <span>{{ $delivery == 0 ? 'Free' : 'Rp.' . number_format($delivery, 2) }}</span></li>
                            <li><span>Total:</span> <span>Rp.{{ number_format($total, 2) }}</span></li>
                        </ul>

                        <!-- Payment Method (hanya 1 tempat supaya tidak duplikat) -->
                        <div class="payment-method mt-4">
                            <div class="custom-control custom-radio mr-sm-2">
                                <input type="radio" class="custom-control-input" id="cod" name="payment_method" value="cod" checked>
                                <label class="custom-control-label" for="cod">Cash on Delivery</label>
                            </div>

                            <div class="custom-control custom-radio mr-sm-2 mt-2">
                                <input type="radio" class="custom-control-input" id="qris" name="payment_method" value="qris">
                                <label class="custom-control-label" for="qris">
                                    Qris
                                    <img class="ml-2" src="dist/img/core-img/qris.png" alt="Qris" style="height: 20px;">
                                </label>
                            </div>
                        </div>

                        <!-- Tombol submit untuk checkout -->
                        <div class="cart-btn mt-4">
                            <button type="submit" class="btn amado-btn w-100">Checkout</button>
                        </div>
                    </div>
                </div>
            </form> <!-- Tutup form di sini -->
        </div>
    </div>
</div>

<script>
    function isiDariProfil() {
        const checkbox = document.getElementById('isi_dari_profil');
        if (checkbox.checked) {
            document.getElementById('nama').value = @json(Auth::user()->name);
            document.getElementById('alamat').value = @json(Auth::user()->alamat ?? '');
            document.getElementById('no_hp').value = @json(Auth::user()->no_hp ?? '');
        } else {
            document.getElementById('nama').value = '';
            document.getElementById('alamat').value = '';
            document.getElementById('no_hp').value = '';
        }
    }
</script>


    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
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
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.html"><img src="dist/img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="dist/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="dist/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="dist/js/plugins.js"></script>
    <!-- Active js -->
    <script src="dist/js/active.js"></script>

</body>

</html>