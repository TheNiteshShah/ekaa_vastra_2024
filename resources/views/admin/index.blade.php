@extends('admin.base_template')
@section('main')
<style>
    page-title-box {
        background-image: url("..\images\bg.jpg") !important;
    }

    .bg-theme {
        background-color: #292929;
    }
</style>


<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Welcome to {{config('constants.options.SITE_NAME')}} Dashboard</li>
                    </ol>


                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('all_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total QR Scanned</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total QR Scanned</h6>
                                        <h3 class="mb-3 mt-0">{{$qr_count}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total QR Scanned</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('all_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Orders</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Orders</h6>
                                        <h3 class="mb-3 mt-0">{{$totalOrders}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Orders</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('users.index')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Users</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Users</h6>
                                        <h3 class="mb-3 mt-0">{{$totalUsers}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Users</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-account-multiple display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('category.index')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Category</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Category</h6>
                                        <h3 class="mb-3 mt-0">{{$totalCategory}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Category</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('products.all')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Products</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Products</h6>
                                        <h3 class="mb-3 mt-0">{{$totalProducts}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Products</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary  mini-stat position-relative">
                        <a href="{{route('new_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total New Orders</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total New Orders</h6>
                                        <h3 class="mb-3 mt-0">{{$TotalNewOrders}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total New Orders</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('accepted_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Accepted</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Accepted</h6>
                                        <h3 class="mb-3 mt-0">{{$TotalAcceptedOrders}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Accepted</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi  mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary  mini-stat position-relative">
                        <a href="{{route('dispatched_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Dispatched </h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Dispatched </h6>
                                        <h3 class="mb-3 mt-0">{{$TotalDispatchedOrders}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Dispatched </span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi  mdi-calendar-check display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary  mini-stat position-relative">
                        <a href="{{route('delivered_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Delivered</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Delivered</h6>
                                        <h3 class="mb-3 mt-0">{{$TotalDeliveredOrders}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Delivered</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-calendar-check display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('rejected_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Rejected</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Rejected</h6>
                                        <h3 class="mb-3 mt-0">{{$TotalRejectedOrders}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Rejected</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary   mini-stat position-relative">
                        <a href="{{route('new_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Todays Orders</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Todays Orders</h6>
                                        <h3 class="mb-3 mt-0">{{$TotalTodaysOrders}}</h3>
                                        <div class="">
                                            <span class="ml-2">Todays Orders</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-shopping display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary  mini-stat position-relative">
                        <a href="{{ route('users.index', ['filter' => 'today']) }}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Todays Users</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Todays Users</h6>
                                        <h3 class="mb-3 mt-0">{{$TotalTodaysUsers}}</h3>
                                        <div class="">
                                            <span class="ml-2">Todays Users</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-account-multiple display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary mini-stat position-relative">
                        <a href="{{route('all_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Total Amount</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Total Amount</h6>
                                        <h3 class="mb-3 mt-0">₹{{$sumFinalAmount}}</h3>
                                        <div class="">
                                            <span class="ml-2">Total Amount</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-currency-inr display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-secondary  mini-stat position-relative">
                        <a href="{{route('new_orders')}}">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Todays Amount</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Todays Amount</h6>
                                        <h3 class="mb-3 mt-0">₹{{$TodaysSumFinalAmount}}</h3>
                                        <div class="">
                                            <span class="ml-2">Todays Amount</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-currency-inr display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end page content-->
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div> <!-- content -->

@endsection