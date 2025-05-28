<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Amado - Furniture Ecommerce Template | Cart</title>

    <link rel="icon" href="{{ asset('dist/img/core-img/favicon.ico') }}">
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
                            <button type="submit">
                                <img src="{{ asset('dist/img/core-img/search.png') }}" alt="">
                            </button>
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
                <a href="{{ route('home') }}"><img src="{{ asset('dist/img/core-img/logo.png') }}" alt="Logo"></a>
            </div>
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area -->
        <header class="header-area clearfix">
            <div class="nav-close"><i class="fa fa-close" aria-hidden="true"></i></div>
            <div class="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('dist/img/core-img/logo.png') }}" alt=""></a>
            </div>
            <nav class="amado-nav">
                <ul>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <strong>{{ Auth::user()->name }}</strong>
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
                <a href="#" class="fav-nav"><img src="{{ asset('dist/img/core-img/favorites.png') }}" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="{{ asset('dist/img/core-img/search.png') }}" alt=""> Search</a>
            </div>

            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- ##### Edit Profil Start ##### -->
        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <div class="cart-title mt-50">
                            <h2>Edit Profil Pengguna</h2>
                        </div>

                        <div class="card p-4 shadow-sm" style="background-color: #f8f9fa; border-radius: 10px;">
                            <form action="{{ route('home.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-4 mb-md-0">
                                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}"
                                             class="rounded-circle mb-2"
                                             style="width: 150px; height: 150px; object-fit: cover;"
                                             alt="Foto Profil">
                                        <div class="mt-2">
                                            <label for="profile_picture" class="form-label">Ubah Foto Profil</label>
                                            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="mb-3">
    <label for="name" class="form-label"><strong>Nama</strong></label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
</div>

<div class="mb-3">
    <label for="alamat" class="form-label"><strong>Alamat</strong></label>
    <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
</div>
<div class="mb-3">
    <label for="no_hp" class="form-label"><strong>No HP</strong></label>
    <input 
        type="number" 
        name="no_hp" 
        id="no_hp" 
        class="form-control" 
        value="{{ old('no_hp', $user->no_hp) }}" 
        pattern="[0-9]+" 
        title="Masukkan nomor tanpa spasi atau karakter lain" 
        maxlength="15"
    >
</div>


                                        <div class="d-flex justify-content-end gap-2 mt-4">
                                            <button type="submit" class="btn amado-btn px-4 btn-save">Simpan Perubahan</button>
                                            <a href="{{ url()->previous() }}" class="btn amado-btn px-4 btn-cancel">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ##### Edit Profil End ##### -->

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

    <!-- JS Plugins -->
    <script src="{{ asset('dist/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('dist/js/popper.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugins.js') }}"></script>
    <script src="{{ asset('dist/js/active.js') }}"></script>

</body>
</html>
