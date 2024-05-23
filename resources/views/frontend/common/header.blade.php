<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="" />
    <title>Ekaa Vastra</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/img/favicon.png')}}" />

    <!--********************************** 
        all css files 
    *************************************-->

    <!--*************************************************** 
       fontawesome,bootstrap,plugins and main style css
     ***************************************************-->

    <link rel="stylesheet" href="{{asset('frontend/css/fontawesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/ionicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/simple-line-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/plugins/plugins.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <style>
        @media screen and (max-width: 768px) {
            body {
                overflow-x: hidden !important;
            }
        }

        .out {
            pointer-events: none;
            opacity: 0.3;
            position: relative;
        }

        .out:after {
            position: absolute;
            left: 0;
            top: 50%;
            height: 1px;
            background: rgb(80, 80, 80);
            content: "";
            width: 100%;
            display: block;
            transform: rotate(140deg);
        }
    </style>

</head>

<body>
    @php
    $categoryData = App\Models\CategoryModal::orderBy('seq','asc')->where('is_active',1)->get();
    @endphp

    <!-- offcanvas-overlay start -->
    <div class="offcanvas-overlay"></div>
    <!-- offcanvas-overlay end -->

    <!-- offcanvas-mobile-menu start -->
    <div id="offcanvas-mobile-menu" class="offcanvas theme1 offcanvas-mobile-menu">
        <div class="inner">
            <div class="border-bottom mb-4 pb-4 text-end">
                <button class="offcanvas-close">×</button>
            </div>
            <div class="offcanvas-head mb-4">
                <nav class="offcanvas-top-nav">
                    <ul class="d-flex justify-content-center align-items-center">
                        <li class="mx-3">
                            <a href="wishlist.html"> <i class="ion-android-favorite-outline"></i> Wishlist
                                <span>(0)</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <nav class="offcanvas-menu">
                <ul>
                    <li><a href="{{route('/')}}">Home</a></li>
                    @foreach($categoryData as $category)
                    <li><a href="#"><span class="menu-text">{{$category->name}}</span></a>
                        <ul class="offcanvas-submenu">
                            @foreach($category->SubCategory as $subcategory)
                            <li><a href="{{route('collection',strtolower(str_replace('+', '-', urlencode($subcategory->name))))}}">{{$subcategory->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                    <li><a href="#">Contact Us</a></li>

                </ul>
            </nav>
            <div class="offcanvas-social py-30">
                <ul>
                    <li>
                        <a href="#"><i class="icon-social-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-social-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-social-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-social-google"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-social-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- offcanvas-mobile-menu end -->

    <!-- OffCanvas Wishlist Start -->
    <div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist theme1">
        <div class="inner">
            <div class="head d-flex flex-wrap justify-content-between">
                <span class="title">Wishlist</span>
                <button class="offcanvas-close">×</button>
            </div>
            <ul class="minicart-product-list">
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro1.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Midnight Palm Coord</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>
                        <span class="quantity-price mt-0">1 x <span class="amount">₹100.00</span></span>
                        <a href="#" class="remove">×</a>
                        <button class="btn theme-btn--dark3 btn--sm mt-10">
                            <span class="me-2"><i class="ion-bag"></i></span>
                            Move to bag
                        </button>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro2.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Lucky Wooden Elephant</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>

                        <span class="quantity-price mt-0">1 x <span class="amount">₹35.00</span></span>
                        <a href="#" class="remove">×</a>
                        <button class="btn theme-btn--dark3 btn--sm mt-10">
                            <span class="me-2"><i class="ion-bag"></i></span>
                            Move to bag
                        </button>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro3.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Fish Cut Out Set</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>

                        <span class="quantity-price mt-0">1 x <span class="amount">₹9.00</span></span>
                        <a href="#" class="remove">×</a>
                        <button class="btn theme-btn--dark3 btn--sm mt-10">
                            <span class="me-2"><i class="ion-bag"></i></span>
                            Move to bag
                        </button>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro4.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Lucky Wooden Elephant</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>

                        <span class="quantity-price mt-0">1 x <span class="amount">₹35.00</span></span>
                        <a href="#" class="remove">×</a>
                        <button class="btn theme-btn--dark3 btn--sm mt-10">
                            <span class="me-2"><i class="ion-bag"></i></span>
                            Move to bag
                        </button>
                    </div>
                </li>
            </ul>
            <a href="wishlist.html" class="btn theme--btn1 btn--lg text-uppercase  d-block d-sm-inline-block mt-30">view
                wishlist</a>
        </div>
    </div>
    <!-- OffCanvas Wishlist End -->

    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
        <div class="inner">
            <div class="head d-flex flex-wrap justify-content-between">
                <span class="title">Cart</span>
                <button class="offcanvas-close">×</button>
            </div>
            <ul class="minicart-product-list">
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro1.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Midnight Palm Coord</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>
                        <span class="quantity-price mt-0">1 x <span class="amount">₹100.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro2.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Lucky Wooden Elephant</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>

                        <span class="quantity-price mt-0">1 x <span class="amount">₹35.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro3.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Fish Cut Out Set</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>

                        <span class="quantity-price mt-0">1 x <span class="amount">₹9.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img src="{{asset('frontend/img/product/pro4.jpeg')}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Lucky Wooden Elephant</a>
                        <span class="quantity-price mt-0"><b>Size:</b> S</span>

                        <span class="quantity-price mt-0">1 x <span class="amount">₹35.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
            </ul>
            <div class="sub-total d-flex flex-wrap justify-content-between">
                <strong>Subtotal :</strong>
                <span class="amount">₹144.00</span>
            </div>
            <a href="cart.html" class="btn theme--btn1 btn--lg text-uppercase  d-block d-sm-inline-block me-sm-2">view
                cart</a>
            <a href="checkout.html" class="btn theme--btn1 btn--lg text-uppercase  d-block d-sm-inline-block mt-4 mt-sm-0">checkout</a>
            <p class="minicart-message">Free Shipping on All Orders Over ₹100!</p>
        </div>
    </div>
    <!-- OffCanvas Cart End -->

    <!-- offcanvas-setting Start -->
    <div id="offcanvas-setting" class="offcanvas offcanvas-cart theme1">
        <div class="inner">
            <div class="head d-flex justify-content-between">
                <span class="title">Setting</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="content_setting">
                <div class="info_setting">
                    <h3 class="title_setting">My account</h3>
                    <ul>
                        <li>
                            <a href="myaccount.html">My account</a>
                        </li>
                        <li>
                            <a href="checkout.html">Checkout</a>
                        </li>
                        <li>
                            <a href="login.html">Sign in</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--offcanvas-setting End -->

    <!-- header start -->
    <header id="sticky" class="header2 style1 theme1">
        <!-- header-middle start -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-6 col-lg-2 col-xl-3 order-first">
                        <div class="logo">
                            <a href="{{route('/')}}"><img src="{{asset('frontend/img/logo.png')}}" alt="logo" style="width:45%" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-7 col-xl-6 d-none d-lg-block">
                        <nav class="header-bottom theme1">
                            <ul class="main-menu d-flex align-items-center">
                                @foreach($categoryData as $category)
                                <li>
                                    <a href="#">{{$category->name}} <i class="ion-ios-arrow-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach($category->SubCategory as $subcategory)
                                        <li><a href="{{route('collection',strtolower(str_replace('+', '-', urlencode($subcategory->name))))}}">{{$subcategory->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                <li><a href="contact.html">contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-6 col-lg-3 col-xl-3">
                        <!-- search-form end -->
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="cart-block-links theme1">
                                <ul class="d-flex align-items-center">
                                    <li>
                                        <a href="javascript:void(0)" class="search search-toggle">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </li>
                                    <li class="position-relative d-none d-sm-block">
                                        <a class="offcanvas-toggle" href="#offcanvas-wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                            <span class="badge cbdg1">4</span>
                                        </a>
                                    </li>
                                    <li class="cart-block position-relative d-none d-sm-block">
                                        <a class="offcanvas-toggle" href="#offcanvas-cart">
                                            <i class="ion-bag"></i>
                                            <span class="badge cbdg1">5</span>
                                        </a>
                                    </li>
                                    <li class="me-0 cart-block">
                                        <a class="offcanvas-toggle" href="#offcanvas-setting">
                                            <i class="icon-user"></i>
                                        </a>
                                    </li>
                                    <!-- cart block end -->
                                </ul>
                            </div>
                            <div class="mobile-menu-toggle theme1 d-lg-none">
                                <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                    <svg viewbox="0 0 800 600">
                                        <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                        <path d="M300,320 L540,320" id="middle"></path>
                                        <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318)">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-middle end -->
    </header>
    <!-- header end -->