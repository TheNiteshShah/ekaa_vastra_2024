@extends('frontend.base_template')
@section('main')

<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center ">
                    <!-- <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li> -->
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->

<section class="product-single theme1 mb-3 p-3">
    <div class="container grid-wraper text-center">
        <img src="{{ asset('frontend/img/check.png') }}" alt="Order Success" style="width:6%" class="img-fluid mb-3">
        <h4>Order Success!</h4>
        <p class="mt-3">Your order has been placed successfully.</p>
        <p class="mt-1">Order ID: #{{ $order_id }}</p>
        <a class="mt-2" href="{{ route('/') }}" class="btn theme-btn--dark1 btn--md">Return to Home</a><br>
        <a class="mt-2" href="{{ route('my-account') }}" class="btn theme-btn--dark1 btn--md">My Orders</a>
    </div>
</section>
@endsection