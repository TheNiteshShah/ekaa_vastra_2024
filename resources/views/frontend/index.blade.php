@extends('frontend.base_template')
@section('title', $title)
@section('main')
<!-- main slider start -->
<section class="bg-light position-relative">
    <div class="main-slider dots-style theme1">
        @foreach($sliderData as $index => $slider)
        <picture>
            <!-- Mobile optimized image with WebP support and explicit dimensions -->
            <source srcset="{{ asset($slider->mob_image) }}"  media="(max-width: 768px)" type="image/webp" {{ $index === 0 ? 'fetchpriority=high' : '' }}>
            <!-- Fallback image with proper alt text -->
            <img src="{{ asset($slider->web_image) }}" alt="{{ $slider->alt_text ?? 'Image showcasing our latest collection' }}" {{ $index === 0 ? 'fetchpriority=high' : '' }}>
        </picture>
        @endforeach
    </div>

    <!-- slick-progress -->
    <div class="slick-progress" aria-hidden="true">
        <span></span>
    </div>
    <!-- slick-progress end-->
</section>

<!-- main slider end -->

<!-- common banner  start -->
<!-- <div class="common-banner pt-70 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-30">
                <div class="position-relative zoom-in overflow-hidden">
                    <div class="banner-thumb">
                        <img src="{{asset('frontend/img/banner/banner1.jpg')}}" alt="banner-thumb-naile">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-30">
                <div class="position-relative zoom-in overflow-hidden">
                    <div class="banner-thumb">
                        <img src="{{asset('frontend/img/banner/banner2.jpg')}}" alt="banner-thumb-naile">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- common banner  end -->
@if(!empty($trendingData))
<!-- New Arrivals Section Start -->
<section class="theme1 bg-white pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Title -->
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize mb-20">New Arrivals - Ekaa Vastra</h2>
                    <p class="text">Explore our latest collection of women's ethnic wear, including kurtas, co-ord sets, and suit sets.</p>
                </div>
            </div>

            <div class="col-12">
                <div class="product-slider-init slick-nav" aria-label="New Arrivals Slider">
                    @foreach($trendingData as $trend)
                    <div class="slider-item" itemscope itemtype="https://schema.org/Product">
                        <div class="card product-card">
                            <div class="card-body p-0">
                                <div class="media flex-column">
                                    <!-- Product Image Section -->
                                    <div class="product-thumbnail w-100 position-relative">
                                        @if($trend->label)
                                        <span class="badge badge-danger top-left" itemprop="keywords">{{ $trend->label }}</span>
                                        @endif

                                        <a class="d-block" href="{{ route('product', strtolower(str_replace('+', '-', urlencode($trend->name)))) }}" itemprop="url">
                                            <img class="first-img" loading="lazy" src="{{ asset($trend->image) }}" alt="{{ $trend->name }}" itemprop="image">
                                            <img class="second-img" loading="lazy" src="{{ asset($trend->image2 ?: $trend->image1) }}" alt="{{ $trend->name }} - Alternative View">
                                        </a>

                                        @if(auth()->check())
                                        @php
                                        $isInWishlist = in_array($trend->id, $wishlistProductIds);
                                        @endphp
                                        <a href="javascript:void(0)" onclick="toggleWishlist({{ $trend->id }}, this)" aria-label="Toggle Wishlist for {{ $trend->name }}">
                                            <span class="hear-icon top-right product{{ $trend->id }}">
                                                <i class="{{ $isInWishlist ? 'ion-ios-heart' : 'ion-ios-heart-outline' }}"></i>
                                            </span>
                                        </a>
                                        @endif
                                    </div>

                                    <!-- Product Details Section -->
                                    <div class="media-body">
                                        <div class="product-desc">
                                            <span class="logo-text" itemprop="brand">Ekaa Vastra</span>
                                            <h3 class="title mb-10">
                                                <a href="{{ route('product', strtolower(str_replace('+', '-', urlencode($trend->name)))) }}" itemprop="name">{{ $trend->name }}</a>
                                            </h3>
                                            <h6 class="product-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                                <meta itemprop="priceCurrency" content="INR">
                                                <del class="del">₹{{ $trend->mrp }}</del>
                                                <span class="onsale" itemprop="price">₹{{ $trend->selling_price }}</span>
                                                <link itemprop="availability" href="https://schema.org/InStock">
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- New Arrivals Section End -->
@endif

<!-- common-banner start -->
@if(isset($bannerData[0]))
<!-- Common Banner Section Start -->
<section class="common-banner pb-70 bg-white">
    <div class="row">
        <div class="col-12">
            <div class="position-relative overflow-hidden">
                <div class="banner-thumb banner-large">
                    <picture>
                        <!-- Source for mobile -->
                        <source srcset="{{ asset($bannerData[0]->mob_image) }}" loading="lazy" media="(max-width: 768px)">
                        <!-- Source for desktop -->
                        <img src="{{ asset($bannerData[0]->web_image) }}" loading="lazy" alt="{{ $bannerData[0]->alt_text ?? 'Ekaa Vastra Banner' }}">
                    </picture>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Common Banner Section End -->
