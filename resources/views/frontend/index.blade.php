@extends('frontend.base_template')
@section('main')
<!-- main slider start -->
<section class="bg-light position-relative">
    <div class="main-slider dots-style theme1">
        @foreach($sliderData as $slider)
        <div class="slider-item bg-img" style="background-image: url('{{ asset($slider->image) }}');">
            <div class="container">
                <div class="row align-items-center slider-height">
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>
        <!-- slider-item end -->
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
<div class="common-banner pt-70 bg-white">
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
</div>
<!-- common banner  end -->
@if(!empty($trendingData))
<!-- product tab start -->
<section class="theme1 bg-white pb-70">
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
                                            <img class="first-img" src="{{asset($trend->image)}}" alt="thumbnail">
                                            <img class="second-img" src="{{asset($trend->image2?$trend->image2:$trend->image1)}}" alt="thumbnail">
                                        </a>
                                        <!-- product links -->
                                        <a href="#"><span class="hear-icon top-right"><i class="ion-ios-heart"></i></span></a>
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
<div class="common-banner pb-70 bg-white">
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="position-relative zoom-in overflow-hidden">
                    <div class="banner-thumb banner-lagre">
                        <img src="{{asset('frontend/img/banner/banner1.jpg')}}" alt="banner-thumb-naile">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                            <img class="first-img" src="{{asset($trend->image)}}" alt="thumbnail">
                                            <img class="second-img" src="{{asset($trend->image2?$trend->image2:$trend->image1)}}" alt="thumbnail">
                                        </a>
                                        <!-- product links -->
                                        <a href="#"><span class="hear-icon top-right"><i class="ion-ios-heart"></i></span></a>
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
<div class="common-banner pb-70 bg-white">
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="position-relative zoom-in overflow-hidden">
                    <div class="banner-thumb banner-lagre">
                        <img src="{{asset('frontend/img/banner/banner2.jpg')}}" alt="banner-thumb-naile">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- common-banner end -->
<!-- testimonial-section start -->
<section class="testimonial-section pb-70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="testimonial-init dots-style">
                    <div class="slider-item">
                        <div class="testimonial-content text-center">
                            <img class="mb-30 mx-auto" src="{{asset('frontend/img/profile/test1.jpg')}}" alt="user">
                            <div class="star-rating">
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-android-star-half"></span>
                            </div>
                            <span class="ion-quote d-block float-left"></span>
                            <p>Hello !! Thank you for such a beautiful outfit i wore it on Dandia night at my
                                university presently in Russia everyone here praised it so much 🌸</p>
                            <span class="ion-quote float-right"></span>
                            <h4 class="text-uppercase mb-15">Aashna Bindra</h4>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="testimonial-content text-center">
                            <img class="mb-30 mx-auto" src="{{asset('frontend/img/profile/test2.jpg')}}" alt="user">
                            <div class="star-rating">
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-android-star-half"></span>
                            </div>
                            <span class="ion-quote float-left"></span>
                            <p>This outfit was a total winner, and I just loved flaunting it! Thanks a bunch for
                                getting it to me on time. The color is awesome</p>
                            <span class="ion-quote float-right"></span>
                            <h4 class="text-uppercase mb-15">Supriya</h4>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="testimonial-content text-center">
                            <img class="mb-30 mx-auto" src="{{asset('frontend/img/profile/test_3.jpg')}}" alt="user">
                            <div class="star-rating">
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-android-star-half"></span>
                            </div>
                            <span class="ion-quote float-left"></span>
                            <p>Today I got this and it's beautiful. The colour, fabric everything is the same as the
                                image...will definitely shop more</p>
                            <span class="ion-quote float-right"></span>
                            <h4 class="text-uppercase mb-15">Avantika</h4>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="testimonial-content text-center">
                            <img class="mb-30 mx-auto" src="{{asset('frontend/img/profile/test_4.jpg')}}" alt="user">
                            <div class="star-rating">
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-android-star-half"></span>
                            </div>
                            <span class="ion-quote float-left"></span>
                            <p>Hi, I got this dress a few days back and wore it on my Birthday. I absolutely adore
                                it; it has that shine that catches everyone's eyes. I also like the material. Thank
                                you, it suited me perfectly.</p>
                            <span class="ion-quote float-right"></span>
                            <h4 class="text-uppercase mb-15">Chayanika</h4>
                        </div>
                    </div>
                    <!-- slider-item end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonial-section end -->



<!-- blog-section start -->
<section class="blog-section theme1 pb-70">
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
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-blog">
                            <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden" href="blog-grid-left-sidebar.html">
                                <img src="{{asset('frontend/img/blog-post/blog2.jpg')}}" alt="blog-thumb-naile">
                            </a>
                            <div class="blog-post-content">
                                <h3 class="title text-capitalize mb-15"><a href="single-blog.html">UNVEILING YOUR
                                        ULTIMATE SUMMER STYLE: Ekaa'S MUST-HAVE LOOKS FOR WOMEN!</a></h3>
                                <h5 class="sub-title mb-30 text-capitalize">Hey there, fellow fashionistas! As the
                                    sun starts to blaze and the days stretch out into long, lazy afternoons, it's...
                                </h5>
                                <a class="btn read-more text-capitalize" href="single-blog.html">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- slider-item end -->
                    <div class="slider-item">
                        <div class="single-blog">
                            <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden" href="blog-grid-left-sidebar.html">
                                <img src="{{asset('frontend/img/blog-post/blog3.jpg')}}" alt="blog-thumb-naile">
                            </a>
                            <div class="blog-post-content">
                                <h3 class="title text-capitalize mb-15"><a href="single-blog.html">UNVEILING
                                        EMPOWERMENT: Ekaa'S STYLISH ODE TO INTERNATIONAL WOMEN'S DAY!</a></h3>
                                <h5 class="sub-title mb-30 text-capitalize">Hey there, fashionistas and fierce
                                    females! As we gear up to celebrate the essence of womanhood this International
                                </h5>
                                <a class="btn read-more text-capitalize" href="single-blog.html">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog-section end -->
@endsection