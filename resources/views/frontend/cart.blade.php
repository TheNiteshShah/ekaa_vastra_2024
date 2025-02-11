@extends('frontend.base_template')
@section('main')
<style>
    @media(max-width:744px) {
        .red-main_box {
            display: flex;
        }

        .site-nav-container.container.boxx__box {
            /* margin-bottom: 29px; */
            text-align: center;
        }

        .checkout-steps {
            margin: 0 0 0 0% !important;
            width: 63% !important;
            color: #696B79;
            padding: 0;
            display: inline-block;
            line-height: 20px;
            text-align: center;
        }

        th.text-center.imge__box {
            width: 50% !important;
        }
    }

    @media(max-width:483px) {
        td.text-center.redpo {
            width: 18% !important;
        }

        .checkout-steps {
            margin: 0 0 0 0% !important;
            width: 100% !important;
        }

    }

    .btn--md2 {
        padding: 7px 11px !important;
    }

    .filter-check-box_2 {
        background-color: #ff00000a !important;
    }

    ::-webkit-scrollbar-thumb {
        background: #888 !important;
    }

    .table-responsive.wdfqw::-webkit-scrollbar {
        width: 5px;
        height: 8px;
        background-color: #2caf4e;

    }

    .border-class1.active {
        border: 1px solid red;
        text-align: center;
        width: 42px;
        border-radius: 68%;
        padding: 8px 0px;
        margin: 10px;
    }

    .border-class1 {
        border: 1px solid;
        text-align: center;
        width: 42px;
        border-radius: 68%;
        padding: 8px 0px;
        margin: 10px;
    }

    .border-class {
        border: 1px solid;
        text-align: center;
        width: 62px;
        border-radius: 33%;
        padding: 0px 0px;
        margin: 10px;
    }

    .border-class.active {
        border: 1px solid red;
        text-align: center;
        width: 62px;
        border-radius: 33%;
        padding: 0px 0px;
        margin: 10px;

    }



    .whish-title-k {
        text-decoration: line-through;
        color: #94969f;
        padding: 0 8px;
    }

    .whish-title-2 {

        color: #d52700;
        padding: 0 8px;
    }



    #progress-bar {
        display: table;
        width: 100%;
        margin: 0;
        padding: 15px 15px 0;
        table-layout: fixed;
        width: 100%;
        counter-reset: step;
    }

    #progress-bar li {
        list-style-type: none;
        display: table-cell;
        width: 20%;
        float: left;
        font-size: 16px;
        position: relative;
        text-align: center;
    }

    #progress-bar li:before {
        width: 50px;
        height: 50px;
        color: #212121;
        content: counter(step);
        counter-increment: step;
        line-height: 50px;
        font-size: 18px;
        border: 1px solid #efefef;
        display: block;
        text-align: center;
        margin: 0 auto 10px auto;
        border-radius: 50%;
        background-color: #fff;
    }

    #progress-bar li:after {
        width: 100%;
        height: 10px;
        content: "";
        position: absolute;
        background-color: #fff;
        top: 25px;
        left: -50%;
        z-index: -1;
    }

    #progress-bar li:first-child:after {
        content: none;
    }

    #progress-bar li.step-done {
        color: #f00;
    }

    #progress-bar li.step-done:before {
        border-color: #f00;
        background-color: #f00;
        color: #fff;
        content: "\f00c";
        font-family: "FontAwesome";
    }

    #progress-bar li.step-done+li:after {
        background-color: #f00;
    }

    #progress-bar li.step-active {
        color: #f00;
    }

    #progress-bar li.step-active:before {
        border-color: #f00;
        color: #f00;
        font-weight: 700;
    }




    .view_checkout_image {
        width: 90%;
    }

    .w-100__1 {
        width: 100%;
        padding: 7px;
        border: 1px solid gainsboro;
    }

    .conat {
        position: absolute;
        right: 3%;
        top: 18px;
        padding: 4px 10px;
    }

    .color-text p {
        color: red;
        margin-top: 7px;
    }

    .blog-ctry-menu li a {
        position: relative;
        font-weight: 400;
        color: #252525;
        display: block;
        text-transform: capitalize;
        line-height: 35px;
        font-size: 16px;
    }

    .blog-ctry-menu_1 {
        background-color: #f7f8fb00;
        padding: 15px 10px;
        border: 1px solid #e7e7e7;
        border-radius: 7px;
    }

    .filter-check-box_1 {
        display: flex;
        border-bottom: 1px solid #e7e7e7;
        justify-content: space-between;
        padding: 10px 0px;
    }

    .filter-check-box_3 {
        display: flex;

        justify-content: space-between;
        padding: 3px 0px;
    }

    .theme-btn--dark1:hover {
        color: #ffffff !important;
        background: #09080A;
    }

    .btn:first-child:active {
        background: #09080A;
    }
    btn-check:checked+.btn,
    .btn.active,
    .btn.show,
    .btn:first-child:active,
    :not(.btn-check)+.btn:active {
        color: var(--bs-btn-active-color);
        background-color: #09080A;
    }


    @media (max-width:445px) {
        .fix {
            position: sticky;
            bottom: 0px;
            display: flex !important;
            background: white;
            padding: 10px 0px;
            justify-content: center !important;
        }
    }



    .checkout-steps {
        width: 100%;
        color: #696B79;
        padding: 0;
        display: inline-block;
        line-height: 20px;
        text-align: center;
    }

    .checkout-steps .step {
        display: inline-block;
        letter-spacing: 3px;
    }

    .checkout-steps .active {
        color: #262626;
        border-bottom: 2px solid #262626;
    }

    .checkout-steps .divider {
        display: inline-block;
        border-top: 1px dashed #696B79;
        height: 4px;
        width: 10%;
    }

   
