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

    <style>
        @media screen and (max-width: 768px) {
            body {
                overflow-x: hidden !important;
            }
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
                    <li><a href="#"><span class="menu-text">Home</span></a>
                        <ul class="offcanvas-submenu">
                            <li><a href="index.html">Home 1</a></li>
                            <li><a href="index-2.html">Home 2</a></li>
                            <li><a href="index-3.html">Home 3</a></li>

                        </ul>

                    </li>
                    <li><a href="#"><span class="menu-text">Shop</span></a>
                        <ul class="offcanvas-submenu">
                            <li>
                                <a href="#"><span class="menu-text">Shop Grid</span></a>
                                <ul class="offcanvas-submenu">
                                    <li><a href="shop-grid-3-column.html">Shop Grid 3 Column</a></li>
                                    <li><a href="shop-grid-4-column.html">Shop Grid 4 Column</a></li>
                                    <li><a href="shop-grid-left-sidebar.html">Shop Grid Left Sidebar</a></li>
                                    <li><a href="shop-grid-right-sidebar.html">Shop Grid Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">Shop List</span></a>
                                <ul class="offcanvas-submenu">
                                    <li><a href="shop-grid-list.html">Shop List</a></li>
                                    <li><a href="shop-grid-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                    <li><a href="shop-grid-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">Shop Single</span></a>
                                <ul class="offcanvas-submenu">
                                    <li><a class="d-block" href="single-product.html">Shop Single</a></li>
                                    <li><a href="single-product-configurable.html">Shop Variable</a></li>
                                    <li><a href="single-product-affiliate.html">Shop Affiliate</a></li>
                                    <li><a href="single-product-group.html">Shop Group</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">other pages</span></a>
                                <ul class="offcanvas-submenu">
                                    <li><a href="about-us.html">About Page</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="compare.html">Compare Page</a></li>
                                    <li><a href="login.html">Login &amp; Register Page</a></li>
                                    <li><a href="myaccount.html">Account Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="menu-text">Pages</span></a>
                        <ul class="offcanvas-submenu">
                            <li><a href="about-us.html">About Page</a></li>
                            <li><a href="cart.html">Cart Page</a></li>
                            <li><a href="checkout.html">Checkout Page</a></li>
                            <li><a href="compare.html">Compare Page</a></li>
                            <li><a href="login.html">Login &amp; Register Page</a></li>
                            <li><a href="myaccount.html">Account Page</a></li>
                            <li><a href="wishlist.html">Wishlist Page</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="menu-text">Blog</span></a>
                        <ul class="offcanvas-submenu">
                            <li><a href="#"><span class="menu-text">Blog Grid</span></a>
                                <ul class="offcanvas-submenu">
                                    <li><a href="blog-grid-3-column.html">Blog Grid 3 column</a></li>
                                    <li><a href="blog-grid-4-column.html">Blog Grid 4 column</a></li>
                                    <li><a href="blog-grid-left-sidebar.html">Blog Grid Left Sidebar</a>
                                    </li>
                                    <li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><span class="menu-text">Blog List</span></a>
                                <ul class="offcanvas-submenu">
                                    <li><a href="blog-list-left-sidebar.html">Blog List Left Sidebar</a></li>
                                    <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><span class="menu-text">Blog Single</span></a>
                                <ul class="offcanvas-submenu">
                                    <li><a href="single-blog.html">Single Blog</a></li>
                                    <li><a href="blog-single-left-sidebar.html">Blog Single Left Sidebar</a></li>
                                    <li><a href="blog-single-right-sidebar.html">Blog Single Right Sidbar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact Us</a></li>
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
                            <a href="index.html"><img src="{{asset('frontend/img/logo.png')}}" alt="logo" style="width:45%" class="img-fluid"></a>
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
                                        <li><a href="all_products.html">{{$subcategory->name}}</a></li>
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