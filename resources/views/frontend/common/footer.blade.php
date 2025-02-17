@php
$categoryData = App\Models\CategoryModal::orderBy('seq','asc')->where('is_active',1)->get();
@endphp
<!-- Footer Start -->
<footer class="bg-lighten2 theme1 position-relative footer_bg" aria-label="Footer">
    <!-- Footer Bottom Start -->
    <div class="footer-bottom pt-70 pb-30">
        <div class="container">
            <div class="row">
                <!-- Footer Logo and Description -->
                <div class="col-12 col-sm-6 col-lg-4 mb-10">
                    <div class="footer-widget">
                        <div class="footer-logo mb-10">
                            <a href="{{ route('/') }}" title="Ekaa Vastra Home">
                                <img src="{{asset('frontend/img/logo.svg')}}" style="width:35%" alt="Ekaa Vastra - Empowering Women through Fashion">
                            </a>
                        </div>
                        <p class="text mb-35">
                            Founded in 2024, our journey began with a passion to empower individuals through the clothes they wear.
                        </p>
                        <div class="social-network">
                            <ul class="d-flex">
                                <li><a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/ekaavastra" title="Ekaa Vastra Facebook"><span class="ion-social-facebook"></span></a></li>
                                <li><a target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/ekaavastra" title="Ekaa Vastra Instagram"><span class="ion-social-instagram-outline"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="col-12 col-sm-6 col-lg-2 mb-10">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Categories</h2>
                        </div>
                        <ul class="footer-menu">
                            @foreach($categoryData as $category)
                            <li><a href="/category/{{$category->slug}}" title="Shop {{$category->name}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Information Section -->
                <div class="col-12 col-sm-6 col-lg-2 mb-10">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Information</h2>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="{{ route('about-us') }}" title="Learn about Ekaa Vastra">About Us</a></li>
                            <li><a href="{{ route('privacy-policy') }}" title="Read our Privacy Policy">Privacy Policy</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}" title="Terms & Conditions">Terms & Conditions</a></li>
                            <li><a href="{{ route('return-refund-policy') }}" title="Return & Refund Policy">Return & Refund Policy</a></li>
                            <li><a href="{{ route('shipping-policy') }}" title="Shipping Policy">Shipping Policy</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Customer Service Section -->
                <div class="col-12 col-sm-6 col-lg-4 mb-10">
                    <div class="footer-widget">
                        <div class="section-title mb-20">
                            <h2 class="title text-dark text-capitalize">Customer Service</h2>
                        </div>
                        <ul class="footer-menu">
                            <li><i class="ion-ios-telephone mr-10"></i><span>Mon - Fri : 9AM - 6PM</span></li>
                            <li><a href="tel:+919636373743" title="Call Ekaa Vastra"><i class="ion-ios-telephone mr-10"></i><span>+91 9636373743</span></a></li>
                            <li><a href="mailto:ekaavastra@gmail.com" title="Email Us" style="text-transform: lowercase;"><i class="ion-email mr-10"></i><span>ekaavastra@gmail.com</span></a></li>
                            <li><span><i class="ion-ios-location mr-10"></i>Sunshine Aditya, Kunda Road, Sirsi, Jaipur, Rajasthan, 302012</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->

    <!-- Copyright Start -->
    <div class="coppy-right">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="border-top py-20">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 col-xl-12 order-last order-md-first text">
                                <div class="text-center">
                                    <p class="mb-3 mb-md-0">&copy; <script>
                                            document.write(new Date().getFullYear())
                                        </script> <a href="{{ route('/') }}" title="Ekaa Vastra Home">Ekaa Vastra</a>. All Rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- WhatsApp Button -->
    <a class="btn btn-success white btn-lg mt-3 button-fixed-left green" href="https://wa.me/+919636373743/?text=Hi" role="button" title="Contact us on WhatsApp">
        <i class="ion-social-whatsapp-outline" style="font-size:25px"></i>
    </a>
</footer>
<!-- Footer End -->


<!-- Search Box and Overlay Start -->
<div class="overlay" aria-hidden="true" id="search-overlay">
    <div class="scale"></div>
    <form class="search-box" action="{{ route('search.product') }}" method="GET" role="search" aria-labelledby="search-form">
        <label for="search-input" class="sr-only" id="search-form">Search products</label>
        <input type="text" id="search-input" name="search" placeholder="Search products..." aria-label="Search for products" required>
        <button id="close" type="submit" aria-label="Submit search"><i class="ion-ios-search-strong"></i></button>
    </form>
    <button class="btn-close" aria-label="Close search overlay" onclick="closeSearchOverlay()"><i class="ion-android-close"></i></button>