@endif

<!-- Featured Products Section Start -->
<section class="theme1 bg-white pb-70">
    <div class="container">
        <div class="row">
            <!-- Section Title -->
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h1 class="title text-dark text-capitalize mb-20">Featured Products</h1>
                    <p class="text">Browse the collection of our top-rated and trending products.</p>
                </div>
            </div>
            <!-- Product Slider -->
            <div class="col-12">
                <div class="product-slider-init slick-nav" aria-label="Featured Products Slider">
                    @foreach($topData as $trend)
                    <div class="slider-item">
                        <article class="card product-card">
                            <div class="card-body p-0">
                                <div class="media flex-column">
                                    <!-- Product Thumbnail -->
                                    <figure class="product-thumbnail w-100 position-relative">
                                        @if($trend->label)
                                        <span class="badge badge-danger top-left">{{ $trend->label }}</span>
                                        @endif
                                        <a class="d-block" href="{{ route('product', strtolower(str_replace('+', '-', urlencode($trend->name)))) }}" aria-label="View {{ $trend->name }}">
                                            <!-- Primary and Secondary Images -->
                                            <img class="first-img" loading="lazy" src="{{ asset($trend->image) }}" alt="{{ $trend->name }} - Front View">
                                            <img class="second-img" loading="lazy" src="{{ asset($trend->image2 ? $trend->image2 : $trend->image1) }}" alt="{{ $trend->name }} - Alternate View">
                                        </a>
                                        <!-- Wishlist Toggle -->
                                        @if(auth()->check())
                                        @php $isInWishlist = in_array($trend->id, $wishlistProductIds); @endphp
                                        <button type="button" onclick="toggleWishlist({{ $trend->id }}, this)" class="wishlist-btn" aria-label="{{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                                            <i class="{{ $isInWishlist ? 'ion-ios-heart' : 'ion-ios-heart-outline' }}"></i>
                                        </button>
                                        @endif
                                    </figure>
                                    <!-- Product Info -->
                                    <div class="media-body">
                                        <div class="product-desc">
                                            <span class="logo-text">Ekaa Vastra</span>
                                            <h2 class="title mb-10">
                                                <a href="{{ route('product', strtolower(str_replace('+', '-', urlencode($trend->name)))) }}" aria-label="Explore {{ $trend->name }}">
                                                    {{ $trend->name }}
                                                </a>
                                            </h2>
                                            <p class="product-price">
                                                <del class="del">₹{{ number_format($trend->mrp) }}</del>
                                                <span class="onsale">₹{{ number_format($trend->selling_price) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Featured Products Section End -->

<!-- Common Banner Section Start -->
@if(isset($bannerData[1]))
<section class="common-banner pb-70 bg-white">
    <div class="row">
        <div class="col-12">
            <figure class="banner-thumb banner-large position-relative overflow-hidden">
                <picture>
                    <!-- Mobile Image -->
                    <source srcset="{{ asset($bannerData[1]->mob_image) }}" loading="lazy" media="(max-width: 768px)">
                    <!-- Web Image -->
                    <img src="{{ asset($bannerData[1]->web_image) }}" loading="lazy" alt="{{ $bannerData[1]->alt_text ?? 'Promotional Banner' }}">
                </picture>
            </figure>
        </div>
    </div>
</section>
@endif
<!-- Common Banner Section End -->

<!-- Testimonial Section Start -->
@if(!empty($testimonialsData))
<section class="testimonial-section pb-30">
    <div class="container-fluid">
        <div class="row">
            <!-- Section Title -->
            <div class="col-12">
                <header class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize mb-20">Customer Testimonials</h2>
                    <p class="text">See what our valued customers have to say about Ekaa Vastra.</p>
                </header>
            </div>

            <!-- Testimonials Carousel -->
            <div class="col-12">
                <div class="testimonial-init dots-style" aria-label="Customer Testimonials Carousel">
                    @foreach($testimonialsData as $test)
                    <article class="slider-item" itemscope itemtype="https://schema.org/Review">
                        <div class="testimonial-content text-center">
                            <!-- Testimonial Image -->
                            <figure class="d-inline-block mb-30 mx-auto">
                                <img 
                                    loading="lazy" 
                                    src="{{ asset($test->image ?? 'frontend/img/profile/default.jpg') }}" 
                                    alt="{{ $test->name }}'s Testimonial" 
                                    itemprop="image">
                            </figure>

                            <!-- Star Rating -->
                            <div class="star-rating" aria-label="Rating: {{ $test->rating }} out of 5">
                                @for ($i = 0; $i < floor($test->rating); $i++)
                                    <span class="ion-ios-star" aria-hidden="true"></span>
                                @endfor
                                @if ($test->rating - floor($test->rating) > 0)
                                    <span class="ion-android-star-half" aria-hidden="true"></span>
                                @endif
                            </div>

                            <!-- Review Text -->
                            <blockquote>
                                <span class="ion-quote d-block float-left"></span>
                                <p itemprop="reviewBody">{{ $test->review }}</p>
                                <span class="ion-quote float-right"></span>
                            </blockquote>

                            <!-- Reviewer Name -->
                            <footer>
                                <h4 class="text-uppercase mb-15 mt-10" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                    <span itemprop="name">{{ $test->name }}</span>
                                </h4>
                            </footer>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Testimonial Section End -->

<!-- Start promises -->
<section class="static-media-section bg-white pt-70 pb-40" aria-label="Our Promises">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Free Shipping Promise -->
            <div class="col-md-2 col-sm-6 col-6 mb-30">
                <div class="d-flex static-media2 flex-column">
                    <img class="align-self-center mb-20" 
                         src="{{asset('frontend/img/icon/free-shipping.png')}}" 
                         alt="Free shipping on all orders" 
                         title="Free Shipping on All Orders">
                    <div class="media-body text-center">
                        <h4 class="title text-uppercase text-dark mb-25">
                            <a href="/shipping-policy" title="Learn more about our free shipping offer">Free Shipping*</a>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- Shipping pan-India -->
            <div class="col-md-2 col-sm-6 col-6 mb-30">
                <div class="d-flex static-media2 flex-column">
                    <img class="align-self-center mb-20" 
                         src="{{asset('frontend/img/icon/india.png')}}" 
                         alt="Shipping available across India" 
                         title="Shipping Available Across India">
                    <div class="media-body text-center">
                        <h4 class="title text-uppercase text-dark mb-25">
                            <a href="/shipping-info" title="Learn more about pan-India shipping">Shipping Pan-India</a>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- Secure Payment -->
            <div class="col-md-2 col-sm-6 col-6 mb-30">
                <div class="d-flex static-media2 flex-column">
                    <img class="align-self-center mb-20" 
                         src="{{asset('frontend/img/icon/card.png')}}" 
                         alt="Secure payment options" 
                         title="Safe and Secure Payment Options">
                    <div class="media-body text-center">
                        <h4 class="title text-uppercase text-dark mb-25">
                            <a href="/payment-methods" title="Explore our secure payment methods">Secure Payment</a>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- COD Available -->
            <div class="col-md-2 col-sm-6 col-6 mb-30">
                <div class="d-flex static-media2 flex-column">
                    <img class="align-self-center mb-20" 
                         src="{{asset('frontend/img/icon/cash-on-delivery.png')}}" 
                         alt="Cash on Delivery Available" 
                         title="Cash on Delivery Available for Your Convenience">
                    <div class="media-body text-center">
                        <h4 class="title text-uppercase text-dark mb-25">
                            <a href="/cod-availability" title="Learn more about Cash on Delivery availability">COD Available</a>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- Active Support -->
            <div class="col-md-2 col-sm-6 col-6 mb-30">
                <div class="d-flex static-media2 flex-column">
                    <img class="align-self-center mb-20" 
                         src="{{asset('frontend/img/icon/customer-service.png')}}" 
                         alt="Active customer support" 
                         title="24/7 Active Customer Support">
                    <div class="media-body text-center">
                        <h4 class="title text-uppercase text-dark mb-25">
                            <a href="/customer-support" title="Contact our customer support for assistance">Active Support</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End promises -->

<!-- common-banner start -->
<!-- <div class="common-banner pb-30 bg-white">
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="position-relative overflow-hidden">
                    <div class="banner-thumb banner-lagre">
                        <picture>
                            <source srcset="{{asset('frontend/img/promises.jpg')}}" loading="lazy" media="(max-width: 768px)">
                            <img src="{{asset('frontend/img/promises.jpg')}}" loading="lazy" alt="Slider Image">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- common-banner end -->


<!-- blog-section start -->
<!-- <section class="blog-section theme1 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize">Latest Blogs</h2>
                    <p class="text mt-20">Present posts in a best way to highlight interesting moments of your blog.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="blog-init slick-nav">
                    <div class="slider-item">
                        <div class="single-blog">
                            <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden" href="blog-grid-left-sidebar.html">
                                <img src="{{asset('frontend/img/blog-post/blog1.jpg')}}" alt="blog-thumb-naile">
                            </a>
                            <div class="blog-post-content">
                                <h3 class="title text-capitalize mb-15"><a href="single-blog.html">Ekaa’S STYLE
                                        STARS: INFLUENCER AND CELEBRITY FASHION</a></h3>
                                <h5 class="sub-title mb-30 text-capitalize">From the grandeur of the silver screen
                                    to the dynamic realms of social media, celebrities, and influencers have
                                    emerged...</h5>
                                <a class="btn read-more text-capitalize" href="single-blog.html">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- blog-section end -->
@endsection