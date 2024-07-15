@php
$categoryData = App\Models\CategoryModal::orderBy('seq','asc')->where('is_active',1)->get();
@endphp
<!-- footer strat -->
<footer class="bg-lighten2 theme1 position-relative">
    <!-- footer bottom start -->
    <div class="footer-bottom pt-70 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 mb-10">
                    <div class="footer-widget">
                        <div class="footer-logo mb-10">
                            <a href="{{ route('/') }}">
                                <img src="{{asset('frontend/img/logo.png')}}" style="width:30%" alt="footer logo">
                            </a>
                        </div>
                        <p class="text mb-35">Founded in 2024, our journey began with a passion that burned bright, a desire to empower people to embrace their unique spirit through the clothes they wear. </p>
                        <div class="social-network">
                            <!-- <h2 class="title text mb-20 text-capitalize">Stay Connected:</h2> -->
                            <ul class="d-flex">
                                <li><a target="_blank" rel="noopener" href="https://www.facebook.com/ekaavastra"><span class="ion-social-facebook"></span></a></li>
                                <li class="me-0"><a target="_blank" rel="noopener" href="https://www.instagram.com/ekaavastra"><span class="ion-social-instagram-outline"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 mb-10">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Categories</h2>
                        </div>
                        <ul class="footer-menu">
                            @foreach($categoryData as $category)
                            <li>
                                <a href="javascript:void(0)">{{$category->name}}</a>
                            </li>
                            @endforeach
                        </ul>


                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 mb-10">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Information</h2>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="{{ route('about-us')}}">About Us</a></li>
                            <li><a href="{{ route('privacy-policy')}}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms-and-conditions')}}">Terms & Conditions</a></li>
                            <li><a href="{{ route('refund-policy')}}">Refund Policy</a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-10">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Customer Service</h2>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><i class="ion-ios-telephone mr-10"></i><span>Mon - Fri : 9AM - 6PM</span></li>
                            <li><a href="tel:+919636373743"><i class="ion-ios-telephone mr-10"></i><span>+919636373743</span></a></li>
                            <li><a href="mailto:ekaavastra@gmail.com"><i class="ion-email mr-10"></i>
                                    <span style="text-transform:none">ekaavastra@gmail.com</span></a></li>
                            <li><span><i class="ion-ios-location mr-10"></i>Sunshine Aditya, Kundra Road, Sirsi, Jaipur, Rajasthan, 302012</span></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- footer bottom end -->
    <!-- coppy-right start -->
    <div class="coppy-right">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="border-top py-20">
                        <div class="row">
                            <!-- <div class="col-12 col-md-5 col-lg-4 col-xl-3 order-last order-md-first"> -->
                            <div class="col-12 col-md-12 col-lg-12 col-xl-12 order-last order-md-first text">
                                <div class="text-center">
                                    <p class="mb-3 mb-md-0">&copy; 2024 <a href="#">Ekaa Vastra</a>. All
                                        Rights Reserved</p>
                                </div>
                            </div>
                            <!-- <div class="col-12 col-md-7 col-lg-8 col-xl-9">
                                    <ul
                                        class="footer-menu copyright-menu d-flex flex-wrap justify-content-center justify-content-md-end">
                                        <li><a href="#">Legal Notice</a></li>
                                        <li><a href="#">Prices drop</a></li>

                                        <li><a href="#">New products</a></li>

                                        <li><a href="#">Best sales</a></li>

                                        <li><a href="login.html">Login</a></li>

                                        <li><a href="myaccount.html">My account</a></li>
                                    </ul>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- copy-right end -->
    <a class="btn btn-success white btn-lg mt-3 button-fixed-left green" href="https://wa.me/+919636373743/?text=Hi" role="button"><i class="ion-social-whatsapp-outline" style="font-size:25px"></i></a>
</footer>
<!-- footer end -->


<!-- search-box and overlay start -->
<div class="overlay">
    <div class="scale"></div>
    <form class="search-box" action="#">
        <input type="text" name="search" placeholder="Search products..." />
        <button id="close" type="submit"><i class="ion-ios-search-strong"></i></button>
    </form>
    <button class="btn-close"><i class="ion-android-close"></i></button>
</div>
<!-- search-box and overlay end -->

<!-- modals start -->

