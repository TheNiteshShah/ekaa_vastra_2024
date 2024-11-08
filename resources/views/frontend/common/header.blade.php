<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/img/favicon.png')}}" />

    <!--********************************** 
        all css files 
    *************************************-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/fontawesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/ionicons.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/simple-line-icons.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/plugins/plugins.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        @media screen and (max-width: 768px) {
            body {
                overflow-x: hidden !important;
            }

            .rotating-image {
                width: 100px !important;
                /* Adjust as needed */
                height: 100px !important;
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

        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 1);
            /* Slightly transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Rotating image */
        .rotating-image {
            width: 120px;
            /* Adjust as needed */
            height: 120px;
            /* Adjust as needed */
            animation: rotate360 3s linear infinite;
        }

        /* Rotation animation */
        @keyframes rotate360 {
            from {
                transform: rotateY(0deg);
            }

            to {
                transform: rotateY(360deg);
            }
        }
    </style>
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2366447247032597');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2366447247032597&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KZ4GPFRC');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RDBXV3VHBN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-RDBXV3VHBN');
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <div class="loader-overlay" id="loader">
        <img src="{{asset('frontend/img/loader.png')}}" alt="Loading..." class="rotating-image">
    </div>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KZ4GPFRC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>



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
                            <!-- <a href="wishlist.html"> <i class="ion-android-favorite-outline"></i> Wishlist
                                <span>(0)</span></a> -->
                            @if(auth()->check())
                            <form method="POST" id="logout-form" action="">
                                @csrf
                                <a href="javascript:void()" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </form>
                            @else
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login">
                                <i class="icon-user"></i>
                            </a>
                            @endif
                        </li>
                    </ul>
                </nav>
            </div>
            <nav class="offcanvas-menu">
                <ul>
                    <li><a href="{{route('/')}}">Home</a></li>
                    @foreach($categoryData as $category)
                    <li><a href="javascript:void(0)"><span class="menu-text">{{$category->name}}</span></a>
                        <ul class="offcanvas-submenu">
                            @foreach($category->SubCategory as $subcategory)
                            <li><a href="{{route('collection',strtolower(str_replace('+', '-', urlencode($subcategory->name))))}}">{{$subcategory->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                    <li><a href="{{route('contact-us')}}">Contact Us</a></li>

                </ul>
            </nav>
            <div class="offcanvas-social py-30">
                <ul>
                    <li>
                        <a target="_blank" rel="noopener" href="https://www.facebook.com/ekaavastra"><i class="icon-social-facebook"></i></a>
                    </li>
                    <li>
                        <a target="_blank" rel="noopener" href="https://www.instagram.com/ekaavastra/"><i class="icon-social-instagram"></i></a>
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
            @if(!empty($wishlistItems) && $wishlistItems!='[]')
            <ul class="minicart-product-list">
                @foreach($wishlistItems as $wish)
                <li>
                    <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($wish->product->name))))}}" class="image"><img src="{{asset($wish->product->image)}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($wish->product->name))))}}" class="title">{{$wish->product->name}}</a>
                        <h6 class="product-price"><del class="del" style="font-size: 13px;">₹{{$wish->product->mrp}}</del>
                            <span class="onsale" style="font-size: 13px;">₹{{$wish->product->selling_price}}</span>
                        </h6>
                        <button class="btn theme-btn--dark3 btn--sm mt-10" data-bs-toggle="modal" data-bs-target="#wishSizeModal" data-product-id="{{ $wish->product->id }}" data-type-id="" data-qty="1">
                            <span class="me-2"><i class="ion-bag"></i></span>
                            Move to bag
                        </button>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <div class="text-center ">
                <img src="{{asset('frontend/img/empty_wishlist.jpg')}}" alt="Empty-Wishlist" class="img-fluid" style="width:50%">
            </div>
            <h6 class="text-center mt-2">Your wishlist is empty!</h6>
            @endif
            <!-- <a href="wishlist.html" class="btn theme--btn1 btn--lg text-uppercase  d-block d-sm-inline-block mt-30">view
                wishlist</a> -->
        </div>
    </div>
    <!-- OffCanvas Wishlist End -->

    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
        <div class="inner">
            <div class="head d-flex flex-wrap justify-content-between">
                <span class="title">Bag</span>
                <button class="offcanvas-close">×</button>
            </div>
            @if(!empty($cartItems) && $cartItems!='[]')
            <ul class="minicart-product-list">
                @php
                $cart_total = 0;
                @endphp
                @foreach($cartItems as $cart)
                @if(!auth()->check())
                @php
                $type = App\Models\TypeModal::find($cart['type_id']);
                $cart_total += ($type->product->selling_price*$cart['quantity']);
                @endphp
                <li>
                    <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($type->product->name))))}}" class="image"><img src="{{asset($type->product->image)}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($type->product->name))))}}" class="title">{{$type->product->name}}</a>
                        <span class="quantity-price mt-0"><b>Size:</b> {{$type->size->name}}</span>
                        <span class="quantity-price mt-0">{{$cart['quantity']}} x <span class="amount">₹{{$type->product->selling_price}}</span></span>
                        <!-- <a href="javascript:void(0)" class="remove">×</a> -->
                    </div>
                </li>
                @else
                @php
                $cart_total += ($cart->product->selling_price*$cart->quantity);
                @endphp
                <li>
                    <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($cart->product->name))))}}" class="image"><img src="{{asset($cart->product->image)}}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($cart->product->name))))}}" class="title">{{$cart->product->name}}</a>
                        <span class="quantity-price mt-0"><b>Size:</b> {{$cart->type->size->name}}</span>
                        <span class="quantity-price mt-0">{{$cart->quantity}} x <span class="amount">₹{{$cart->product->selling_price}}</span></span>
                        <!-- <a href="javascript:void(0)" class="remove">×</a> -->
                    </div>
                </li>
                @endif
                @endforeach
            </ul>
            <div class="sub-total d-flex flex-wrap justify-content-between">
                <strong>Subtotal :</strong>
                <span class="amount">₹{{$cart_total}}</span>
            </div>
            <div class="justify-content-center" style="display:flex">
                <a href="{{route('cart')}}" class="btn theme--btn1 btn--cm text-uppercase  d-block d-sm-inline-block me-sm-2">view
                    Bag</a>
                @if(auth()->check())
                <a href="{{route('checkout')}}" class="btn theme--btn1 btn--cm text-uppercase  d-block d-sm-inline-block mt-4 mt-sm-0">checkout</a>
                @else
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login" class="btn theme--btn1 btn--cm text-uppercase  d-block d-sm-inline-block mt-4 mt-sm-0">checkout</a>
                @endif
            </div>
            <!-- <p class="minicart-message">Free Shipping on All Orders Over ₹100!</p> -->
            @else
            <div class="text-center ">
                <img src="{{asset('frontend/img/empty_bag.jpg')}}" alt="Empty-Bag" class="img-fluid" style="width:50%">
            </div>
            <h6 class="text-center mt-2">Your bag is empty!</h6>
            @endif
        </div>
    </div>
    <!-- OffCanvas Cart End -->


    <!-- Login Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border:none">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-11 text-center">
                            <img src="{{asset('frontend/img/logo.png')}}" alt="logo" style="width:30%" class="img-fluid">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <h4 class="title text-capitalize pb-30 text-center">Log in to your account</h4>
                    <form class="log-in-form" id="login-form">
                        <div class="form-group row">
                            <label for="loginPhone" class="col-md-2 col-form-label" style="text-align:end">+91</label>
                            <div class="col-md-10">
                                <input type="text" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" class="form-control" id="loginPhone" placeholder="Mobile Number" required>
                            </div>
                        </div>
                        <p class="mt-2 mb-2">By Continuing, I agree to the Terms of use & Privacy Policy</p>
                        <div id="recaptcha-container"></div>
                        <div class="sign-btn text-center mt-3">
                            <button type="submit" id="sendOtpButton" class="btn theme-btn--dark1 btn--md w-100">Login with OTP</button>
                            <button class="btn theme-btn--dark1 btn--md w-100 d-none" id="login-loader" style="border-color:#09080A;;" type="button" disabled>
                                <span style="color:#09080A;">Loading...</span>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="color:#09080A;"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal -->
    <!-- Signup Modal -->
    <div class="modal fade" id="signup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border:none">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{asset('frontend/img/logo.png')}}" alt="logo" style="width:30%" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <h4 class="title text-capitalize pb-30 text-center">Sign up to your account</h4>
                    <form class="sign-up-form" id="signup-form" action="{{route('user-signup')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="signupName" name="signupName" placeholder="Name" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="Email" required>
                            </div>
                        </div>
                        <div id="recaptcha-container"></div>
                        <div class="sign-btn text-center mt-3">
                            <button type="submit" id="signUpButton" class="btn theme-btn--dark1 btn--md w-100">Sign Up</button>
                            <button class="btn theme-btn--dark1 btn--md w-100 d-none" id="login-loader" style="border-color:#09080A;" type="button" disabled>
                                <span style="color:#09080A;">Loading...</span>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="color:#09080A;"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <style>
        .otp-field {
            flex-direction: row;
            column-gap: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .otp-field input {
            height: 45px;
            width: 42px;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        .otp-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .otp-field input::-webkit-inner-spin-button,
        .otp-field input::-webkit-outer-spin-button {
            display: none;
        }

        .resend {
            font-size: 12px;
        }
    </style>
    <!-- OTP Modal -->
    <div class="modal fade" id="otp" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border:none">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-11 text-center">
                            <img src="{{asset('frontend/img/logo.png')}}" alt="logo" style="width:30%" class="img-fluid">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <h4 class="title text-capitalize pb-30 text-center">Mobile Phone Verification</h4>
                    <p class="text-center pb-30">Enter the 6-digit verification code that was sent to your phone number.</p>
                    <form class="otp-form" id="otp-form">
                        <div class="otp-field mb-4">
                            <input type="text" onkeypress="return isNumberKey(event)" maxlength="1" />
                            <input type="text" onkeypress="return isNumberKey(event)" disabled maxlength="1" />
                            <input type="text" onkeypress="return isNumberKey(event)" disabled maxlength="1" />
                            <input type="text" onkeypress="return isNumberKey(event)" disabled maxlength="1" />
                            <input type="text" onkeypress="return isNumberKey(event)" disabled maxlength="1" />
                            <input type="text" onkeypress="return isNumberKey(event)" disabled maxlength="1" />
                        </div>

                        <button type="submit" class="btn theme-btn--dark1 btn--md w-100" id="verifyOtpButton">
                            Verify
                        </button>
                        <button class="btn theme-btn--dark1 btn--md w-100 d-none" id="otp-loader" style="border-color:#09080A;;" type="button" disabled>
                            <span style="color:#09080A;">Loading...</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="color:#09080A;"></span>
                        </button>
                        <p class="resend pt-30 text-center pb-30">
                            Didn't receive code? <a href="">Request again</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- OTP Modal -->
    <!-- header start -->
    <header id="sticky" class="header2 style1 theme1" style="position: sticky;
  top: 0;
  left: 0;
  width: 100%;
  background: #ffffff;
  z-index: 999;">
        <!-- custom marquee start -->

        <div class="custom-marquee" role="region">
            <div class="track ">
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
                <span class="content marquee-text">Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our website is currently under development, but you can still place your order by contacting us on WhatsApp.</span>
            </div>
        </div>
        <!-- custom marquee end -->

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
                                <li><a href="{{route('/')}}">Home</a></li>
                                @foreach($categoryData as $category)
                                <li>
                                    <a href="javascript:void(0)">{{$category->name}} <i class="ion-ios-arrow-down"></i></a>
                                    <ul class="sub-menu">
                                        @foreach($category->SubCategory as $subcategory)
                                        <li><a href="{{route('collection',strtolower(str_replace('+', '-', urlencode($subcategory->name))))}}">{{$subcategory->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                <li><a href="{{route('contact-us')}}">contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-6 col-lg-3 col-xl-3">
                        <!-- search-form end -->
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="cart-block-links theme1">
                                <ul class="side-menu d-flex align-items-center">
                                    <li>
                                        <a href="javascript:void(0)" class="search search-toggle">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </li>
                                    @if(auth()->check())
                                    <li class="position-relative ">
                                        <a class="offcanvas-toggle" href="#offcanvas-wishlist">
                                            <i class="ion-android-favorite-outline"></i>
                                            <span class="badge cbdg1 wishCount">{{$wishlistCount}}</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="cart-block position-relative ">
                                        <a class="offcanvas-toggle" href="#offcanvas-cart">
                                            <i class="ion-bag"></i>
                                            <span class="badge cbdg1">{{$cartCount}}</span>
                                        </a>
                                    </li>
                                    <li class="me-0 cart-block position-relative d-none d-sm-block">
                                        @if(auth()->check())
                                        <a href="javascript:void(0)"><i class="icon-user"></i> <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu side-ul">
                                            <li><a href="{{route('my-account')}}">My Account</a></li>
                                            <li>
                                                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="logout-btn">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                        @else
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login">
                                            <i class="icon-user"></i>
                                        </a>
                                        @endif
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