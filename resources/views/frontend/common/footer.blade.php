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
                            <li><a href="{{ route('return-refund-policy')}}">Return & Refund Policy</a></li>
                            <li><a href="{{ route('shipping-policy')}}">Shipping Policy</a></li>
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
    <form class="search-box" action="{{ route('search.product') }}" method="GET">
        <input type="text" name="search" placeholder="Search products..." />
        <button id="close" type="submit"><i class="ion-ios-search-strong"></i></button>
    </form>
    <button class="btn-close"><i class="ion-android-close"></i></button>
</div>
<!-- search-box and overlay end -->




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

        const loginModal = new bootstrap.Modal(document.getElementById('login'));
        const otpModal = new bootstrap.Modal(document.getElementById('otp'));
        const loginForm = document.getElementById('login-form');
        const otpForm = document.getElementById('otp-form');
        const loginPhone = document.getElementById('loginPhone');
        const sendOtpButton = document.getElementById('sendOtpButton');
        const loginLoader = document.getElementById('login-loader');
        const otpInputs = document.querySelectorAll('.otp-field > input'); // Assuming class for OTP inputs

        // Helper function to validate phone number (optional)
        function validatePhoneNumber(phoneNumber) {
            // Add your phone number validation logic here
            // (e.g., check for minimum length, presence of digits)
            return phoneNumber.length === 10 && /^\d+$/.test(phoneNumber);
        }

        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent default form submission

            const Number = loginPhone.value;

            if (!validatePhoneNumber(Number)) {
                errorToast('Invalid phone number');
                return;
            }
            try {
                sendOtpButton.classList.add('d-none'); // Hide button
                loginLoader.classList.remove('d-none'); // Show loader

                // Initialize reCAPTCHA verifier (optional: set 'size': 'invisible' for smoother UX)
                const appVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                    'size': 'invisible' // Optional: Use invisible reCAPTCHA
                });
                const phoneNumber = '+91' + Number;
                // Trigger reCAPTCHA challenge and send OTP
                const confirmationResult = await firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier);

                // Open OTP modal
                otpModal.show();

                otpForm.addEventListener('submit', async (event) => {
                    event.preventDefault(); // Prevent default form submission
                    const otpArray = Object.values(otpInputs); // Convert object to array
                    const otp = otpArray.reduce((acc, input) => acc + (input.value || ''), '');
                    if (otp.length != 6) {
                        errorToast('OTP must be 6 digit!');
                        return;
                    }
                    try {
                        document.getElementById('verifyOtpButton').classList.add('d-none'); // Hide button
                        document.getElementById('otp-loader').classList.remove('d-none'); // Show loader
                        // Confirm OTP
                        const result = await confirmationResult.confirm(otp);
                        const user = result.user;

                        console.log('User signed in successfully:', user);

                        // Handle successful login based on your backend logic
                        // (Example: Send ID token for backend verification)
                        const idToken = await user.getIdToken();
                        const response = await fetch(baseUrl + 'login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Assuming you have CSRF protection
                            },
                            body: JSON.stringify({
                                phone: Number,
                                token: user.uid
                            })
                        });
                        const data = await response.json();
                        console.log('Backend response:', data);

                        if (data.success) {
                            successToast('Successfully Logged In!');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                            otpModal.hide(); // Close OTP modal on successful login
                        } else {
                            document.getElementById('verifyOtpButton').classList.remove('d-none'); // show button
                            document.getElementById('otp-loader').classList.add('d-none'); // hide loader
                            console.error('Backend verification failed:', data.message || 'Unknown error');
                            errorToast(data.message || 'Login failed. Please try again.');
                        }
                    } catch (error) {
                        document.getElementById('verifyOtpButton').classList.remove('d-none'); // show button
                        document.getElementById('otp-loader').classList.add('d-none'); // hide loader
                        console.error('Error during OTP confirmation:', error);
                        errorToast('Wrong OTP entered. Please try again.'); // Consistent error message
                    } finally {
                        // Reset UI state
                        document.getElementById('verifyOtpButton').classList.remove('d-none'); // show button
                        document.getElementById('otp-loader').classList.add('d-none'); // hide loader
                        otpForm.reset(); // Clear OTP form inputs
                    }
                });
            } catch (error) {
                // console.error('Error during sign in:', error);
                sendOtpButton.classList.remove('d-none'); // Show button again
                loginLoader.classList.add('d-none'); // Hide loader
                errorToast('An error occurred. Please try again.'); // Generic error message
            }
        });
    });

    const inputs = document.querySelectorAll(".otp-field > input");
    // const button = document.getElementById('verifyOtpButton');

    window.addEventListener("load", () => inputs[0].focus());
    // button.setAttribute("disabled", "disabled");

    inputs[0].addEventListener("paste", function(event) {
        event.preventDefault();

        const pastedValue = (event.clipboardData || window.clipboardData).getData(
            "text"
        );
        const otpLength = inputs.length;

        for (let i = 0; i < otpLength; i++) {
            if (i < pastedValue.length) {
                inputs[i].value = pastedValue[i];
                inputs[i].removeAttribute("disabled");
                inputs[i].focus;
            } else {
                inputs[i].value = ""; // Clear any remaining inputs
                inputs[i].focus;
            }
        }
    });

    inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            const currentInput = input;
            const nextInput = input.nextElementSibling;
            const prevInput = input.previousElementSibling;

            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }

            if (
                nextInput &&
                nextInput.hasAttribute("disabled") &&
                currentInput.value !== ""
            ) {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }

            if (e.key === "Backspace") {
                inputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }

            // button.classList.remove("active");
            // button.setAttribute("disabled", "disabled");

            // const inputsNo = inputs.length;
            // if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
            //     button.classList.add("active");
            //     button.removeAttribute("disabled");

            //     return;
            // }
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
                        updateSubTotal(parseFloat(document.getElementById('promo_code_discount').innerText), parseFloat(document.getElementById('wallet_discount').innerText));
                        // document.getElementById('subTotal').innerText = data.data.sub_total;
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
            const isWalletChecked =  document.getElementById('wallet').checked;
            const promoCodeValue = document.getElementById('promoCodeInput').value.trim();
            $.ajax({
                url: baseUrl + 'checkout-process',
                type: 'POST',
                data: {
                    payment_mode: selectedPaymentMode,
                    isWalletChecked: isWalletChecked,
                    promoCodeValue: promoCodeValue,
                    _token: '{{ csrf_token() }}' // Laravel CSRF token
                },
                success: function(response) {
                    $('#placeOrder').show();
                    $('#checkout-loader').hide();
                    // Handle success response
                    // alert(response.message + ' Order ID: ' + response.order_id);
                    // Handle success response based on payment mode
                    if (selectedPaymentMode === '1') {
                        // Handle COD payment success
                        window.location.href = baseUrl + 'order-success/' + response.order_id;
                    } else if (selectedPaymentMode === '2') {
                        // Handle prepaid payment success
                        console.log('response', response)
                        if (response.data.success) {
                            // alert('Prepaid order placed successfully. Order ID: ' + response.order_id);
                            window.location.href = response.redirectUrl;
                        } else {
                            alert('Some error occurred! Please try after some time')
                        }
                        // Redirect to payment gateway or other actions
                    }
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
    document.getElementById('wallet').addEventListener('change', function() {
        if (this.checked) {
            applyWalletDiscount();
        } else {
            removeWalletDiscount();
        }
    });

    function applyWalletDiscount() {
        fetch(baseUrl + 'apply-wallet-discount', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Show wallet discount in the UI
                    updateSubTotal(parseFloat(document.getElementById('promo_code_discount').innerText), data.walletDiscount);
                    document.getElementById('walletDiv').classList.remove('d-none'); // Show the wallet discount section
                    successToast(data.message);
                } else {
                    errorToast(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function removeWalletDiscount() {
        const walletDiscount = 0; // Or however you calculate this
        document.getElementById('walletDiv').classList.add('d-none'); // Hide wallet discount
        updateSubTotal(parseFloat(document.getElementById('promo_code_discount').innerText), walletDiscount);
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Target the promo code form by its ID
        const promoForm = document.getElementById('promo_code_submit');

        promoForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const promoCodeInput = promoForm.querySelector('input[placeholder="Apply Coupon"]');
            const promoCode = promoCodeInput.value.trim();

            if (!promoCode) {
                errorToast('Please enter a promo code!');
                return;
            }

            applyPromoCode(promoCode);
        });
    });

    let appliedWalletDiscount = 0;

    function applyPromoCode(promoCode) {
        fetch(baseUrl + 'apply-promo-code', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    promo_code: promoCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Apply promo code discount
                    document.getElementById('promo_code_discount').innerText = data.PromoDiscount;

                    // Update subtotal with promo discount, wallet, and shipping
                    updateSubTotal(data.promoDiscount, parseFloat(document.getElementById('wallet_discount').innerText));
                    document.getElementById('clearPromoCode').classList.remove('d-none'); // Show the promo discount
                    document.getElementById('promoDive').classList.remove('d-none'); // Show the promo discount
                    successToast(data.message);
                } else {
                    errorToast(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function removePromoCode() {
        document.getElementById('promoCodeInput').value = ''; 
        document.getElementById('promoDive').classList.add('d-none');
        document.getElementById('clearPromoCode').classList.add('d-none'); // Show the promo discount
        // Reset promo discount to 0 and update the subtotal
        updateSubTotal(0, parseFloat(document.getElementById('wallet_discount').innerText));

    }

    function updateSubTotal(promoDiscount = 0, walletDiscount = 0) {
        // Get the original subtotal from your HTML
        const originalSubTotal = parseFloat(document.getElementById('cart_total').innerText);
        const originalShipping = parseFloat(document.getElementById('shipping').innerText);
        // Calculate the total discount
        const totalDiscount = parseFloat(promoDiscount) + parseFloat(walletDiscount);

        // Calculate the new subtotal
        const newSubTotal = originalSubTotal - totalDiscount;

        // Update the subtotal display in the HTML
        document.getElementById('subTotal').innerText = newSubTotal.toFixed(2); // 2 decimal places

        // Update promo and wallet discounts in the UI
        document.getElementById('promo_code_discount').innerText = promoDiscount;
        document.getElementById('wallet_discount').innerText = walletDiscount;

        // Calculate final total (subtotal + shipping)
        const finalTotal = newSubTotal + originalShipping; // Assuming final total is subtotal + shipping
        console.log(finalTotal);
        document.getElementById('subTotal').innerText = finalTotal;
    }
</script>
@if(auth()->check() && !auth()->user()->name)
<script>
    $(document).ready(function() {
        $('#signup').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('#signup').on('hide.bs.modal', function(e) {
            e.preventDefault(); // Prevents the modal from closing
        });
    });
    const signupModal = new bootstrap.Modal(document.getElementById('signup'));
    signupModal.show();
</script>
@endif
</body>

</html>