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

        <!-- Mobile Nav -->
        <div class="mobile-nav">
            <div class="amado-navbar-brand">
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt=""></a>
            </div>
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area -->
        <header class="header-area clearfix">
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <div class="logo">
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt=""></a>
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
<li>
    <!-- Link detail produk butuh id, jadi biasanya tidak di nav umum -->
    <!-- Hapus atau ganti sesuai kebutuhan -->
</li>
<!-- <li class="{{ request()->routeIs('cart') ? 'active' : '' }}">
    <a href="{{ route('cart') }}">Cart</a>
</li> -->
<!-- <li class="{{ request()->routeIs('checkout') ? 'active' : '' }}">
    <a href="{{ route('checkout') }}">Checkout</a>
</li> -->
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
                <a href="#" class="fav-nav"><img src="dist/img/core-img/favorites.png" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="dist/img/core-img/search.png" alt=""> Search</a>
            </div>

            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="cart-title mt-5 mb-4 text-center">
                    <h2 class="fw-bold" style="color: #343a40;">Profil Pengguna</h2>
                </div>

                <div class="card shadow-sm rounded-4 p-4" style="background-color: #ffffff;">
                    <div class="row align-items-center g-4">
                        <div class="col-md-4 text-center">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                     class="rounded-circle border border-3 border-primary" 
                                     style="width: 160px; height: 160px; object-fit: cover;" 
                                     alt="Foto Profil">
                            @else
                                <img src="https://via.placeholder.com/160" 
                                     class="rounded-circle border border-3 border-secondary" 
                                     style="width: 160px; height: 160px; object-fit: cover;" 
                                     alt="Foto Default">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-3 fw-semibold">{{ Auth::user()->name }}</h3>

                            <ul class="list-unstyled fs-6" style="color: #495057;">
    <li class="mb-2">
        <i class="fa fa-envelope me-2 text-secondary"></i> 
        <strong>Email :</strong> {{ Auth::user()->email }}
    </li>
    <li class="mb-2">
        <i class="fa fa-info-circle me-2 text-secondary"></i> 
        <strong>Alamat :</strong> {{ Auth::user()->alamat ?? 'Belum ada alamat.' }}
    </li>
    <li class="mb-2">
        <i class="fa fa-phone me-2 text-secondary"></i> 
        <strong>No HP :</strong> {{ Auth::user()->no_hp ?? 'Belum ada nomor HP.' }}
    </li>
    <li class="mb-2">
        <i class="fa fa-calendar-alt me-2 text-secondary"></i> 
        <strong>Bergabung sejak :</strong> {{ Auth::user()->created_at->format('d M Y') }}
    </li>
</ul>


                            <a href="{{ route('home.edit') }}" class="btn amado-btn px-4 mt-3">Edit Profil</a>
                        </div>
                    </div>
                </div>
            </div>
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
                            <a href="index.html"><img src="dist/img/core-img/logo2.png" alt=""></a>
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
