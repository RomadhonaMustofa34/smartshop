<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Amado - Furniture Ecommerce Template | Shop</title>

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
                <a href="{{ url('/') }}"><img src="{{ asset('dist/img/core-img/logo.png') }}" alt="">
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <!-- Header Area Start -->
        <header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>

    <!-- Logo -->
    <div class="logo">
        <a href="#"><img src="{{ asset('dist/img/core-img/logo.png') }}" alt=""></a>
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
        <a href="{{ route('cart') }}" class="cart-nav">
            <img src="{{ asset('dist/img/core-img/cart.png') }}" alt=""> Cart <span>({{ $cartItemCount ?? 0 }})</span>
        </a>
        <a href="#" class="fav-nav"><img src="{{ asset('dist/img/core-img/favorites.png') }}" alt=""> Favourite</a>
        <a href="#" class="search-nav"><img src="{{ asset('dist/img/core-img/search.png') }}" alt=""> Search</a>
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

























        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li class="{{ !isset($selectedCategory) ? 'active' : '' }}">
                            <a href="{{ route('shop', ['sort' => $sort ?? 'date', 'view' => $view ?? 12]) }}">
                                All Products
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="{{ (isset($selectedCategory) && $selectedCategory->id == $category->id) ? 'active' : '' }}">
                                <a href="{{ route('shop.category', ['id' => $category->id, 'sort' => $sort ?? 'date', 'view' => $view ?? 12]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
    <div class="col-12">
        <div class="product-topbar d-xl-flex align-items-end justify-content-between">

            <!-- Total Products -->
            <div class="total-products mb-3 mb-xl-0">
                <p>
                    Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}
                </p>
            </div>

            <!-- Sorting -->
            <div class="product-controls d-flex align-items-center">
                <div class="sort-by-date d-flex align-items-center mr-15">
                    <p class="mb-0 mr-2">Sort by</p>
                    <form action="{{ url()->current() }}" method="get" id="sortForm">
                        <select name="sort" id="sortBydate" onchange="document.getElementById('sortForm').submit()">
                            <option value="date" {{ ($sort ?? '') === 'date' ? 'selected' : '' }}>Date</option>
                            <option value="newest" {{ ($sort ?? '') === 'newest' ? 'selected' : '' }}>Newest</option>
                        </select>
                        <!-- Pastikan mengirimkan parameter view supaya tidak hilang saat sort -->
                        <input type="hidden" name="view" value="{{ $view ?? 12 }}">
                    </form>
                </div>

                <!-- View -->
                <div class="view-product d-flex align-items-center ml-3">
                    <p class="mb-0 mr-2">View</p>
                    <form action="{{ url()->current() }}" method="get" id="viewForm">
                        <select name="view" id="viewProduct" onchange="document.getElementById('viewForm').submit()">
                            <option value="12" {{ ($view ?? 12) == 12 ? 'selected' : '' }}>12</option>
                            <option value="24" {{ ($view ?? 12) == 24 ? 'selected' : '' }}>24</option>
                            <option value="48" {{ ($view ?? 12) == 48 ? 'selected' : '' }}>48</option>
                            <option value="96" {{ ($view ?? 12) == 96 ? 'selected' : '' }}>96</option>
                        </select>
                        <!-- Pastikan mengirimkan parameter sort supaya tidak hilang saat view berubah -->
                        <input type="hidden" name="sort" value="{{ $sort ?? 'date' }}">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


               <div class="row">
    @forelse ($products as $product)
    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
        <div class="single-product-wrapper">
            <!-- Product Image -->
            <a href="{{ route('productdetails.show', $product->id) }}" style="display: block;">
                <div class="product-img" style="width: 100%; height: 250px; overflow: hidden; border-radius: 5px; position: relative;">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                        style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 5px;">
                    <!-- Hover Thumb -->
                    <img class="hover-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                        style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; border-radius: 5px; opacity: 0; transition: opacity 0.3s ease;">
                </div>
            </a>

            <!-- Product Description -->
            <div class="product-description d-flex align-items-center justify-content-between mt-2">
                <!-- Product Meta Data -->
                <div class="product-meta-data">
                    <div class="line"></div>
                    <p class="product-price">Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('productdetails.show', $product->id) }}">
                        <h6>{{ $product->name }}</h6>
                    </a>
                </div>
                <!-- Ratings & Cart -->
                <div class="ratings-cart text-right">
                    <div class="ratings">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="cart">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn p-0" data-toggle="tooltip" data-placement="left" title="Add to Cart" style="background: none; border: none;">
                                <img src="{{ asset('dist/img/core-img/cart.png') }}" alt="Add to Cart">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center">
        <p>Belum ada produk yang tersedia.</p>
    </div>
    @endforelse
</div>

<div class="row">
    <div class="col-12">
        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>


            </div>
        </div>
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
                            <a href="index.html"><img src="dist/img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
                
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="{{ asset('dist/js/jquery/jquery-2.2.4.min.js') }}"></script>
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