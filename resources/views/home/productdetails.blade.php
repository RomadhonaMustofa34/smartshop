<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Amado - Furniture Ecommerce Template | Product Details</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('dist/img/core-img/favicon.ico') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('dist/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/style.css') }}">

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
                            <button type="submit"><img src="{{ asset('dist/img/core-img/search.png') }}" alt=""></button>
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
                <a href="{{ route('home') }}"><img src="{{ asset('dist/img/core-img/logo.png') }}" alt=""></a>
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
                <a href="{{ route('home') }}"><img src="{{ asset('dist/img/core-img/logo.png') }}" alt=""></a>
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

                <a href="#" class="fav-nav">
                    <img src="{{ asset('dist/img/core-img/favorites.png') }}" alt=""> Favourite
                </a>
                <a href="#" class="search-nav">
                    <img src="{{ asset('dist/img/core-img/search.png') }}" alt=""> Search
                </a>
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

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name ?? 'Detail Produk' }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                {{-- Pesan sukses tambah ke keranjang --}}
                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <img class="d-block w-100" src="{{ asset('storage/' . ($product->image ?? 'default.png')) }}" alt="{{ $product->name ?? 'Product Image' }}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">Rp.{{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                <h6>{{ $product->name ?? 'Nama Produk' }}</h6>

                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="review">
                                        <a href="#">Write A Review</a>
                                    </div>
                                </div>

                                <!-- Availability -->
                                <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                            </div>

                            <!-- Product Description -->
                            <div class="short_overview my-5">
                                <p>{{ $product->description ?? 'Tidak ada deskripsi produk.' }}</p>
                            </div>

                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add') }}" method="POST" class="cart clearfix">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">

                                <div class="cart-btn d-flex mb-50">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var qtyInput = document.getElementById('qty'); if(qtyInput.value > 1) qtyInput.value--; return false;">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                        <span class="qty-plus" onclick="var qtyInput = document.getElementById('qty'); qtyInput.value++; return false;">
                                            <i class="fa fa-caret-up" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>

                                <button type="submit" class="btn amado-btn">Add to cart</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->

    </div>
    <!-- ##### Main Content Wrapper End ##### -->

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
                            <a href="{{ route('home') }}"><img src="{{ asset('dist/img/core-img/logo2.png') }}" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite">
                            &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by Colorlib
                        </p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="nav-item"><a href="{{ route('shop') }}">Shop</a></li>
                                    <li class="nav-item"><a href="{{ route('cart') }}">Cart</a></li>
                                    <li class="nav-item"><a href="{{ route('checkout') }}">Checkout</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('dist/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('dist/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('dist/js/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('dist/js/active.js') }}"></script>

</body>

</html>
