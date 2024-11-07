@extends('frontend.base_template')
@section('title', 'Home - Ekaa Vastra')
@section('main')
<!-- main slider start -->
<section class="bg-light position-relative">
    <div class="main-slider dots-style theme1">
        @foreach($sliderData as $slider)
        <picture>
            <!-- Source for mobile -->
            <source srcset="{{ asset($slider->mob_image) }}" loading="lazy" media="(max-width: 768px)">
            <!-- Source for web -->
            <img src="{{ asset($slider->web_image) }}" loading="lazy" alt="Slider Image">
        </picture>
        @endforeach
    </div>
    <!-- slick-progress -->
    <div class="slick-progress">
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
<!-- product tab start -->
<section class="theme1 bg-white pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize mb-20">New Arrivals</h2>
                    <p class="text">Browse the collection of our new arrivals products. </p>
                </div>
            </div>
            <div class="col-12">
                <div class="product-slider-init slick-nav">
                    @foreach($trendingData as $trend)
                    <div class="slider-item">
                        <div class="card product-card">
                            <div class="card-body p-0">
                                <div class="media flex-column">
                                    <div class="product-thumbnail w-100 position-relative">
                                        @if($trend->label)
                                        <span class="badge badge-danger top-left">{{$trend->label}}</span>
                                        @endif
                                        <a class="d-block" href="{{route('product',strtolower(str_replace('+', '-', urlencode($trend->name))))}}">
                                            <img class="first-img" loading="lazy" src="{{asset($trend->image)}}" alt="thumbnail">
                                            <img class="second-img" loading="lazy" src="{{asset($trend->image2?$trend->image2:$trend->image1)}}" alt="thumbnail">
                                        </a>
                                        @if(auth()->check())
                                        @php
                                        $isInWishlist = in_array($trend->id, $wishlistProductIds);
                                        @endphp
                                        <a href="javascript:void(0)" onclick="toggleWishlist({{ $trend->id }}, this)"><span class="hear-icon top-right product{{ $trend->id }}"> <i class="{{ $isInWishlist ? 'ion-ios-heart' : 'ion-ios-heart-outline' }}"></i></span></a>
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <div class="product-desc">
                                            <span class="logo-text">Ekaa Vastra</span>
                                            <h3 class="title mb-10"><a href="{{route('product',strtolower(str_replace('+', '-', urlencode($trend->name))))}}">{{$trend->name}}</a></h3>
                                            <h6 class="product-price"><del class="del">₹{{$trend->mrp}}</del>
                                                <span class="onsale">₹{{$trend->selling_price}}</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->
@endif
<!-- common-banner start -->
@if(isset($bannerData[0]))
<div class="common-banner pb-70 bg-white">
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="position-relative overflow-hidden">
                    <div class="banner-thumb banner-lagre">
                        <picture>
                            <!-- Source for mobile -->
                            <source srcset="{{ asset($bannerData[0]->mob_image) }}" loading="lazy" media="(max-width: 768px)">
                            <!-- Source for web -->
                            <img src="{{ asset($bannerData[0]->web_image) }}" loading="lazy" alt="Slider Image">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- common-banner end -->
<!-- new arrival section start -->
<section class="theme1 bg-white pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize mb-20">Featured products </h2>
                    <p class="text">Browse the collection of our featured products. </p>
                </div>
            </div>
            <div class="col-12">
                <div class="product-slider-init slick-nav">
                    @foreach($topData as $trend)
                    <div class="slider-item">
                        <div class="card product-card">
                            <div class="card-body p-0">
                                <div class="media flex-column">
                                    <div class="product-thumbnail w-100 position-relative">
                                        @if($trend->label)
                                        <span class="badge badge-danger top-left">{{$trend->label}}</span>
                                        @endif
                                        <a class="d-block" href="{{route('product',strtolower(str_replace('+', '-', urlencode($trend->name))))}}">
                                            <img class="first-img" loading="lazy" src="{{asset($trend->image)}}" alt="thumbnail">
                                            <img class="second-img" loading="lazy" src="{{asset($trend->image2?$trend->image2:$trend->image1)}}" alt="thumbnail">
                                        </a>
                                        @if(auth()->check())
                                        @php
                                        $isInWishlist = in_array($trend->id, $wishlistProductIds);
                                        @endphp
                                        <a href="javascript:void(0)" onclick="toggleWishlist({{ $trend->id }}, this)"><span class="hear-icon top-right product{{ $trend->id }}"> <i class="{{ $isInWishlist ? 'ion-ios-heart' : 'ion-ios-heart-outline' }}"></i></span></a>
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <div class="product-desc">
                                            <span class="logo-text">Ekaa Vastra</span>
                                            <h3 class="title mb-10"><a href="{{route('product',strtolower(str_replace('+', '-', urlencode($trend->name))))}}">{{$trend->name}}</a></h3>
                                            <h6 class="product-price"><del class="del">₹{{$trend->mrp}}</del>
                                                <span class="onsale">₹{{$trend->selling_price}}</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- new arrival section end -->
<!-- common-banner start -->
@if(isset($bannerData[1]))
<div class="common-banner pb-70 bg-white">
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="position-relative overflow-hidden">
                    <div class="banner-thumb banner-lagre">
                        <picture>
                            <!-- Source for mobile -->
                            <source srcset="{{ asset($bannerData[1]->mob_image) }}" loading="lazy" media="(max-width: 768px)">
                            <!-- Source for web -->
                            <img src="{{ asset($bannerData[1]->web_image) }}" loading="lazy" alt="Slider Image">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- common-banner end -->
<!-- testimonial-section start -->
@if(!empty($testimonialsData))
<section class="testimonial-section pb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize mb-20">Testimonials </h2>
                </div>
            </div>
            <div class="col-12">
                <div class="testimonial-init dots-style">
                    @foreach($testimonialsData as $test)
                    <div class="slider-item">
                        <div class="testimonial-content text-center">
                            @if($test->image)
                            <img class="mb-30 mx-auto" loading="lazy" src="{{asset($test->image)}}" alt="user">
                            @else
                            <img class="mb-30 mx-auto" loading="lazy" src="{{asset('frontend/img/profile/default.jpg')}}" alt="default">
                            @endif
                            <div class="star-rating">
                                @for ($i = 0; $i < floor($test->rating); $i++) <span class="ion-ios-star"></span> @endfor

                                    @if ($test->rating - floor($test->rating) > 0)
                                    <span class="ion-android-star-half"></span> @endif
                            </div>
                            <span class="ion-quote d-block float-left"></span>
                            <p>{{$test->review}}</p>
                            <span class="ion-quote float-right"></span>
                            <h4 class="text-uppercase mb-15 mt-10">{{$test->name}}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- testimonial-section end -->
<!-- common-banner start -->
<div class="common-banner pb-30 bg-white">
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="position-relative overflow-hidden">
                    <div class="banner-thumb banner-lagre">
                        <picture>
                            <!-- Source for mobile -->
                            <source srcset="{{asset('frontend/img/promises.jpg')}}" loading="lazy" media="(max-width: 768px)">
                            <!-- Source for web -->
                            <img src="{{asset('frontend/img/promises.jpg')}}" loading="lazy" alt="Slider Image">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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