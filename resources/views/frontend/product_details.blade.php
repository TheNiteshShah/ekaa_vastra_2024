@extends('frontend.base_template')
@section('title', $title)
@section('main')
<style>
    .slick-dotted {
        bottom: -15px !important;
    }
</style>
<!-- offcanvas-size chart Start -->
<div id="offcanvas-size-chart" class="offcanvas offcanvas-cart theme1">
    <div class="inner">
        <div class="head d-flex justify-content-between">
            <span class="title">Size Chart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="content_setting">
            <div class="info_setting">
                <div class="mb-30 border-bottom pb-30 border-bottom">
                    <h3 class="title_setting">Garment sizes, measured in INCHES.</h3>
                    <img src="{{asset($productData->size_chart)}}" loading="lazy" alt="Size Chart" class="img-fluid d-block mx-auto">
                    <p class="mt-2"><b>Note -</b> These are Garment sizes, take your body measurements and match the garment accordingly.</p>
                </div>
                <div>
                    <h2 class="title_setting ">Garment Measuring Guide</h2>
                    <img src="{{ asset('frontend/img/garment-guide.jpg') }}" loading="lazy" alt="Garment-Guide" class="img-fluid d-block mx-auto">
                </div>


            </div>
        </div>
    </div>
</div>
<!--offcanvas-size chart End -->
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center ">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{route('collection',strtolower(str_replace('+', '-', urlencode($productData->subcategory?$productData->subcategory->name:$productData->category->name))))}}">{{$productData->subcategory?$productData->subcategory->name:$productData->category->name}}</a>
                    </li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">
                        Product Details
                    </li> -->
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->

