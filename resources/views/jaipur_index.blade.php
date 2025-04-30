<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somewhere in Jaipur</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('jaipur/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Avenir&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/the-bellonte" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Avenir', sans-serif;
            background-color: #FFF6EF;
        }
        h1,
        h2,
        h3,
        h4 {
            font-family: 'Playfair Display', serif;
        }

        .hero-image-wrapper {
            width: 100%;
            max-height: 550px;
            overflow: hidden;
            border-bottom-left-radius: 5% 10%;
            border-bottom-right-radius: 5% 10%;
            position: relative;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: grayscale(100%);
        }

        .hero-overlay-text {
            bottom: 0px;
            /* pulls the half-circle closer to the bottom */
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            width: 200px;
            height: 100px;
        }

        .hero-overlay-circle {
            background-color: #fff6ef;
            width: 100%;
            height: 100%;
            border-top-left-radius: 100px;
            border-top-right-radius: 100px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
        }

        .hero-logo {
            margin-top: 20px;
            max-width: 150px;
            height: auto;
        }


        .btn-custom {
            background-color: #968070;
            color: #fff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #cdd8dd;
            color: #000;
        }


        .btn-custom {
            background-color: #968070;
            color: #fff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #cdd8dd;
            color: #000;
        }

        .section {
            padding-top: 3rem;
            padding-bottom: 1rem;
        }

        .badge-custom {
            font-family: 'Playfair Display' !important;
            margin: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background-color: #D7C6B5;
            color: #000;
            font-weight: 500;
        }

        .badge-custom-2 {
            font-family: 'Playfair Display' !important;
            margin: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background-color: #cdd8dd;
            color: #000;
            font-weight: 500;
        }

        .badge-custom-3 {
            font-family: 'Playfair Display' !important;
            margin: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background-color: #968070;
            color: #000;
            font-weight: 500;
        }

        .badge-custom-4 {
            font-family: 'Playfair Display' !important;
            margin: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            color: #000;
            border: 1px solid #968070;
            font-weight: 500;
            font-size: 0.975rem;
        }

        .badge-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .badge-container span {
            padding: 12px 18px;
            border-radius: 20px;
            font-size: 0.975rem;
            white-space: nowrap;
        }

        .footer {
            background-color: #968070;
            color: #fff;
            padding: 2rem 0;
        }

        .footer a img {
            transition: opacity 0.3s ease;
        }

        .footer-logo {
            margin-top: 20px;
            max-width: 300px;
            height: auto;
        }

        @media (max-width: 768px) {
            .footer-logo {
                max-width: 250px;
            }

            .image-1 {
                height: 150px;
            }

            .image-2 {
                height: 240px;
            }

            .image-3 {
                height: 270px;
            }

            .features-heading {
                font-size: 1.5rem !important;
            }

            .badge-container span {
                font-size: 0.870rem;
            }

            .hero-overlay-text {
                width: 180px;
                height: 90px;
            }

            .hero-logo {
                max-width: 130px;
            }

            .feature-content {
                font-size: 16px !important;
            }
        }

        .feature-content {
            font-size: 35px;
        }

        .footer a:hover img {
            opacity: 0.75;
        }

        .rounded-border {
            border-radius: 10px;
            border: 1.7px solid #968070;
            color: #968070
        }

        .bg-image-title {
            background-image: url('{{asset("jaipur/bg1.jpeg")}}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 200px;
            /* Adjust height as needed */
            background-color: #968070;
            /* Fallback color */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            /* Needed for overlay positioning */
        }

        .bg-image-title::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(150, 128, 112, 0.5);
            /* Adjust the overlay color and opacity */
            z-index: 1;
            /* Ensures overlay is below text */
        }

        .bg-image-title h2,
        .bg-image-title h1 {
            position: relative;
            z-index: 2;
            /* Ensures text is above overlay */
            margin: 0;
            color: #FFF6EF;
            /* Text color */
        }

        .bg-image-content {
            background-image: url('{{asset("jaipur/bg2.png")}}');
            background-size: auto;
            background-position: bottom;
            background-repeat: no-repeat;
        }

        .image-wrapper {
            overflow: hidden;
        }

        .features-heading {
            color: #aac5d1;
            font-size: 5rem;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section d-flex flex-column align-items-center justify-content-center">
        <div class="hero-image-wrapper position-relative">
            <img src="{{ asset('jaipur/main_banner.jpeg') }}" alt="Somewhere in Jaipur" class="img-fluid hero-image">

            <div class="hero-overlay-text position-absolute text-center">
                <div class="hero-overlay-circle d-flex align-items-center justify-content-center">
                    <img src="{{ asset('jaipur/logo.png') }}" alt="Somewhere in Jaipur" class="img-fluid hero-logo">
                </div>
            </div>

        </div>
    </section>

    <!-- Features Section -->
    <section class="section container-fluid text-center">
        <h1 class="features-heading mx-auto animate__animated  animate__fadeInLeft">
            LONG & SHORT TERM STAYS |
        </h1>
        <h1 class="features-heading mx-auto animate__animated  animate__fadeInRight">
            CREATIVE RENTALS | POP
        </h1>
        <h1 class="features-heading mx-auto animate__animated  animate__fadeInLeft">
            -UPS | EXPERIENCES & MORE
        </h1>
    </section>

    <!-- BOOK NOW Button -->
    <div class="w-100 text-center">
        <h5 class="mx-auto py-1 btn" style="cursor: pointer;background-color:#968070;color:#fff6ef;font-family:'Playfair Display'" data-bs-toggle="modal" data-bs-target="#bookNowModal">
            BOOK NOW
        </h5>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bookNowModal" tabindex="-1" aria-labelledby="bookNowModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="bookNowModalLabel">Get in Touch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Contact us via WhatsApp or Email to book your stay or experience!</p>
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <!-- WhatsApp Button -->
                        <a href="https://wa.me/917891922244?text=Hello,%20I%20am%20interested%20in%20booking.%20Please%20provide%20details." target="_blank" class="btn d-flex align-items-center gap-2" style="background-color:#968070;color:#fff6ef;font-family:'Playfair Display">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>

                        <!-- Email Button -->
                        <a href="mailto:somewhereinjaipur@gmail.com" class="btn d-flex align-items-center gap-2" style="background-color:#cdd8dd;color:#000;font-family:'Playfair Display;">
                            <i class="bi bi-envelope-fill"></i> Email
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="section container text-center">
        <div class="row g-4 justify-content-center">
            <!-- Block 1 -->
            <div class="col-md-5 col-6">
                <div class="p-2 rounded-border w-100 h-100" style="border-color:#bb9c88">
                    <p class="m-0 feature-content" style="font-family: 'Playfair Display', serif;text-align: left;color:#bb9c88">Designed for living, working & creating.</p>
                </div>
            </div>
            <div class="col-md-5 col-6">
                <div id="carouselBlock2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('jaipur/image5.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('jaipur/image6.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('jaipur/image7.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('jaipur/image10.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBlock2" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBlock2" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-10 col-12">
                <div class="p-4 rounded-border w-100 h-100" style="border-color:#86b2c6">
                    <p class="m-0" style="font-family: 'Playfair Display', serif;">
                    <ul style="list-style: none; padding-left: 0;text-align: left;color:#86b2c6">
                        <li><strong>Sleeps up to 7 guests –</strong> 2.5 beds</li>
                        <li><strong>Open-concept kitchen with sunroof –</strong> airy and well-lit</li>
                        <li><strong>2 modern and spacious bathrooms</strong></li>
                        <li><strong>Private terrace deck –</strong> perfect for sunbathing or morning coffee</li>
                        <li><strong>Cozy lounging area </strong> for relaxing or socializing</li>
                    </ul>

                    </p>
                </div>
            </div>
            <!-- Block 3 -->
            <div class="col-md-5 col-6">
                <div id="carouselBlock1" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        <div class="carousel-item active">
                            <img src="{{ asset('jaipur/image8.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('jaipur/image3.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('jaipur/image9.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('jaipur/image12.jpeg') }}" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBlock1" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBlock1" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-5 col-6">
                <div class="p-2 rounded-border w-100 h-100">
                    <p class="m-0 feature-content" style="font-family: 'Playfair Display', serif;text-align: left;">
                        Soaked in sunlight, styled with intention, and fully equipped for restful nights, shoots, and everything in between.
                    </p>
                </div>
            </div>
        </div>


        <div class="mt-5 badge-container">
            <span class="badge-custom">LONG TERM STAY</span>
            <span class="badge-custom-2">SHORT TERM STAY</span>
            <span class="badge-custom-3">PHOTOSHOOT</span>
            <span class="badge-custom-2">POP - UP</span>
            <span class="badge-custom">EVENT</span>
            <span class="badge-custom-2">CELEBRATION</span>
            <span class="badge-custom-3">CO - WORKING SPACE</span>
        </div>
        <br>
        <span class="badge-custom-4 text-center">...or anything that sounds like a "why not?"</span>
    </section>

    <!-- Curate Your Stay -->
    <section class="section p-0">
        <!-- Title with separate background image -->
        <div class="bg-image-title py-4">
            <h2 class="text-center mb-0" style="color:#FFF6EF">Here’s how we</h2>
            <h1 class="text-center mb-0" style="color:#FFF6EF"><b>Curate Your Stay</b></h1>
        </div>


        <!-- Content with another background image placed below the heading -->
        <div class="bg-image-content py-5 container-fluid" style="padding-bottom: 1rem !important;">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-border">
                        <h4><b>(1) Day out with the hosts!</b></h4>
                        <p style="text-align: left;">We'll take you to secret cafes, vintage stores,artist homes, and hidden gems — all curated to your tastes and desires. Discover the city’s rich handicrafts, unique textiles, and those
                            magical nooks that aren’t on Google Maps.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-border">
                        <h4><b>(2) Sip the Globe!</b></h4>
                        <p style="text-align: left;">Take your taste buds on a global tour! From Scotland’s finest malts to Japan’s smoothest blends, our premium spirits menu lets you sip your way around the world.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-border">
                        <h4><b>(3) A Special Something Just for You</b></h4>
                        <p style="text-align: left;">Tell us what you're in the mood for — a pasta- making date under the stars, an intimate candlelit dinner, or something delightfully unexpected. We’ll take care of the mood, the magic, and every little detail in between. Whether it’s for love, celebration, or simply joy, consider it thoughtfully arranged and beautifully yours.</p>
                    </div>
                </div>
            </div>
            <div class="w-100 text-center mt-2">
                <h5 class="mx-auto py-1 btn" style="cursor: pointer;background-color:#968070;color:#fff6ef;font-family:'Playfair Display" data-bs-toggle="modal" data-bs-target="#bookNowModal">
                    BOOK NOW
                </h5>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <!-- Left: Logo -->
                <div class="col-12 col-md-8 text-start">
                    <img src="{{ asset('jaipur/logo_light.png') }}" alt="Somewhere in Jaipur" class="img-fluid footer-logo">
                </div>

                <!-- Right: Text + Social -->
                <div class="col-12 col-md-4 text-start">
                    <h1 class="mb-1" style="font-family: 'The Bellonte';color:#cdd8dd">Curated with care. Shared with love.</h4>
                        <h5 class="mb-1" style="font-family: 'Avenir', sans-serif; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#bookNowModal">Contact Us</h5>
                        <div>
                            <a href="https://www.instagram.com/somewhereinjaipur/" target="_blank" rel="noopener noreferrer"><img src="{{ asset('jaipur/instagram-icon.png') }}" alt="Instagram" width="40"></a>
                            <a href="https://in.pinterest.com/somewhereinjaipur/" target="_blank" rel="noopener noreferrer" class="ms-3"><img src="{{ asset('jaipur/pinterest-icon.png') }}" alt="Pinterest" width="40"></a>
                        </div>
                </div>

            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            });

            document.querySelectorAll('.slide-on-scroll').forEach(elem => {
                observer.observe(elem);
            });
        });
    </script>
</body>

</html>