</style>
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="main_box_1">
                <div class="header">
                    <div class="site-nav-container container boxx__box">
                        <ol class="checkout-steps">
                            <li class="step step1 active">BAG</li>
                            <li class="divider"></li>
                            <!-- <li class="step step2">ADDRESS</li>
                            <li class="divider"></li> -->
                            <li class="step step3">Checkout</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<section class="whish-list-section theme1 pb-70">
    <div class="container grid-wraper">
        @if(!empty($cartItems) && $cartItems!='[]')
        <div class="row">
            <div class="col-lg-6 mb-30">
                <div class="table-responsive wdfqw" style="height: 265px;">
                    <table class="table mb-0">
                        <tbody>
                            @php
                            $cart_mrp = 0;
                            $cart_total = 0;
                            @endphp
                            @foreach($cartItems as $cart)
                            @if(!auth()->check())
                            @php
                            $type = App\Models\TypeModal::find($cart['type_id']);
                            $cart_mrp += $type->product->mrp*$cart['quantity'];
                            $cart_total += ($type->product->selling_price*$cart['quantity']);
                            @endphp
                            <tr class="red-main_box">
                                <th class="text-center imge__box" scope="row" style="width: 23%;">
                                    <a href="{{route('product',$type->product->slug)}}" class="image"><img src="{{asset($type->product->image)}}" alt="Cart product Image"></a>
                                </th>
                                <td class="text-start" style="width: 60%;">
                                    <div>
                                        <p class="whish-title" style="padding: 0 8px;"> <b>{{$type->product->name}}</b></p>
                                        <!-- <p style="font-size: 13px;">Women Nude-Coloured Solid Pumps</p> -->
                                        @php
                                        $percentageSaved = $type->product->mrp > 0 ? (($type->product->mrp - $type->product->selling_price) / $type->product->mrp) * 100 : 0;
                                        @endphp
                                        @if($percentageSaved > 0)
                                        <p class="whish-title-2">Save {{ number_format($percentageSaved, 2) }}%</p>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="whish-title-k">₹{{$type->product->mrp}}</span>
                                        <span class="whish-title"> ₹{{$type->product->selling_price}}</span>
                                    </div>
                                    <div class="mt-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn theme-btn--dark1 btn--md btn--md2" data-bs-toggle="modal" data-bs-target="#sizeModal" data-product-id="{{ $type->product->id }}" data-type-id="{{ $type->id }}" data-qty="{{ $cart['quantity'] }}">
                                            Size: <span>{{$type->size->name}}</span>
                                        </button>
                                        <button type="button" class="btn theme-btn--dark1 btn--md btn--md2" data-bs-toggle="modal" data-bs-target="#quantityModal" data-product-id="{{ $type->product->id }}" data-type-id="{{ $type->id }}" data-qty="{{ $cart['quantity'] }}">
                                            Qty: <span>{{$cart['quantity']}}</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-center redpo" style="vertical-align: top;">
                                    <span class="whish-list-price">
                                        <form action="{{ route('removeFromCart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="type_id" value="{{$type->id}}">
                                            <button type="submit" style="font-size: 35px;">×</button>
                                        </form>
                                    </span>
                                </td>
                            </tr>
                            @else
                            @php
                            $cart_mrp += $cart->product->mrp*$cart->quantity;
                            $cart_total += ($cart->product->selling_price*$cart->quantity);
                            @endphp
                            <tr class="red-main_box">
                                <th class="text-center imge__box" scope="row" style="width: 23%;">
                                    <a href="{{route('product',$cart->product->slug)}}" class="image"><img src="{{asset($cart->product->image)}}" class="view_checkout_image mt-0" alt="img"></a>
                                </th>
                                <td class="text-start" style="width: 60%;">
                                    <div>
                                        <span class="whish-title" style="padding: 0 8px;"> <b>{{$cart->product->name}}</b></span>
                                        <!-- <p style="font-size: 13px;">Women Nude-Coloured Solid Pumps</p> -->
                                        @php
                                        $percentageSaved = $cart->product->mrp > 0 ? (($cart->product->mrp - $cart->product->selling_price) / $cart->product->mrp) * 100 : 0;
                                        @endphp
                                        @if($percentageSaved > 0)
                                        <p class="whish-title-2">Save {{ number_format($percentageSaved, 2) }}%</p>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="whish-title-k"> ₹{{$cart->product->mrp}}</span>
                                        <span class="whish-title"> ₹{{$cart->product->selling_price}}</span>

                                    </div>
                                    <div class="mt-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn theme-btn--dark1 btn--md btn--md2" data-bs-toggle="modal" data-bs-target="#sizeModal" data-product-id="{{ $cart->product->id }}" data-type-id="{{ $cart->type->id }}" data-qty="{{ $cart->quantity}}">
                                            Size: <span>{{$cart->type->size->name}}</span>
                                        </button>
                                        <button type="button" class="btn theme-btn--dark1 btn--md btn--md2" data-bs-toggle="modal" data-bs-target="#quantityModal" data-product-id="{{ $cart->product->id }}" data-type-id="{{ $cart->type->id }}" data-qty="{{ $cart->quantity}}">
                                            Qty: <span>{{$cart->quantity}}</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-center redpo" style="vertical-align: top;">
                                    <form action="{{ route('removeFromCart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="type_id" value="{{$cart->type->id}}">
                                        <button type="submit" style="font-size: 35px;">×</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 mb-30">
                <ul id="offcanvas-menu2" class="blog-ctry-menu blog-ctry-menu_1">
                    <div class="mt-2 blog-ctry-menu_1">
                        <div class="check-box-inner p-0">
                            <h4 class="sub-title">Price Details</h4>
                            <div class="filter-check-box_3">
                                <p>Total MRP</p>
                                <p>₹{{$cart_mrp}}</p>
                            </div>
                            <div class="filter-check-box_3">
                                <p>Discount on MRP</p>
                                <p>₹{{$cart_mrp-$cart_total}}</p>
                            </div>
                            <!-- <div class="filter-check-box_3">
                                <p>Coupon Discount</p>
                                <p style="color: #d52700;">Apply Coupon</p>
                            </div> -->

                            <hr>
                            <div class="filter-check-box_3">
                                <p>Total</p>
                                <p>₹{{$cart_total}}</p>
                            </div>

                        </div>

                    </div>

                    <div class="d-flex justify-content-end mt-3 fix">
                        @if(auth()->check())
                        <a href="{{route('checkout')}}"><button class="btn theme-btn--dark1 btn--xl">Checkout</button></a>
                        @else
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#login"><button class="btn theme-btn--dark1 btn--xl">Checkout</button></a>
                        @endif

                    </div>
                </ul>
            </div>
        </div>
        @else
        <div class="text-center col-md-4 col-8 mx-auto">
            <img src="{{asset('frontend/img/empty_bag.jpg')}}" alt="Empty-Bag" class="img-fluid" style="width:50%">
        </div>
        <h6 class="text-center mt-2">Your bag is empty!</h6>
        @endif
    </div>
