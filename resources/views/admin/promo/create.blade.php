@extends('admin.base_template')
@section('title',$title)
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{$title}}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('promo.index')}}">Back</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                    <div class="state-information d-none d-sm-block">
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <style>
            .form-control {
                border-top: none !important;
                border-left: none !important;
                border-right: none !important;
                border-radius: 0 !important;
            }

            .form-floating>.form-control,
            .form-floating>.form-control-plaintext,
            .form-floating>.form-select {
                height: calc(2.7rem + 2px) !important;
            }
        </style>
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <!-- show success and error messages -->
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </div>
                            @endif
                            <!-- End show success and error messages -->

                            <h4 class="mt-0 header-title">{{$title}} Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{route('promo.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="form-group row">
                                    <div class="col-sm-6 my-3" style="margin-top: 37px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name') ? old('name') : $data->name}}" id="name" name="name" placeholder="Enter name" required>
                                            <label for="name">Enter Name &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('name')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label>Promocode Type &nbsp;<span style="color:red;"></span></label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="">---- Select----</option>
                                            <option value="1" @if (!empty($data->type) && ($data->type == '1')) selected @endif>One Time</option>
                                            <option value="2" @if (!empty($data->type) && ($data->type == '2')) selected @endif>Multiple Time</option>
                                        </select>
                                        @error('type')
                                        <span class='invalid-feedback' role='alert' style='color:#dc3545 !important'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label>Discount Type &nbsp;<span style="color:red;"></span></label>
                                        <select name="discount_type" id="discount_type" class="form-control" required>
                                            <option value="">---- Select----</option>
                                            <option value="1" @if (($data->discount_type == '1')) selected @endif>Percentage Off</option>
                                            <option value="2" @if (($data->discount_type == '2')) selected @endif>Amount Off</option>
                                        </select>
                                        @error('discount_type')
                                        <span class='invalid-feedback' role='alert' style='color:#dc3545 !important'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 37px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('discount') is-invalid @enderror" value="{{old('discount') ? old('discount') : $data->discount}}" id="discount" name="discount" onkeypress="return isNumberKey(event)" required>
                                            <label for="discount"><span id="discount_label">Enter Discount (%)</span> &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('discount')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important" id="max">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('max_discount') is-invalid @enderror" value="{{old('max_discount') ? old('max_discount') : $data->max_discount}}" id="max_discount" name="max_discount" placeholder="Enter Max Discount" onkeypress="return isNumberKey(event)" required>
                                            <label for="max_discount">Enter Max Discount &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('max_discount')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('mini_amount') is-invalid @enderror" value="{{old('mini_amount') ? old('mini_amount') : $data->mini_amount}}" id="mini_amount" name="mini_amount" placeholder="Enter Minimum Amount" onkeypress="return isNumberKey(event)" required>
                                            <label for="mini_amount">Enter Minimum Amount &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('mini_amount')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" value="{{old('expiry_date') ? old('expiry_date') : $data->expiry_date}}" id="expiry_date" name="expiry_date" placeholder="Enter Expiry Date">
                                            <label for="expiry_date">Enter Expiry Date &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('expiry_date')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-save"></i> Submit</button>

                                        </div>
                                    </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
        <!-- end page content-->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
     $(document).ready(function() {
        $('#discount_type').trigger('change');
     });
    $('#discount_type').on('change', function() {
        if (this.value == 1) {
            $('#discount_label').html('Enter Discount (%)');
            document.getElementById("max_discount").required = true;
            $('#max').show();
        } else {
            $('#discount_label').html('Enter Flat Discount');
            document.getElementById("max_discount").required = false;
            $('#max').hide();
        }
    });
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#expiry_date').attr('min', maxDate);
    });
</script>
@endsection