<!-- first modal -->
<div class="modal fade theme1 style1" id="quick-view" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-5 mb-lg-0">
                        <div class="product-sync-init mb-20">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{asset('frontend/img/slider/thumb/1.jpg')}}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{asset('frontend/img/slider/thumb/2.jpg')}}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{asset('frontend/img/slider/thumb/3.jpg')}}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{asset('frontend/img/slider/thumb/4.jpg')}}" alt="product-thumb">
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>

                        <div class="product-sync-nav slick-nav-sync">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"> <img src="{{asset('frontend/img/slider/thumb/1.1.jpg')}}" alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"> <img src="{{asset('frontend/img/slider/thumb/2.1.jpg')}}" alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="{{asset('frontend/img/slider/thumb/3.1.jpg')}}" alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="{{asset('frontend/img/slider/thumb/4.1.jpg')}}" alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="{{asset('frontend/img/slider/thumb/2.1.jpg')}}" alt="product-thumb"></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>
                    </div>
                    <div class="col-md-6 mt-5 mt-md-0">
                        <div class="modal-product-info">
                            <div class="product-head">
                                <h2 class="title">Brixton Patrol All Terrain Anorak Jacket</h2>
                                <h4 class="sub-title">Reference: demo_5</h4>
                                <div class="star-content mb-20">
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on"><i class="ion-ios-star"></i> </span>
                                    <span class="star-on de-selected"><i class="ion-ios-star"></i> </span>
                                </div>
                            </div>
                            <div class="product-body">
                                <span class="product-price text-center"> <span class="new-price">₹29.00</span>
                                </span>
                                <p class="border-top pt-30">Whether you're exploring the woods or the city, the
                                    Brixton™
                                    Patrol All </p>
                                <ul>
                                    <li>Terrain Anorak Jacket has got you covered.</li>
                                    <li>Camo jacket crafted from 4.5 oz nylon ripstop with two-way stretch, and a
                                        water-repellent coating.</li>
                                    <li>Drawstring hood.</li>
                                </ul>
                            </div>
                            <div class="product-size d-flex align-items-center mt-30">
                                <h3 class="title">Dimension</h3>
                                <select>
                                    <option value="0">40x60cm</option>
                                    <option value="1">60x90cm</option>
                                    <option value="2">80x120cm</option>

                                </select>
                            </div>
                            <div class="product-footer">
                                <div class="product-count style d-flex flex-column flex-sm-row my-4">
                                    <div class="count d-flex">
                                        <input type="number" min="1" max="10" step="1" value="1">
                                        <div class="button-group">
                                            <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>
                                            <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn theme-btn--dark3 btn--xl mt-30 mt-sm-0">
                                            <span class="me-2"><i class="ion-bag"></i></span>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                                <div class="addto-whish-list">
                                    <a href="javascript:void(0)"><i class="icon-heart"></i> Add to wishlist</a>
                                    <a href="javascript:void(0)"><i class="icon-shuffle"></i> Add to compare</a>
                                </div>
                                <div class="pro-social-links mt-10">
                                    <ul class="d-flex align-items-center">
                                        <li class="share">Share</li>
                                        <li><a target="_blank" rel="noopener" href="javascript:void(0)"><i class="ion-social-facebook"></i></a></li>
                                        <li><a target="_blank" rel="noopener" href="https://www.instagram.com/ekaavastra/"><i class="ion-social-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- second modal -->
<div class="modal fade style2" id="compare" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <h5 class="title"><i class="fa fa-check"></i> Product added to compare.</h5>
            </div>
        </div>
    </div>
</div>
<!-- second modal -->
<div class="modal fade style3" id="add-to-cart" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center bg-dark">
                <h5 class="modal-title" id="add-to-cartCenterTitle"> <span class="ion-checkmark-round"></span>
                    Product successfully added to your shopping cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5 divide-right">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{asset('frontend/img/modal/1.jpg')}}" alt="img">
                            </div>
                            <div class="col-md-6 mb-2 mb-md-0">
                                <h4 class="product-name">New Balance Running Arishi trainers in triple</h4>
                                <h5 class="price">₹₹29.00</h5>
                                <h6 class="color"><strong>Dimension: </strong>: <span class="dmc">40x60cm</span>
                                </h6>
                                <h6 class="quantity"><strong>Quantity:</strong>&nbsp;1</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="modal-cart-content">
                            <p class="cart-products-count">There is 1 item in your cart.</p>
                            <p><strong>Total products:</strong>&nbsp;₹123.72</p>
                            <p><strong>Total shipping:</strong>&nbsp;₹7.00 </p>
                            <p><strong>Taxes</strong>&nbsp;₹0.00</p>
                            <p><strong>Total:</strong>&nbsp;₹130.72 (tax excl.)</p>
                            <div class="cart-content-btn">
                                <button type="button" class="btn theme-btn--dark1 btn--md mt-4" data-bs-dismiss="modal">Continue
                                    shopping</button>
                                <button class="btn theme-btn--dark1 btn--md mt-4"><i class="ion-checkmark-round"></i>Proceed to
                                    checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modals end -->



