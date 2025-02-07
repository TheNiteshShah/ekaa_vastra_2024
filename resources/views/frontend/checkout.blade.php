@extends('frontend.base_template')
@section('title', 'checkout - Ekaa Vastra')
@section('main')
<style>
    .filter-check-box_3 {
        display: flex;

        justify-content: space-between;
        padding: 3px 0px;
    }

    .table-responsive.wdfqw::-webkit-scrollbar {
        width: 5px;
        height: 8px;
        background-color: #2caf4e;

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

    .theme-btn--dark1:hover {
        color: #ffffff !important;
        background: #2caf4e;
    }

    .theme-btn--dark1 a:hover {
        color: #ffffff !important;
        /* background: #2caf4e; */
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
        background: #2caf4e;
    }

    .theme-btn--dark1 a:hover {
        color: #ffffff !important;
        /* background: #2caf4e; */
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
</style>
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="main_box_1">
                <div class="header">
                    <div class="site-nav-container container boxx__box">
                        <ol class="checkout-steps">
                            <a href="{{route('cart')}}">
                                <li class="step step1 ">BAG</li>
                            </a>
                            <li class="divider"></li>
                            <!-- <li class="step step2">ADDRESS</li>
                            <li class="divider"></li> -->
                            <li class="step step3 active">Checkout</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<style>
    .clear-icon {
        position: absolute;
        right: 21%;
        /* Adjust according to button width */
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        cursor: pointer;
        color: #333;
        user-select: none;
        font-size: 25px !important;
    }
</style>
<!-- product tab start -->
<section class="check-out-section pb-40">
    <div class="container grid-wraper">
        <div class="row">


            <div class="col-lg-6 mb-30">
                <div class="mt-2 blog-ctry-menu_1">
                    <div class="check-box-inner p-0">

                        <div class="filter-check-box_1">
                            <h4 class="sub-title"> <b>Shipping Address </b></h4>
                            @if($user->default_address_id)
                            <button data-bs-toggle="modal" data-bs-target="#addressListModal" class="btn theme-btn--dark1 btn--md"><a href="#">
                                    Change Address
                                </a></button>
                            @else
                            <button data-bs-toggle="modal" data-bs-target="#addAddressModal" class="btn theme-btn--dark1 btn--md"><a href="#">
                                    Add Address
                                </a></button>
                            @endif
                        </div>
                        <div class="filter-check-box_1 border-bottom-0" style="display:block;">
                            @if($user->default_address_id)
                            <p>Deliver to: <b>{{$defaultAddress->first_name.' '.$defaultAddress->last_name}}, {{$defaultAddress->pincode}}</b></p>
                            <p>{{$defaultAddress->address}}, {{$defaultAddress->city}}</p>
                            @else
                            <p>Please add address for order placing</p>
                            @endif
                        </div>
                    </div>
                </div>
                <h5 class="title pb-10 mt-3 text-center text-md-start text-capitalize">Order Items ({{count($cartItems)}})</h5>
                <hr>
                <div class="table-responsive wdfqw" style="height: 265px;">
                    <table class="table mb-0">
                        <tbody>
                            @php
                            $cart_mrp = 0;
                            $cart_total = 0;
                            @endphp
                            @foreach($cartItems as $cart)
                            @php
                            $cart_mrp += $cart->product->mrp*$cart->quantity;
                            $cart_total += ($cart->product->selling_price*$cart->quantity);
                            @endphp
                            <tr>
                                <th class="text-center" scope="row" style="width: 23%;">
                                    <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($cart->product->name))))}}" class="image"><img src="{{asset($cart->product->image)}}" class="view_checkout_image mt-0" alt="img"></a>
                                </th>
                                <td class="text-start" style="width: 60%;">
                                    <div>
                                        <span class="whish-title"> <b>{{$cart->product->name}} </b></span>
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
                                    <div class="">
                                        <!-- Button trigger modal -->
                                        <span style="padding: 0 8px;">Size: {{$cart->type->size->name}}</span>
                                        <span style="padding: 0 8px;">Qty: {{$cart->quantity}}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-lg-6 mb-30">
                <ul id="offcanvas-menu3" class="blog-ctry-menu blog-ctry-menu_1">
                    <l class=" active"><a href="javascript:void(0)">Have Any Promo Code ?</a>
                        <ul class="category-sub-menu">
                            <form id="promo_code_submit" class="position-relative">
                                <div class="form-group d-flex">
                                    <input type="text" placeholder="Apply Coupon" class="p-2 w-100" id="promoCodeInput" required="">

                                    <button type="submit" value="submit" id="submit" class="btn theme-btn--dark1 btn--xl" name="submit">Apply</button>

                                    <!-- "X" icon for clearing promo code -->
                                    <span id="clearPromoCode" class="clear-icon d-none" onclick="removePromoCode()">&times;</span>
                                </div>
                            </form>

                        </ul>

                        </li>
                </ul>


                <div class="mt-2 blog-ctry-menu_1">
                    <div class="check-box-inner p-0">
                        <h4 class="sub-title">Apply Wallet</h4>
                        <div class="filter-check-box">
                            <input type="checkbox" id="wallet" name="wallet">
                            <label for="wallet">Wallet (₹<span id="in_wallet">{{$cart->user->wallet}}</span>)</label>
                        </div>
                    </div>
                </div>

                <div class="mt-2 blog-ctry-menu_1">
                    <div class="check-box-inner p-0">
                        <h4 class="sub-title">Price Details</h4>
                        <div class="filter-check-box_1">
                            <p>Total MRP</p>
                            <p>₹{{$cart_mrp}}</p>
                        </div>
                        <div class="filter-check-box_1">
                            <p>Discount on MRP</p>
                            <p>₹{{$cart_mrp-$cart_total}}</p>
                        </div>
                        <div class="filter-check-box_1">
                            <p>Subtotal</p>
                            <p>₹<span id="cart_total">{{$cart_total}}</span></p>
                        </div>
                        <div class="filter-check-box_1">
                            <p>Shipping</p>
                            <p>₹<span id="shipping">0</span></p>
                        </div>
                        <div class="filter-check-box_1 d-none" id="promoDive">
                            <p>Promo Code Discount</p>
                            <p>₹<span id="promo_code_discount">0</span></p>
                        </div>
                        <div class="filter-check-box_1 d-none" id="walletDiv">
                            <p>Wallet Discount</p>
                            <p>₹<span id="wallet_discount">0</span></p>
                        </div>
                        <div class="filter-check-box_1" id="CodDiv">
                            <p>COD Charges</p>
                            <p>₹<span id="cod_charge">0</span></p>
                        </div>
                        <div class="filter-check-box_1 d-none" id="prePaidDiv">
                            <p>Prepaid Discount</p>
                            <p>₹<span id="prepaid_discount">0</span></p>
                        </div>
                        <!-- <div class="filter-check-box_1">
                            <p>Prepaid Discount</p>
                            <p>- ₹100</p>
                        </div>
                        <div class="filter-check-box_3 filter-check-box_1">
                            <p>Shipping Fee <span style="color: #d52700;"> Know More</span></p>
                            <p style="    color: #03a685;">FREE</p>
                        </div> -->
                        <div class="filter-check-box_1">
                            <p>Total</p>
                            <p>₹ <span id="subTotal" data-original-total="{{$cart_total}}">{{$cart_total}}</span></p>
                        </div>

                        <!-- <div class="filter-check-box_3 filter-check-box_1">
                            <p>Platform Fee <span style="color: #d52700;"> Know More</span></p>
                            <p style="    color: #03a685;">FREE</p>
                        </div> -->


                    </div>

                </div>
                <div class="blog-ctry-menu_1 mt-2">
                    <ul id="offcanvas-menu2" class="blog-ctry-menu">
                        <!-- <li class="blog-ctry-menu_1"><a href="javascript:void(0)">Have Any Referral Code ?</a>
                            <ul class="category-sub-menu">
                                <form>
                                    <div class="form-group d-flex">
                                        <input type="text" placeholder="Enter Referral Code" class="p-2 w-100" required="">
                                    </div>
                                </form>
                            </ul>
                        </li> -->
                        <div>
                            <div class="color-text">
                                <!-- <p>Delivery Free Above ₹2499</p> -->
                                <h5 class="mt-1"><b>Payment Mode</b></h5>
                            </div>
                            <div>
                                <div class=" flex-wrap">
                                    <div class="custom-radio mt-3">
                                        <input type="radio" id="prePaid" name="payment_mode" value="2">
                                        <label for="prePaid">
                                            <b style=" font-size:  15px; margin-bottom:  10px;"> Online Payment </b>
                                            <p class="mt-2">Get upto 5% discount on prepaid order</p>
                                        </label>
                                    </div>
                                    <div class="custom-radio mt-3">
                                        <input type="radio" id="COD" name="payment_mode" value="1" checked>
                                        <label for="COD">
                                            <b style="font-size:15px; margin-bottom:10px;"> Cash On Delivery (COD) </b>
                                            <p class="mt-2">₹40 Will be charged extra for cash on delivery</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </ul>
                </div>
                @if($PinCodeServiceable)
                <div class="d-flex justify-content-end mt-3 fix">
                    <button class="btn theme-btn--dark1 btn--md" id="placeOrder">Place Order</button>
                    <button class="btn theme-btn--dark1 btn--md mt-30 mt-sm-0" id="checkout-loader" style="border-color:#09080A;display:none;" type="button" disabled>
                        <span style="color:#09080A;">loading...</span>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="color:#09080A;"></span>
                    </button>
                </div>
                @else
                <p style="color:#dc3545">Sorry, the entered pincode is not serviceable in our delivery network. Please check the pincode or try a different one</p>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- //================ START ADDRESS LIST MODAL ================ -->