<!-- product-single start -->
<section class="product-single theme1 mb-3">
    <div class="container grid-wraper">
        <div class="row">
            <div class="col-md-9 mx-auto col-lg-6 mb-5 mb-lg-0">
                <div class="position-relative">
                    @if($productData->label)
                    <span class="badge badge-danger top-left">{{$productData->label}}</span>
                    @endif
                </div>

                <div class="product-sync-init mb-30">
                    @if($productData->image)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a data-fancybox="gallery" data-src="{{asset($productData->image)}}">
                                <img src="{{asset($productData->image)}}" alt="product-thumb">
                            </a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif
                    @if($productData->image2)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a data-fancybox="gallery" data-src="{{asset($productData->image2)}}">
                                <img src="{{asset($productData->image2)}}" alt="product-thumb">
                            </a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif
                    @if($productData->image3)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a data-fancybox="gallery" data-src="{{asset($productData->image3)}}">
                                <img src="{{asset($productData->image3)}}" alt="product-thumb">
                            </a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif
                    @if($productData->image4)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a data-fancybox="gallery" data-src="{{asset($productData->image4)}}">
                                <img src="{{asset($productData->image4)}}" alt="product-thumb">
                            </a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif
                </div>
                <div class="product-sync-nav slick-nav-sync">
                    @if($productData->image)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a href="javascript:void(0)"> <img src="{{asset($productData->image)}}" alt="product-thumb"></a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif
                    @if($productData->image2)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a href="javascript:void(0)"> <img src="{{asset($productData->image2)}}" alt="product-thumb"></a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif
                    @if($productData->image3)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a href="javascript:void(0)"> <img src="{{asset($productData->image3)}}" alt="product-thumb"></a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif
                    @if($productData->image4)
                    <div class="single-product">
                        <div class="product-thumb">
                            <a href="javascript:void(0)"> <img src="{{asset($productData->image4)}}" alt="product-thumb"></a>
                        </div>
                    </div>
                    <!-- single-product end -->
                    @endif

                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-md-0">
                <div class="single-product-info">
                    <div class="single-product-head">
                        <div class="row justify-content-between align-items-center">
                            <h2 class="title mb-20">{{$productData->name}}</h2>
                            <!-- @if(auth()->check())
                            <a href="#"><span class="hear-icon2 top-right"><i class="ion-ios-heart-outline " style="font-weight: bold;"></i></span></a>
                            @endif -->
                            @if(auth()->check())
                            @php
                            $isInWishlist = in_array($productData->id, $wishlistProductIds);
                            @endphp
                            <a href="javascript:void(0)" onclick="toggleWishlist({{ $productData->id }}, this)"><span class="hear-icon2 top-right product{{ $productData->id }}"> <i class="{{ $isInWishlist ? 'ion-ios-heart' : 'ion-ios-heart-outline' }}"></i></span></a>
                            @endif
                        </div>
                        <div class="star-content mb-20">
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <span class="star-on"><i class="ion-ios-star"></i> </span>
                            <a href="#" id="write-comment"><span class="ms-2"><i class="far fa-comment-dots"></i></span>
                                Read reviews <span>(0)</span></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><span class="edite"><i class="far fa-edit"></i></span> Write a
                                review</a>
                        </div>
                    </div>
                    <div class="product-body mb-40">
                        <div class="d-flex align-items-center mb-30 border-bottom pb-30">
                            <h6 class="product-price me-2">
                                <del class="del">₹{{$productData->mrp}}</del> <span class="onsale">₹{{$productData->selling_price}}</span>
                            </h6>
                            @php
                            $percentageSaved = $productData->mrp > 0 ? (($productData->mrp - $productData->selling_price) / $productData->mrp) * 100 : 0;
                            @endphp
                            @if($percentageSaved > 0)
                            <span class="badge my-badge position-static bg-dark">Save {{ number_format($percentageSaved, 2) }}%</span>
                            @endif
                        </div>
                        <p class="font-size">
                            {!!$productData->short_description!!}
                        </p>
                    </div>
                    <div class="product-footer">
                        <div class="row align-items-center mb-10">
                            <img src="{{ asset('frontend/img/tape.png') }}" style="width:50px" class="img-fluid" alt="measuring-tape">
                            <a class="offcanvas-toggle pl-3 ml-1" style="font-weight: 400;color:black;display: contents;font-size:14px" href="#offcanvas-size-chart"><span>Size chart</span></a>
                        </div>
                        <h6>Select Size </h6>
                        <nav class="shop-grid-nav mt-10">
                            <ul class="product-tag d-flex flex-wrap">
                                @foreach($productData->types as $index=>$type)
                                <li><a href="javascript:void(0)" value="{{$type->id}}" class="{{$type->inventory==0?'out':''}}" onclick="updateTypeId(this, {{$type->id}})">{{$type->size->name}}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" id="product_id" name="product_id" value="{{$productData->id}}">
                            <input type="hidden" id="type_id" name="type_id" value="">
                        </nav>
                        <span style="font-size:11px">Note: Only one size selection is permitted for each product.</span>
                        <div class="product-count style d-flex flex-column flex-sm-row mt-30 mb-30">
                            <div class="count d-flex">
                                <input type="number" min="1" max="10" step="1" value="1" name="quantity" id="quantity" />
                                <div class="button-group">
                                    <button class="count-btn increment">
                                        <i class="fas fa-chevron-up"></i>
                                    </button>
                                    <button class="count-btn decrement">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                @if($cartInfo)
                                <a href="{{route('cart')}}"><button id="go-to-cart-btn" class="btn theme-btn--dark1 btn--xl mt-30 mt-sm-0">
                                        <span class="me-2"><i class="ion-bag"></i></span>
                                        Go to bag
                                    </button></a>
                                @else
                                <button id="add-to-cart-btn" class="btn theme-btn--dark3 btn--xl mt-30 mt-sm-0">
                                    <span class="me-2"><i class="ion-bag"></i></span>
                                    Add to Bag
                                </button>
                                <button class="btn theme-btn--dark3 btn--xl mt-30 mt-sm-0" id="add-cart-loader" style="border-color:#09080A;padding: 17px 40px;display:none;" type="button" disabled>
                                    <span style="color:#09080A;">Adding...</span>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="color:#09080A;"></span>
                                </button>
                                @endif
                            </div>
                        </div>
                        <!-- 
                        <div class="Offers">
                            <div class="slider-item slider-item__1">
                                <div class="testimonial-content " style="border: 1px solid gainsboro;padding: 10px 0px;">
                                    <div style="display: flex;align-items: center;">
                                        <div style="width: 10%;">
                                            <img src="{{asset('frontend/img/icon/offerpic.png')}}" alt="">
                                        </div>
                                        <div>
                                            <p><b> Offers for you </b></p>
                                        </div>
                                    </div>
                                    <div style="margin-left:  40px;">
                                        <div>
                                            <p>COUPON: <b>EKAA200</b> </p>
                                        </div>
                                        <div>
                                            <p><b>Congratulation! You are eligible for ₹250 extra discount</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="pro-social-links mt-30">
                        <ul class="d-flex align-items-center">
                            <li class="share">Share</li>
                            <li>
                                <a href="#"><i class="ion-social-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="ion-social-instagram-outline"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="block-reassurance">
                    <ul>
                        <li>
                            <img src="{{asset('frontend/img/icon/10.png')}}" alt="img" />
                            Cash on delivery available
                        </li>
                        <li>
                            <img src="{{asset('frontend/img/icon/11.png')}}" alt="img" />
                            Usually ships in 5-6 days
                        </li>
                        <!-- <li>
                            <img src="{{asset('frontend/img/icon/12.png')}}" alt="img" />
                            Easy Return & Exchange Know More
                        </li> -->
                    </ul>
                </div>
                <div class="block-reassurance">
                    <ul id="offcanvas-menu2" class="blog-ctry-menu">
                        <li class="active"><a href="javascript:void(0)">Description</a>
                            <ul class="category-sub-menu" style="display:block">
                                {!!$productData->description!!}
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Shipping Information </a>
                            <ul class="category-sub-menu">
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Return & Exchange </a>
                            <ul class="category-sub-menu">
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- product-single end -->
@if(!$relatedData->isEmpty())
<!-- new arrival section start -->
<section class="theme1 bg-white pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize mb-20">You might also like</h2>
                    <p class="text">Browse the collection of our products. </p>
                </div>
            </div>
            <div class="col-12">
                <div class="product-slider-init slick-nav">
                    @foreach($relatedData as $trend)
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
                                        @if(auth()->check())
                                        @php
                                        $isInWishlist = in_array($trend->id, $wishlistProductIds);
                                        @endphp
                                        <a href="javascript:void(0)" onclick="toggleWishlist({{ $trend->id }}, this)"><span class="hear-icon2 top-right product{{ $trend->id }}"> <i class="{{ $isInWishlist ? 'ion-ios-heart' : 'ion-ios-heart-outline' }}"></i></span></a>
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
@endif
<script>
    function updateTypeId(element, typeId) {
        // Update the hidden input value
        document.getElementById('type_id').value = typeId;

        // Remove the "active" class from all <a> elements
        var links = document.querySelectorAll('.product-tag li a');
        links.forEach(function(link) {
            link.classList.remove('active');
        });

        // Add the "active" class to the clicked <a> element
        element.classList.add('active');
    }
</script>

@endsection