</div>
<!-- Search Box and Overlay End -->

<!-- Modal for Selecting Size -->
<div class="modal fade" id="wishSizeModal" tabindex="-1" aria-labelledby="wishSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wishSizeModalLabel">Select Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Close modal"></button>
            </div>
            <div class="modal-body">
                <p id="size-description" class="text-muted">Please select the size for your product from the available options.</p>
                <nav class="shop-grid-nav mt-20" aria-labelledby="size-description">
                    <ul class="product-tag d-flex flex-wrap sizeList" id="wishSizeList" aria-labelledby="size-description">
                        <!-- Dynamically populated list of sizes will go here -->
                    </ul>
                </nav>
                <hr>
                <div class="text-center">
                    <button type="submit" onclick="event.preventDefault(); document.getElementById('move-product').submit();" class="btn theme-btn--dark1 btn--md" aria-label="Confirm size selection">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="post" id="move-product" action="{{ route('moveToCart')}}">
    @csrf
    <input type="hidden" name="ProductId" id="wishProductId" value="">
    <input type="hidden" name="TypeId" id="wishTypeId" value="">
</form>



<!--*********************** 
        all js files
     ***********************-->
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
<script src="{{asset('frontend/js/fancybox.umd.js')}}"></script>
<script src="{{asset('frontend/js/toastify.js')}}"></script>
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
    //------ TOP BAR ---------
    $(document).ready(function() {
        $('.offer-slider').slick({
            infinite: true, // Loop the slider
            slidesToShow: 1, // Show one slide at a time
            slidesToScroll: 1, // Scroll one slide at a time
            autoplay: true, // Enable autoplay
            autoplaySpeed: 3000, // Slide interval (3 seconds)
            speed: 500, // Transition speed between slides (500ms)
            arrows: false, // Disable previous/next arrows
            dots: true, // Enable navigation dots
            fade: false, // Disable fade effect (set to true for fade)
            pauseOnHover: true, // Pause autoplay when hovered
            draggable: true, // Allow dragging to scroll slides
            touchThreshold: 10, // The amount of drag distance to trigger a scroll (for mobile devices)

            // Responsive settings
            responsive: [{
                    breakpoint: 1024, // For screens >= 1024px (e.g., laptops and desktops)
                    settings: {
                        slidesToShow: 3, // Show 3 slides
                        slidesToScroll: 1, // Scroll 1 slide at a time
                        arrows: true, // Enable arrows
                        autoplaySpeed: 2000 // Set autoplay speed to 2 seconds
                    }
                },
                {
                    breakpoint: 768, // For screens >= 768px (e.g., tablets)
                    settings: {
                        slidesToShow: 2, // Show 2 slides
                        slidesToScroll: 1, // Scroll 1 slide at a time
                        autoplaySpeed: 2500 // Set autoplay speed to 2.5 seconds
                    }
                },
                {
                    breakpoint: 480, // For screens >= 480px (e.g., mobile devices)
                    settings: {
                        slidesToShow: 1, // Show 1 slide
                        slidesToScroll: 1, // Scroll 1 slide at a time
                        autoplaySpeed: 3000 // Set autoplay speed to 3 seconds
                    }
                }
            ]
        });
    });
    Fancybox.bind('[data-fancybox="gallery"]', {
        // Your custom options
    });
    window.addEventListener('load', function() {
        document.getElementById('loader').style.display = 'none';
    });
    //---- LOGIN FUNCTION ------
    document.addEventListener('DOMContentLoaded', function() {
        const loginModal = new bootstrap.Modal(document.getElementById('login'));
        const otpModal = new bootstrap.Modal(document.getElementById('otp'));
        const loginForm = document.getElementById('login-form');
        const otpForm = document.getElementById('otp-form');
        const loginEmail = document.getElementById('loginEmail'); // Email input instead of phone number
        const sendOtpButton = document.getElementById('sendOtpButton');
        const loginLoader = document.getElementById('login-loader');
        const otpInputs = document.querySelectorAll('.otp-field > input'); // Assuming class for OTP inputs

        // Helper function to validate email address
        function validateEmail(email) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailRegex.test(email);
        }

        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent default form submission

            const email = loginEmail.value;

            if (!validateEmail(email)) {
                errorToast('Invalid email address');
                return;
            }

            try {
                sendOtpButton.classList.add('d-none'); // Hide button
                loginLoader.classList.remove('d-none'); // Show loader

                // Send OTP to the email (Implement backend logic for generating and sending OTP)
                const response = await fetch(baseUrl + 'login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Assuming you have CSRF protection
                    },
                    body: JSON.stringify({
                        email: email
                    })
                });

                const data = await response.json();
                if (data.success) {
                    otpModal.show(); // Show OTP modal after email is sent
                    // Close the login modal
                    loginModal.hide();
                    // Reset the login form
                    // loginForm.reset();
                    // Optionally, if you want to clear any additional states (like hiding the loader and showing the button again)
                    sendOtpButton.classList.remove('d-none'); // Show the "Send OTP" button again
                    loginLoader.classList.add('d-none'); // Hide the login loader
                } else {
                    sendOtpButton.classList.remove('d-none'); // Show the "Send OTP" button again
                    loginLoader.classList.add('d-none'); // Hide the login loader
                    errorToast(data.message || 'Failed to send OTP.');
                }

            } catch (error) {
                sendOtpButton.classList.remove('d-none'); // Show button again
                loginLoader.classList.add('d-none'); // Hide loader
                errorToast('An error occurred. Please try again.');
            }
        });

        otpForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent default form submission
            const otpArray = Object.values(otpInputs); // Convert object to array
            const otp = otpArray.reduce((acc, input) => acc + (input.value || ''), '');

            if (otp.length !== 6) {
                errorToast('OTP must be 6 digits!');
                return;
            }

            try {
                document.getElementById('verifyOtpButton').classList.add('d-none'); // Hide button
                document.getElementById('otp-loader').classList.remove('d-none'); // Show loader

                // Verify OTP (Implement backend logic for OTP verification)
                const response = await fetch(baseUrl + 'verify-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: loginEmail.value,
                        otp: otp
                    })
                });

                const data = await response.json();
                if (data.success) {
                    // Handle successful login (Backend verification, etc.)
                    successToast('Successfully Logged In!');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    otpModal.hide(); // Close OTP modal on successful login
                } else {
                    document.getElementById('verifyOtpButton').classList.remove('d-none'); // Show button
                    document.getElementById('otp-loader').classList.add('d-none'); // Hide loader
                    errorToast(data.message || 'OTP verification failed.');
                }
            } catch (error) {
                document.getElementById('verifyOtpButton').classList.remove('d-none'); // Show button
                document.getElementById('otp-loader').classList.add('d-none'); // Hide loader
                errorToast('Error during OTP verification. Please try again.');
            } finally {
                // Reset UI state
                document.getElementById('verifyOtpButton').classList.remove('d-none'); // Show button
                document.getElementById('otp-loader').classList.add('d-none'); // Hide loader
                otpForm.reset(); // Clear OTP form inputs
            }
        });

        // OTP Inputs Handling
        const inputs = document.querySelectorAll(".otp-field > input");

        // Focus the first input field on page load
        window.addEventListener("load", () => inputs[0].focus());

        // Handle paste event to populate OTP fields
        inputs[0].addEventListener("paste", function(event) {
            event.preventDefault();

            const pastedValue = (event.clipboardData || window.clipboardData).getData("text");
            const otpLength = inputs.length;

            for (let i = 0; i < otpLength; i++) {
                if (i < pastedValue.length) {
                    inputs[i].value = pastedValue[i];
                    inputs[i].removeAttribute("disabled");
                    inputs[i].focus(); // Corrected to focus as a function
                } else {
                    inputs[i].value = ""; // Clear any remaining inputs
                    inputs[i].focus(); // Corrected to focus as a function
                }
            }
        });

        // Handle keyup event to manage OTP input flow
        inputs.forEach((input, index) => {
            input.addEventListener("input", (e) => {
                const currentInput = input;
                const nextInput = input.nextElementSibling;

                // Restrict each input to a single character
                if (currentInput.value.length > 1) {
                    currentInput.value = currentInput.value.slice(0, 1);
                }

                // Move focus to the next input if the current input is filled
                if (currentInput.value !== "" && nextInput) {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }
            });

            input.addEventListener("keydown", (e) => {
                const currentInput = input;
                const prevInput = input.previousElementSibling;
                const nextInput = input.nextElementSibling;

                if (e.key === "Backspace") {
                    e.preventDefault(); // Prevent default backspace behavior

                    // Clear the current input
                    if (currentInput.value !== "") {
                        currentInput.value = "";
                    } else if (prevInput) {
                        // Move focus to the previous input if empty
                        prevInput.focus();
                    }
                }

                // Allow moving forward when pressing a key after backspacing
                if (e.key.length === 1 && currentInput.value.length === 1 && nextInput) {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }
            });

            input.addEventListener("click", () => {
                // Clear the value of the clicked input only
                input.value = "";
            });

            // Enable the first input and disable all others on page load
            if (index === 0) {
                input.removeAttribute("disabled");
            } else {
                input.setAttribute("disabled", true);
            }
        });



    });
    //---- RESEND OTP FUNCTION ------
    let timerDuration = 60; // Timer duration in seconds
    let timerInterval; // To store the timer interval

    function startTimer() {
        const resendOtpButton = document.getElementById('resendOtpButton');
        const timerElement = document.getElementById('timer');

        resendOtpButton.disabled = true; // Disable the button
        timerElement.textContent = timerDuration; // Reset the timer display

        timerInterval = setInterval(() => {
            let currentTime = parseInt(timerElement.textContent);
            if (currentTime > 1) {
                timerElement.textContent = currentTime - 1;
            } else {
                clearInterval(timerInterval); // Stop the timer
                resendOtpButton.disabled = false; // Enable the button
                timerElement.textContent = '0';
                resendOtpButton.textContent = 'Resend OTP'; // Change button text
            }
        }, 1000);
    }

    // Call startTimer when the page loads to begin the countdown
    document.addEventListener('DOMContentLoaded', () => {
        startTimer();
    });

    // Handle the Resend OTP button click
    document.getElementById('resendOtpButton').addEventListener('click', async (event) => {
        event.preventDefault(); // Prevent default behavior
        const email = document.getElementById('loginEmail').value; // Fetch email value

        const resendOtpButton = event.target;
        resendOtpButton.disabled = true; // Disable the button during the request
        resendOtpButton.textContent = 'Sending...';

        try {
            const response = await fetch(baseUrl + 'login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    email: email,
                    resend: true, // Indicate it's a resend request
                }),
            });

            const data = await response.json();
            if (data.success) {
                successToast(data.message || 'OTP resent successfully.');

                // Update button text and start timer
                resendOtpButton.innerHTML = 'Resend OTP in <span id="timer">30</span>s';
                startTimer(); // Restart the timer
            } else {
                errorToast(data.message || 'Failed to resend OTP. Please try again.');
                resendOtpButton.disabled = false; // Re-enable the button
                resendOtpButton.textContent = 'Resend OTP';
            }
        } catch (error) {
            errorToast('An error occurred while resending OTP. Please try again.');
            console.log('Error:', error);
            resendOtpButton.disabled = false; // Re-enable the button
            resendOtpButton.textContent = 'Resend OTP';
        }
    });

    //------ SIZE MODAL FUNCTION ------
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
                        var out = '';
                        if (item.inventory == 0) {
                            out = "out";
                        }
                        var activeClass = (item.type_id == activeTypeId) ? 'active' : '';
                        sizesList.append('<li><a href="javascript:void(0)" onclick="updateTypeId(this,' + item.type_id + ')" class="' + activeClass + ' ' + out + '"  type_id = "' + item.type_id + '">' + item.size.name + '</a></li>');
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
    //------ WISHLIST MODAL FUNCTION ------
    $(document).ready(function() {
        $(document).on('click', '.btn[data-bs-target="#wishSizeModal"]', function() {
            var productId = $(this).data('product-id');
            var activeTypeId = $(this).data('type-id');
            var sizesList = $('#wishSizeList');
            sizesList.html('loading...');
            $.ajax({
                url: baseUrl + 'get-sizes/' + productId,
                method: 'GET',
                success: function(response) {
                    sizesList.empty();
                    response.forEach(function(item) {
                        var out = '';
                        if (item.inventory == 0) {
                            out = "out";
                        }
                        var activeClass = (item.type_id == activeTypeId) ? 'active' : '';
                        sizesList.append('<li><a href="javascript:void(0)" onclick="updateWishTypeId(this,' + item.type_id + ')" class="' + activeClass + ' ' + out + '"  type_id = "' + item.type_id + '">' + item.size.name + '</a></li>');
                    });
                    document.getElementById('wishProductId').value = productId;

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching sizes:', error);
                }
            });
        });
    });

    function updateWishTypeId(element, typeId) {
        // Update the hidden input value
        document.getElementById('wishTypeId').value = typeId;
        // Remove the "active" class from all <a> elements
        var links = document.querySelectorAll('#wishSizeList li a');
        links.forEach(function(link) {
            link.classList.remove('active');
        });
        // Add the "active" class to the clicked <a> element
        element.classList.add('active');
    }
    //------ QUANTITY MODAL FUNCTION ------
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
                        var out = '';
                        if (!item.stock) {
                            out = "out";
                        }
                        var activeClass = (item.qty == activeQty) ? 'active' : '';
                        QtyList.append('<li><a href="javascript:void(0)" onclick="updateQty(this,' + item.qty + ')" class="' + activeClass + ' ' + out + '"  type_id = "' + item.type_id + '">' + item.qty + '</a></li>');
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
    //------ FETCH CHARGES ------
    document.addEventListener('DOMContentLoaded', function() {
        async function fetchCharges(paymentMode) {
            const url = baseUrl + 'get-shipping-charges';
            try {
                const response = await fetch(`${url}/${paymentMode}`);
                const data = await response.json();

                if (data.error) {
                    errorToast('Failed to fetch charges');
                } else {
                    if (data.data.shipping === 0) {
                        document.getElementById('shipping').innerText = 'Free';
                    } else {
                        document.getElementById('shipping').innerText = data.data.shipping;
                    }
                    await fetchPaymentCharges(paymentMode); // Ensure this function is also async
                    updateSubTotal(
                        parseFloat(document.getElementById('promo_code_discount').innerText),
                        parseFloat(document.getElementById('wallet_discount').innerText)
                    );
                    // Uncomment and adjust if needed
                    // document.getElementById('subTotal').innerText = data.data.sub_total;
                }
            } catch (error) {
                console.error('Error fetching charges:', error);
                errorToast('Error fetching charges');
            }
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
            const isWalletChecked = document.getElementById('wallet').checked;
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
                        // console.log('response', response)
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
    //------ WALLET CHANGE ------
    document.addEventListener('DOMContentLoaded', function() {
        var walletElement = document.getElementById('wallet');
        if (walletElement) {
            walletElement.addEventListener('change', function() {
                if (this.checked) {
                    applyWalletDiscount();
                } else {
                    removeWalletDiscount();
                }
            });
        }
    })

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
    //------ APPLY PROMO CODE ------
    document.addEventListener('DOMContentLoaded', function() {
        // Target the promo code form by its ID
        const promoForm = document.getElementById('promo_code_submit');
        if (promoForm) {
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
        }
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
        let shippingText = document.getElementById('shipping').innerText.trim();
        const originalShipping = isNaN(parseFloat(shippingText)) ? 0 : parseFloat(shippingText);
        const codCharge = parseFloat(document.getElementById('cod_charge').innerText);
        const prepaidDiscount = parseFloat(document.getElementById('prepaid_discount').innerText);
        // Calculate the total discount
        const totalDiscount = parseFloat(promoDiscount) + parseFloat(walletDiscount) + prepaidDiscount;

        // Calculate the new subtotal
        const newSubTotal = originalSubTotal - totalDiscount;

        // Update the subtotal display in the HTML
        document.getElementById('subTotal').innerText = newSubTotal.toFixed(2); // 2 decimal places

        // Update promo and wallet discounts in the UI
        document.getElementById('promo_code_discount').innerText = promoDiscount;
        document.getElementById('wallet_discount').innerText = walletDiscount;

        // Calculate final total (subtotal + shipping)
        const finalTotal = newSubTotal + originalShipping + codCharge; // Assuming final total is subtotal + shipping
        // console.log(finalTotal);
        document.getElementById('subTotal').innerText = finalTotal;
    }

    function fetchPaymentCharges(paymentMode) {
        fetch(baseUrl + 'calculate-payment-charges', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    payment_mode: paymentMode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    // Apply promo code discount
                    document.getElementById('cod_charge').innerText = data.cod_charge;
                    document.getElementById('prepaid_discount').innerText = data.prepaid_discount;
                    if (data.prepaid_discount != '0') {
                        document.getElementById('CodDiv').classList.add('d-none'); // hide the cod charge
                        document.getElementById('prePaidDiv').classList.remove('d-none'); // Show the prepaid discount
                    } else {
                        document.getElementById('CodDiv').classList.remove('d-none'); // show the cod charge
                        document.getElementById('prePaidDiv').classList.add('d-none'); // hide the prepaid discount
                    }
                } else {
                    errorToast(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function toggleWishlist(productId, element) {
        $.ajax({
            url: baseUrl + 'wishlist/toggle',
            type: 'POST',
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var productElement = $('.product' + productId);
                if (response.status === 'added') {
                    productElement.find('i').removeClass('ion-ios-heart-outline').addClass('ion-ios-heart');
                    successToast('Product added to wishlist');

                } else if (response.status === 'removed') {
                    productElement.find('i').removeClass('ion-ios-heart').addClass('ion-ios-heart-outline');
                    successToast('Product removed from wishlist');

                }

                // Update the wishlist count
                $('.wishCount').text(response.wishlistCount);

                // Update the wishlist items in the offcanvas
                var wishlistHtml = '';
                if (response.wishlistItems.length > 0) {
                    $.each(response.wishlistItems, function(index, wish) {
                        wishlistHtml += '<li>';
                        wishlistHtml += '<a href="' + wish.product_url + '" class="image"><img src="' + wish.product_image + '" alt="Product Image"></a>';
                        wishlistHtml += '<div class="content">';
                        wishlistHtml += '<a href="' + wish.product_url + '" class="title">' + wish.product_name + '</a>';
                        wishlistHtml += '<h6 class="product-price">';
                        wishlistHtml += '<del class="del" style="font-size: 13px;">₹' + wish.product_mrp + '</del>';
                        wishlistHtml += '<span class="onsale" style="font-size: 13px;">₹' + wish.product_selling_price + '</span>';
                        wishlistHtml += '</h6>';
                        wishlistHtml += '<button class="btn theme-btn--dark3 btn--sm mt-10" data-bs-toggle="modal" data-bs-target="#wishSizeModal"';
                        wishlistHtml += ' data-product-id="' + wish.product_id + '" data-type-id="' + wish.type_id + '" >';
                        wishlistHtml += '<span class="me-2"><i class="ion-bag"></i></span> Move to bag</button>';
                        wishlistHtml += '</div>';
                        wishlistHtml += '</li>';
                    });
                } else {
                    wishlistHtml = '<div class="text-center"><img src="' + response.emptyWishlistImage + '" alt="Empty-Wishlist" class="img-fluid" style="width:50%"></div>';
                    wishlistHtml += '<h6 class="text-center mt-2">Your wishlist is empty!</h6>';
                }

                // Update the wishlist content in the offcanvas
                $('#offcanvas-wishlist .minicart-product-list').html(wishlistHtml);
            },
            error: function(xhr) {
                errorToast('An error occurred. Please try again');

            }
        });
    }

    function updateWishlistItems(items) {
        let wishlistContainer = $('#offcanvas-wishlist-items');
        wishlistContainer.empty();

        if (items.length === 0) {
            wishlistContainer.append('<p>Your wishlist is empty.</p>');
        } else {
            items.forEach(function(item) {
                wishlistContainer.append(`
                <div class="wishlist-item">
                    <p>${item.product.name}</p>
                    <p>Price: ₹${item.product.selling_price}</p>
                </div>
            `);
            });
        }
    }

    //---------------START TAB ATTRACT USER START ---------------
    // Original title of the website
    const originalTitle = document.title;

    // Messages to attract attention
    const attentionMessages = [
        "Don't miss our latest styles!👗",
        "Your wardrobe deserves an upgrade!👚",
        "New arrivals just for you!🛒",
    ];

    let messageIndex = 0;
    let attentionInterval;

    // Function to start attracting the user
    function startAttractingUser() {
        attentionInterval = setInterval(() => {
            // Change the document title periodically
            document.title = attentionMessages[messageIndex];
            messageIndex = (messageIndex + 1) % attentionMessages.length;
        }, 2000); // Change message every 2 second
    }

    // Function to stop attracting and reset the title
    function stopAttractingUser() {
        clearInterval(attentionInterval);
        document.title = originalTitle; // Restore the original title
    }

    // Event listener for visibility change
    document.addEventListener("visibilitychange", () => {
        if (document.hidden) {
            startAttractingUser(); // Tab is unfocused
        } else {
            stopAttractingUser(); // Tab is focused
        }
    });
    //---------------STOP TAB ATTRACT USER START ---------------
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