<div class="modal fade" id="addressListModal" data-bs-backdrop="addressList" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addressListLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressListLabel">Select Delivery Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 mb-30">
                        <div class="mt-2 blog-ctry-menu_1">
                            <div class="check-box-inner p-0">
                                <div class="filter-check-box_1 align-items-center">
                                    <h4 class="sub-title"> <b>SAVED ADDRESS </b></h4>
                                    <button data-bs-toggle="modal" data-bs-target="#addAddressModal" class="btn theme-btn--dark1 btn--md"><a href="#">
                                            Add New Address
                                        </a></button>
                                </div>
                                <div class="filter-check-box_1 border-bottom-0" style="display:block">
                                    @foreach($userAddressData as $address)
                                    <div class="col-12 col-md-12 mb-3" style="border-bottom: 1px solid #e7e7e7">
                                        <!-- <div>
                                            <input type="radio" id="test1" name="radio-group">
                                        </div> -->
                                        <div>
                                            <p class="bottom-m"><b>{{$address->first_name.' '.$address->last_name}} </b></p>
                                            <p class="bottom-m">{{$address->address}}</p>
                                            <p class="bottom-m">{{$address->city.', '.$address->state.'-'.$address->pincode}}</p>
                                            <p class="bottom-m"><b>Mobile:</b> {{$address->phone}}</p>
                                        </div>
                                        <div class="mt-2 mb-2 row justify-content-between align-items-center col-12">
                                            <div class="col-10">
                                                @if($defaultAddress && $address->id==$defaultAddress->id)
                                                <span class="btn--sm text-uppercase  d-block d-sm-inline-block me-sm-2" style="background-color: #e9e9eb;color: #282c3f;">Delivering Here</span>
                                                @else
                                                <form method="POST" action="{{ route('changeDefaultAddress') }}" style="display:inline">
                                                    @csrf
                                                    <input type='hidden' name='address_id' value='{{$address->id}}'>
                                                    <button class="btn theme-btn--dark1 btn--sm text-uppercase  d-block d-sm-inline-block me-sm-2" type="submit">Deliver Here</button>
                                                </form>
                                                @endif
                                                <a data-bs-toggle="modal" data-bs-target="#editAddressModal" class="btn theme--btn1 btn--sm text-uppercase  d-block d-sm-inline-block me-sm-2 edit-address-btn" data-address-id='{{$address->id}}'>Edit</a>
                                            </div>
                                            <div class="col-2">
                                                <!-- <a href="http://localhost/ekaa_vastra_2024/public/cart" class="btn theme--btn1 btn--sm text-uppercase  d-block d-sm-inline-block me-sm-2 "><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#addAddressModal" class="btn theme-btn--dark1 btn--md w-100"><a href="#">
                                        Add New Address
                                    </a></button>
                            </div>
                        </div>
                        <!-- <div class="mt-2 align-items-center d-flex justify-content-center">
                            <button data-bs-toggle="modal" data-bs-target="#staticBackdrop22" class="btn theme-btn--dark1 btn--md"><a href="#">
                                    SAVED ADDRESS
                                </a></button>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- //================ END ADDRESS LIST MODAL ================ -->