<!--*********************** 
        all js files
     ***********************-->

<!--****************************************************** 
        jquery,modernizr ,poppe,bootstrap,plugins and main js
     ******************************************************-->
<script>
    const baseUrl = "{{config('app.url')}}";
</script>
<script src="{{asset('frontend/js/vendor/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('frontend/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
<script src="{{asset('frontend/js/vendor/modernizr-3.7.1.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins/jquery-ui.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/plugins/plugins.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/custom/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{{asset('frontend/custom/cartOfflineOnline.js')}}"></script>
@if (session('status-success'))
<script>
    successToast("{{ session('status-success') }}")
</script>
@endif
@if (session('status-error'))
<script>
    successToast("{{ session('status-error') }}")
</script>
@endif
<script>
    Fancybox.bind('[data-fancybox="gallery"]', {
        // Your custom options
    });

    //------------ Login ---------------- 
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyBCxbeIgKW2_sfszxWcStTpYisjfFl49YE",
        authDomain: "ekaa-vastra.firebaseapp.com",
        projectId: "ekaa-vastra",
        storageBucket: "ekaa-vastra.appspot.com",
        messagingSenderId: "493392459476",
        appId: "1:493392459476:web:92320171f6620fde5d2d41",
        measurementId: "G-PPX8ZRHYSZ"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('sendOtpButton').addEventListener('click', function() {
            $('#sendOtpButton').hide();
            $('#login-loader').show();
            var phone = document.getElementById('loginPhone').value;
            if (!phone) {
                errorToast('Phone number is required');
                $('#sendOtpButton').show();
                $('#login-loader').hide();
                return;
            }
            var phoneNumber = '+91' + document.getElementById('loginPhone').value;
            var appVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');

            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then(function(confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    var otp = prompt('Enter the OTP you received');
                    return confirmationResult.confirm(otp);
                }).then(function(result) {
                    var user = result.user;
                    console.log('User signed in successfully:', user);
                    // Send the ID token to your backend for verification
                    user.getIdToken().then(function(idToken) {
                        fetch(baseUrl + 'login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                // token: idToken
                                phone: phone,
                                token: user.uid
                            })
                        }).then(function(response) {
                            return response.json();
                        }).then(function(data) {
                            console.log('Backend response:', data);
                            var myModal = new bootstrap.Modal(document.getElementById('login'));
                            $('#sendOtpButton').show();
                            $('#login-loader').hide();
                            myModal.hide();
                            successToast('Successfully Login');
                            setTimeout(() => {
                                location.reload()
                            }, 1000);
                        }).catch(function(error) {
                            $('#sendOtpButton').show();
                            $('#login-loader').hide();
                            console.error('Error during backend verification:', error);
                        });
                    });
                }).catch(function(error) {
                    $('#sendOtpButton').show();
                    $('#login-loader').hide();
                    console.error('Error during sign in:', error);
                    if (error == 'The SMS verification code used to create the phone auth credential is invalid. Please resend the verification code sms and be sure to use the verification code provided by the user.') {
                        successToast('Wrong OTP Entered!');
                    }
                });
        });
    });
    $(document).ready(function() {
        $('.btn[data-bs-target="#sizeModal"]').on('click', function() {
            var productId = $(this).data('product-id');
            var activeTypeId = $(this).data('type-id');
            var activeQty = $(this).data('qty');
            var sizesList = $('#sizeList');
            sizesList.html('loading...');
            $.ajax({
                url: baseUrl + 'get-sizes/' + productId,
                method: 'GET',
                success: function(response) {
                    sizesList.empty();
                    response.forEach(function(item) {
                        var activeClass = (item.type_id == activeTypeId) ? 'active' : '';
                        sizesList.append('<li><a href="javascript:void(0)" onclick="updateTypeId(this,' + item.type_id + ')" class="' + activeClass + '"  type_id = "' + item.type_id + '">' + item.size.name + '</a></li>');
                    });
                    document.getElementById('activeTypeId').value = activeTypeId;
                    document.getElementById('CartTypeId').value = activeTypeId;
                    document.getElementById('activeQty').value = activeQty;

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching sizes:', error);
                }
            });
        });
    });
    $(document).ready(function() {
        $('.btn[data-bs-target="#quantityModal"]').on('click', function() {
            var productId = $(this).data('product-id');
            var activeTypeId = $(this).data('type-id');
            var activeQty = $(this).data('qty');
            var QtyList = $('#QtyList');
            QtyList.html('loading...');
            $.ajax({
                url: baseUrl + 'get-qty/' + activeTypeId,
                method: 'GET',
                success: function(response) {
                    QtyList.empty();
                    response.forEach(function(item) {
                        var activeClass = (item.qty == activeQty) ? 'active' : '';
                        QtyList.append('<li><a href="javascript:void(0)" onclick="updateQty(this,' + item.qty + ')" class="' + activeClass + '"  type_id = "' + item.type_id + '">' + item.qty + '</a></li>');
                    });
                    document.getElementById('activeTypeId').value = activeTypeId;
                    document.getElementById('CartTypeId').value = activeTypeId;
                    document.getElementById('activeQty').value = activeQty;

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching sizes:', error);
                }
            });
        });
    });

    function fetchAddressDetails() {
        var pincode = document.getElementById('add-pincode').value;
        if (!pincode) {
            var pincode = document.getElementById('edit-pincode').value;
        }
        if (pincode.length === 6) {
            $('#pin-error').html('');
            $('#pin-error1').html('');
            var apiUrl = baseUrl + 'fetch-pin-data/' + pincode;
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.Status === 'Success') {
                        var postOffice = data.PostOffice[0];
                        document.getElementById('add-country').value = postOffice.Country;
                        document.getElementById('add-state').value = postOffice.State;
                        document.getElementById('add-city').value = postOffice.District;
                    } else {
                        alert('Invalid Pincode');
                    }
                })
                .catch(error => {
                    console.error('Error fetching address details:', error);
                });
        } else {
            $('#pin-error').html('Please enter a valid pincode');
            $('#pin-error1').html('Please enter a valid pincode');
        }
    }
    document.querySelectorAll('.edit-address-btn').forEach(button => {
        button.addEventListener('click', function() {
            var addressId = this.getAttribute('data-address-id');
            fetch(baseUrl + 'get-address/' + addressId)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-address-id').value = data.id;
                    document.getElementById('edit-first-name').value = data.first_name;
                    document.getElementById('edit-last-name').value = data.last_name;
                    document.getElementById('edit-email').value = data.email;
                    document.getElementById('edit-phone').value = data.phone;
                    document.getElementById('edit-address').value = data.address;
                    document.getElementById('edit-country').value = data.country;
                    document.getElementById('edit-pincode').value = data.pincode;
                    document.getElementById('edit-state').value = data.state;
                    document.getElementById('edit-city').value = data.city;
                })
                .catch(error => console.error('Error fetching address details:', error));
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        function fetchCharges(paymentMode) {
            const url = baseUrl + 'get-shipping-charges';
            const params = new URLSearchParams({
                d_pin: '302020', // Replace with actual destination pin code
                o_pin: '302021', // Replace with actual origin pin code
                cgm: 200,
                pt: paymentMode == 2 ? 'Pre-paid' : 'COD',
                cod: paymentMode == 1 ? 1 : 0
            });

            fetch(`${url}/${paymentMode}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        errorToast('Failed to fetch charges');
                    } else {
                        document.getElementById('shipping').innerText = data.data.shipping;
                        document.getElementById('subTotal').innerText = data.data.sub_total;
                    }
                })
                .catch(error => {
                    console.error('Error fetching charges:', error);
                    errorToast('Error fetching charges');
                });
        }

        document.querySelectorAll('input[name="payment_mode"]').forEach(radio => {
            radio.addEventListener('change', function() {
                fetchCharges(this.value);
            });
        });

        // Initial fetch based on default selected radio button
        if (document.querySelector('input[name="payment_mode"]:checked')) {
            const defaultPaymentMode = document.querySelector('input[name="payment_mode"]:checked').value;
            fetchCharges(defaultPaymentMode);
        }
    });
    if (document.getElementById("placeOrder")) {
        document.getElementById("placeOrder").addEventListener("click", function() {
            $('#placeOrder').hide();
            $('#checkout-loader').show();
            const selectedPaymentMode = document.querySelector('input[name="payment_mode"]:checked').value;
            $.ajax({
                url: baseUrl + 'checkout-process',
                type: 'POST',
                data: {
                    payment_mode: selectedPaymentMode,
                    _token: '{{ csrf_token() }}' // Laravel CSRF token
                },
                success: function(response) {
                    $('#placeOrder').show();
                    $('#checkout-loader').hide();
                    // Handle success response
                    // alert(response.message + ' Order ID: ' + response.order_id);
                    window.location.href = baseUrl + 'order-success/' + response.order_id;
                },
                error: function(xhr) {
                    $('#placeOrder').show();
                    $('#checkout-loader').hide();
                    // Handle error response
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    }
</script>
</body>

</html>