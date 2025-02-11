@extends('frontend.base_template')
@section('title', $title)
@section('main')
<style>
    @media (min-width:991px) {
        .mobilefilter {
            display: none;
        }
    }

    img {
        border-style: none;
    }

    img {
        vertical-align: middle;
    }

    @media(max-width:977px) {
        .filter---box {
            display: none;
        }
    }
</style>
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-title text-center my-20">
                    <h2 class="title text-dark text-capitalize">{{$title}}</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<div class="product-tab pb-40">
    <div class="container grid-wraper">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="grid-nav-wraper mb-30">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <nav class="shop-grid-nav">
                                <ul class="nav nav-pills align-items-center">
                                    <li> <span class="total-products text-capitalize">There are {{count($productData)}} products.</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row grid-view theme1">
                    @foreach($productData as $product)
                    <div class="col-sm-6 col-md-3 col-6 mb-30">
                        <div class="card product-card">
                            <div class="card-body p-0">
                                <div class="media flex-column">
                                    <div class="product-thumbnail w-100 position-relative">
                                        @if($product->label)
                                        <span class="badge badge-danger top-left">{{$product->label}}</span>
                                        @endif
                                        <a class="d-block" href="{{route('product',$product->slug)}}">
                                            <img class="first-img" src="{{asset($product->image)}}" alt="thumbnail">
                                            <img class="second-img" src="{{asset($product->image2?$product->image2:$product->image1)}}" alt="thumbnail">
                                        </a>
                                        @if(auth()->check())
                                        @php
                                        $isInWishlist = in_array($product->id, $wishlistProductIds);
                                        @endphp
                                        <a href="javascript:void(0)" onclick="toggleWishlist({{ $product->id }}, this)"><span class="hear-icon top-right product{{ $product->id }}"> <i class="{{ $isInWishlist ? 'ion-ios-heart' : 'ion-ios-heart-outline' }}"></i></span></a>
                                        @endif

                                    </div>
                                    <div class="media-body">
                                        <div class="product-desc">
                                            <span class="logo-text">Ekaa Vastra</span>
                                            <h3 class="title mb-10"><a href="{{route('product',$product->slug)}}" class="truncate-text">{{$product->name}}</a></h3>
                                            <p class="product-price">
                                                <span class="onsale">₹{{ number_format($product->selling_price) }}</span>
                                                <del class="del">₹{{ number_format($product->mrp) }}</del>
                                                @php
                                                $percentageSaved = $product->mrp > 0 ? (($product->mrp - $product->selling_price) / $product->mrp) * 100 : 0;
                                                @endphp
                                                @if($percentageSaved > 0)
                                                <span class="product-discountPercentage">({{number_format($percentageSaved)}}% Off)</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product-list End -->
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $productData->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- product tab end -->
<!--  new model-->


<div class="container-fluid mobilefilter" style="position: sticky; bottom: 0; background: #fff;z-index:9999;">
    <div class="row text-center">
        <div class="col-6 p-2">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="{{asset('frontend/img/icon/filter.png')}}"> FILTER</a>
        </div>
        <div class="col-6 p-2" style="border-right: 2px solid #dee2e6 ;">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"> <img src="{{asset('frontend/img/icon/sort.png')}}"> SORT BY </a>
        </div>



    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="d-flex justify-content-center">
        <div class="modal-dialog" style="width: 100% !important;
    position: absolute;
    bottom: 27px;
    margin:  0px;">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="popup_content">
                        <div class="popup-text">
                            <div class="heading_s1 text-center">
                                <h6>SORT BY</h6>
                            </div>
                        </div>
                        <ul style="list-style-type: none; text-align: center;">
                            <li style="padding:15px 0px; border-bottom: 2px solid rgb(235, 232, 232);"> <a href="javascript:;" onclick="soryBy('ASC')">Sort by price: Low to High</a></li>
                            <li style="padding:15px 0px; border-bottom: 2px solid rgb(235, 232, 232);"> <a href="javascript:;" onclick="soryBy('DESC')">Sort by price: High to Low</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 100vh;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> FILTER</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row" style="height: 100vh;">


                <div class="modal-body col-3" style="padding-right:  0px;">
                    <div class="myaccount-tab-menu nav" role="tablist" style="display: grid;">
                        <!-- <a href="#dashboad" data-bs-toggle="tab" class="active"><i class="fas fa-tachometer-alt"></i>
                    Categories</a> -->
                        <a href="#account-info" data-bs-toggle="tab" class="active">
                            Price</a>

                        <a href="#orders" data-bs-toggle="tab">
                            Size</a>

                        <!-- <a href="#download" data-bs-toggle="tab">
                    Color</a> -->

                    </div>
                </div>
                <div class="col-9" style="padding-left:  0px; border-left: 1px solid;">
                    <div class="tab-content" id="myaccountContent">
                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade active show" id="account-info" role="tabpanel">
                            <div class="myaccount-content" style="border-bottom:  0px ;">
                                <div class="check-box-inner mt-10">
                                    <h4 class="sub-title">Price</h4>
                                    <div class="price-filter mt-10">
                                        <div class="price-slider-amount">
                                            <input type="text" id="amount" name="price" readonly placeholder="Add Your Price" />
                                        </div>
                                        <div id="slider-range2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="orders" role="tabpanel">
                            <div class="myaccount-content" style="border-bottom: 0px;">
                                <div class="check-box-inner mt-10">
                                    <h4 class="sub-title">Size</h4>
                                    <div class="filter-check-box">
                                        <input type="checkbox" id="test9">
                                        <label for="test9">s <span>(2)</span></label>
                                    </div>
                                    <div class="filter-check-box">
                                        <input type="checkbox" id="test10">
                                        <label for="test10">m <span>(2)</span></label>
                                    </div>
                                    <div class="filter-check-box">
                                        <input type="checkbox" id="test11">
                                        <label for="test11">l <span>(2)</span></label>
                                    </div>
                                    <div class="filter-check-box">
                                        <input type="checkbox" id="test12">
                                        <label for="test12">xl <span>(2)</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="download" role="tabpanel">
                    <div class="myaccount-content" style="border-bottom: 0px;">
                        <div class="check-box-inner mt-10">
                            <h4 class="sub-title">Color</h4>
                            <div class="filter-check-box color-grey">
                                <input type="checkbox" id="20826">
                                <label for="20826">grey <span>(4)</span></label>
                            </div>
                            <div class="filter-check-box color-white">
                                <input type="checkbox" id="20827">
                                <label for="20827">white <span>(3)</span></label>
                            </div>
                            <div class="filter-check-box color-black">
                                <input type="checkbox" id="20828">
                                <label for="20828">black <span>(6)</span></label>
                            </div>
                            <div class="filter-check-box color-camel">
                                <input type="checkbox" id="20829">
                                <label for="20829">camel <span>(2)</span></label>
                            </div>
                        </div>
                    </div>
                </div> -->

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- modals end -->
@endsection