<!-- //================ START ADD ADDRESS MODAL ================ -->
<div class="modal fade " id="addAddressModal" data-bs-backdrop="addAddress" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAddressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressLabel">Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="account-details-form">
                    <form method="POST" id="add-address-form" action="{{ route('addAddress') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-10">
                                <label>First Name <span style="color:#dc3545">*</span></label>
                                <input id="add-first-name" name="first_name" placeholder="Enter First Name" type="text" required>
                            </div>

                            <div class="col-lg-6 col-12 mb-10">
                                <label>Last Name <span style="color:#dc3545">*</span></label>
                                <input id="add-last-name" name="last_name" placeholder="Enter Last Name" type="text" required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Email <span style="color:#dc3545">*</span></label>
                                <input id="add-email" name="email" placeholder="Enter Email" type="email" required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Phone Number <span style="color:#dc3545">*</span></label>
                                <input id="add-phone" name="phone" maxlength="10" minlength="10" onkeypress="return isNumberKey(event)" placeholder="Enter Phone Number" type="text" required>
                            </div>
                            <div class="col-lg-12 col-12 mb-10">
                                <label>Address (House No, Building, Street, Area) <span style="color:#dc3545">*</span></label>
                                <input id="add-address" name="address" placeholder="Enter Address" type="text" required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Country <span style="color:#dc3545">*</span></label>
                                <input id="add-country" name="country" placeholder="India" type="text" readonly required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Pincode <span style="color:#dc3545">*</span></label>
                                <input id="add-pincode" name="pincode" maxlength="6" minlength="6" onkeypress="return isNumberKey(event)" placeholder="Enter Pincode" type="text" required onkeyup="fetchAddressDetails()">
                                <p id="pin-error" style="color:#dc3545;font-size:10px"></p>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>State <span style="color:#dc3545">*</span></label>
                                <input id="add-state" name="state" placeholder="we'll autofill here" type="text" readonly required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>City <span style="color:#dc3545">*</span></label>
                                <input id="add-city" name="city" placeholder="we'll autofill here" type="text" readonly required>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn theme-btn--dark1 btn--md" button="submit">Add Address
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- //================ END ADD ADDRESS MODAL ================ -->
<!-- //================ START EDIT ADDRESS MODAL ================ -->
<div class="modal fade " id="editAddressModal" data-bs-backdrop="editAddress" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAddressLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="account-details-form">
                    <form method="POST" id="edit-address-form" action="{{ route('editAddress') }}">
                        @csrf
                        <input type="hidden" id="edit-address-id" name="address_id" value="">
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-10">
                                <label>First Name <span style="color:#dc3545">*</span></label>
                                <input id="edit-first-name" name="first_name" placeholder="Enter First Name" type="text" required>
                            </div>

                            <div class="col-lg-6 col-12 mb-10">
                                <label>Last Name <span style="color:#dc3545">*</span></label>
                                <input id="edit-last-name" name="last_name" placeholder="Enter Last Name" type="text" required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Email <span style="color:#dc3545">*</span></label>
                                <input id="edit-email" name="email" placeholder="Enter Email" type="email" required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Phone Number <span style="color:#dc3545">*</span></label>
                                <input id="edit-phone" name="phone" maxlength="10" minlength="10" onkeypress="return isNumberKey(event)" placeholder="Enter Phone Number" type="text" required>
                            </div>
                            <div class="col-lg-12 col-12 mb-10">
                                <label>Address (House No, Building, Street, Area) <span style="color:#dc3545">*</span></label>
                                <input id="edit-address" name="address" placeholder="Enter Address" type="text" required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Country <span style="color:#dc3545">*</span></label>
                                <input id="edit-country" name="country" placeholder="India" type="text" readonly required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>Pincode <span style="color:#dc3545">*</span></label>
                                <input id="edit-pincode" name="pincode" maxlength="6" minlength="6" onkeypress="return isNumberKey(event)" placeholder="Enter Pincode" type="text" required onkeyup="fetchAddressDetails()">
                                <p id="pin-error1" style="color:#dc3545;font-size:10px"></p>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>State <span style="color:#dc3545">*</span></label>
                                <input id="edit-state" name="state" placeholder="we'll autofill here" type="text" readonly required>
                            </div>
                            <div class="col-lg-6 col-12 mb-10">
                                <label>City <span style="color:#dc3545">*</span></label>
                                <input id="edit-city" name="city" placeholder="we'll autofill here" type="text" readonly required>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn theme-btn--dark1 btn--md" button="submit">Save Address
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- //================ END EDIT ADDRESS MODAL ================ -->

@endsection