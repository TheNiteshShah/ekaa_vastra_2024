@extends('frontend.base_template')
@section('title', 'Order Details #{{$ordersDetail->id}} - Ekaa Vastra')
@section('main')<style>
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
        color: #20BD99;
        border-bottom: 2px solid #20BD99;
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
            <div class="col-12">
                <div class="breadcrumb-title text-center my-20">
                    <h2 class="title text-dark text-capitalize">Order ID #{{$ordersDetail->id}}</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
            </div>
        </div>
    </div>
</nav>

<!-- breadcrumb-section end -->
<!-- product tab start -->

<div class="my-account pb-40">
    <div class="container grid-wraper">
        <div class="row">
            <div class="col-lg-6 mb-30">
                <div class="mt-2 blog-ctry-menu_1">
                    <div class="check-box-inner p-0">
                        <div class="filter-check-box_1">
                            <h4 class="sub-title"> <b>Shipping Address </b></h4>
                        </div>
                        <div class="filter-check-box_1 border-bottom-0" style="display:block;">
                            <p>Deliver to: <b>{{$ordersDetail->address->first_name.' '.$ordersDetail->address->last_name}}, {{$ordersDetail->address->pincode}}</b></p>
                            <p>{{$ordersDetail->address->address}}, {{$ordersDetail->address->city}}</p>
                        </div>
                    </div>
                </div>
                <h5 class="pb-10 mt-3 text-center text-md-start text-capitalize">Order Items ({{1}})</h5>
                <hr>
                <div class="table-responsive wdfqw" style="height: 265px;">
                    <table class="table mb-0">
                        <tbody>
                            @foreach($ordersDetail->details as $data)
                            <tr>
                                <th class="text-center" scope="row" style="width: 23%;">
                                    <a href="{{route('product',strtolower(str_replace('+', '-', urlencode($data->product->name))))}}" class="image"><img src="{{asset($data->product->image)}}" class="view_checkout_image mt-0" alt="img"></a>
                                </th>
                                <td class="text-start" style="width: 60%;">
                                    <div>
                                        <span class="whish-title"> <b>{{$data->product->name}} </b></span>
                                    </div>
                                    <div>
                                        <span class="whish-title"> ₹{{$data->product->selling_price}}</span>
                                    </div>
                                    <div class="">
                                        <!-- Button trigger modal -->
                                        <span>Size: {{$data->type->size->name}}</span>
                                        <span>Qty: {{$data->quantity}}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-lg-6 mb-30">
                <div class="mt-2 blog-ctry-menu_1">
                    <div class="check-box-inner p-0">
                        <h4 class="sub-title">Price Details</h4>
                        <div class="filter-check-box_1">
                            <p>Total</p>
                            <p>₹{{$ordersDetail->total_amount}}</p>
                        </div>
                        <div class="filter-check-box_1">
                            <p>Shipping</p>
                            <p>₹{{$ordersDetail->shipping}}</p>
                        </div>
                        <div class="filter-check-box_1">
                            <p>SubTotal</p>
                            <p>₹{{$ordersDetail->final_amount}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Account Tab Content End -->
</div>
<!-- product tab end -->
@endsection