</section>
<!-- product tab end -->
<div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quantityModalLabel">Select Quantity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <nav class="shop-grid-nav mt-20">
                        <ul class="product-tag d-flex flex-wrap" id="QtyList">
                        </ul>
                    </nav>
                    <hr>
                    <div style="text-align: center;">
                        <button class="btn theme-btn--dark1 btn--md" onclick="event.preventDefault(); document.getElementById('update-product').submit();">Done </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sizeModalLabel">Select Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <nav class="shop-grid-nav mt-20">
                    <ul class="product-tag d-flex flex-wrap" id="sizeList">
                    </ul>
                </nav>
                <hr>
                <div style="text-align: center;">
                    <button onclick="event.preventDefault(); document.getElementById('update-product').submit();" class="btn theme-btn--dark1 btn--md">Done </button>
                </div>
            </div>
        </div>

    </div>
</div>
<form method="post" id="update-product" action="{{ route('updateCart')}}">
    @csrf
    <input type="hidden" name="activeTypeId" id="activeTypeId" value="">
    <input type="hidden" name="CartTypeId" id="CartTypeId" value="">
    <input type="hidden" name="activeQty" id="activeQty" value="">
</form>
<script>
    function updateTypeId(element, typeId) {
        // Update the hidden input value
        document.getElementById('activeTypeId').value = typeId;
        document.getElementById('activeTypeId').value = typeId;
        // Remove the "active" class from all <a> elements
        var links = document.querySelectorAll('#sizeList li a');
        links.forEach(function(link) {
            link.classList.remove('active');
        });
        // Add the "active" class to the clicked <a> element
        element.classList.add('active');
    }

    function updateQty(element, qty) {
        // Update the hidden input value
        document.getElementById('activeQty').value = qty;
        // Remove the "active" class from all <a> elements
        var links = document.querySelectorAll('#QtyList li a');
        links.forEach(function(link) {
            link.classList.remove('active');
        });
        // Add the "active" class to the clicked <a> element
        element.classList.add('active');
    }
</script>
@endsection