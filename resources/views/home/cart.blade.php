<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Amado - Furniture Ecommerce Template | Cart</title>
    <link rel="icon" href="dist/img/core-img/favicon.ico" />
    <link rel="stylesheet" href="dist/css/core-style.css" />
    <link rel="stylesheet" href="dist/style.css" />
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
                            <input type="search" name="search" id="search" placeholder="Type your keyword..." />
                            <button type="submit">
                                <img src="dist/img/core-img/search.png" alt="Search" />
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
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt="Logo" /></a>
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
                <a href="{{ url('/') }}"><img src="dist/img/core-img/logo.png" alt="Logo" /></a>
            </div>
            <nav class="amado-nav">
                <ul>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    @endauth

                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="{{ request()->routeIs('shop') ? 'active' : '' }}">
                        <a href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="{{ request()->routeIs('checkout') ? 'active' : '' }}">
                        <a href="{{ route('checkout') }}">Checkout</a>
                    </li>
                </ul>
            </nav>

            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">%Discount%</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>

            <div class="cart-fav-search mb-100">
                <a href="{{ route('cart') }}" class="cart-nav">
                    <img src="{{ asset('dist/img/core-img/cart.png') }}" alt="Cart" />
                    Cart <span>({{ $cartItemCount }})</span>
                </a>
                <a href="#" class="fav-nav"><img src="dist/img/core-img/favorites.png" alt="Favourite" /> Favourite</a>
                <a href="#" class="search-nav"><img src="dist/img/core-img/search.png" alt="Search" /> Search</a>
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
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
</thead>
<tbody>
@forelse($cartItems as $item)
<tr>
    <td class="cart_product_img">
        <a href="#"><img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="max-width: 100px;"></a>
    </td>
    <td class="cart_product_desc">
        <h5>{{ $item->product->name }}</h5>
    </td>
    <td class="price">
        <span>${{ number_format($item->product->price, 2) }}</span>
    </td>
    <td class="qty">
        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
            @csrf
            <div class="qty-btn d-flex">
                <button type="button" onclick="let qty = this.nextElementSibling; if(qty.value > 0) qty.value--; this.form.submit();" class="qty-minus">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="0" class="qty-text" style="width: 50px; text-align: center;" onchange="this.form.submit()">
                <button type="button" onclick="let qty = this.previousElementSibling; qty.value++; this.form.submit();" class="qty-plus">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="4">Keranjang kosong.</td>
</tr>
@endforelse
</tbody>

                            </table>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>Subtotal:</span> <span>Rp.{{ number_format($subtotal, 2) }}</span></li>
                                <li><span>Delivery:</span> <span>{{ $delivery == 0 ? 'Free' : '$' . number_format($delivery, 2) }}</span></li>
                                <li><span>Total:</span> <span>Rp.{{ number_format($total, 2) }}</span></li>
                            </ul>

                            <div class="cart-btn mt-100">
                                <a href="{{ route('checkout') }}" class="btn amado-btn w-100">Checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Main Content Wrapper End -->

    <!-- Newsletter Area Start -->
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
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail" />
                            <input type="submit" value="Subscribe" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Area End -->

    <!-- Footer Area Start -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <div class="footer-logo mr-50">
                            <a href="{{ url('/') }}"><img src="dist/img/core-img/logo2.png" alt="Footer Logo" /></a>
                        </div>
                        <p class="copywrite">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with
                            <i class="fa fa-heart-o" aria-hidden="true"></i> by
                            <a href="https://colorlib.com" target="_blank" rel="noopener noreferrer">Colorlib</a> & Re-distributed by
                            <a href="https://themewagon.com/" target="_blank" rel="noopener noreferrer">Themewagon</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- Scripts -->
    <script src="dist/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="dist/js/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/plugins.js"></script>
    <script src="dist/js/active.js"></script>
</body>

</html>
