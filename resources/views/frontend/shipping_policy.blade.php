@extends('frontend.base_template')
@section('title', 'Shipping Policy - Ekaa Vastra')
@section('main')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-title text-center my-20">
                    <h2 class="title text-dark text-capitalize">Shipping Policy</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Policy</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<section class="whish-list-section theme1 pb-70">
    <div class="container grid-wraper">
        <p class="mb-20 text-justify">We strive to get your orders to you as quickly and efficiently as possible. Here's what you need to know:</p>
        <p class="mb-20 text-justify"><b>Shipping Rates:</b> Our shipping rates are calculated based on the weight and distance of the package.</p>
        <p class="mb-20 text-justify"><b>Shipping Carriers:</b> We use  Delivery to ship our packages.</p>
        <p class="mb-20 text-justify"><b>Shipping Times:</b> Most orders ship within 5-7 of being placed. Delivery times vary depending on your location, but most packages arrive within 7-9 days.</p>
        <p class="mb-20 text-justify"><b>Tracking:</b> You will receive tracking information via email once your order has shipped.</p>
        <p class="mb-20 text-justify"><b>Delivery:</b> We deliver to all states and territories in India.</p>
        
    </div>

</section>
<!-- product tab end -->
@endsection