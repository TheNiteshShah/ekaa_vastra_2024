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
                        <li class="breadcrumb-item"><a href="{{route('fabric.index')}}">Back</a></li>
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
                            <form action="{{route('fabric.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="form-group row">
                                    @if(!$data->id)
                                    <div class="col-sm-6 my-3">
                                        <label>Vendor &nbsp;<span style="color:red;"></span></label>
                                        <select name="vendor_id" id="vendor_id" class="form-control">
                                            <option value="">---- Select----</option>
                                            @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" @if ($data->vendor_id == $vendor->id) selected @endif>{{$vendor->business_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('vendor_id')
                                        <span class='invalid-feedback' role='alert' style='color:#dc3545 !important'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label for="image">Image &nbsp;<span style="color:red;"></span></label>
                                        <input type="file" class="form-control" type="text" value="" id="image" name="image" placeholder="Enter Image">
                                        @if($data->image)
                                        <img id="slide_img_path2" height=100 width=100 src="{{asset($data->image)}} ">
                                        @endif
                                        @error('image')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="col-sm-3 my-3" style="margin-top: 37px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity') ? old('quantity') : ''}}" id="quantity" name="quantity" placeholder="Enter Quantity" onkeypress="return isNumberKey(event)" required>
                                            <label for="quantity">Enter Quantity &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('quantity')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3 my-3" >
                                    <label>Unit &nbsp;<span style="color:red;"></span></label>
                                        <select name="unit" id="unit" class="form-control" @if($data->id) disabled @endif>
                                            <option value="">---- Select----</option>
                                            <option value="Meter" @if ($data->unit == "Meter") selected @endif>Meter</option>
                                            <option value="Piece" @if ($data->unit == "Piece") selected @endif>Piece</option>
                                        </select>
                                        @error('unit')
                                        <span class='invalid-feedback' role='alert' style='color:#dc3545 !important'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @if(!$data->id)
                                    <div class="col-sm-4 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('sample_price') is-invalid @enderror" value="{{old('sample_price') ? old('sample_price') : $data->sample_price}}" id="sample_price" name="sample_price" placeholder="Enter Sample Price" onkeypress="return isNumberKey(event)" required>
                                            <label for="sample_price">Enter Sample Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('sample_price')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('bulk_price') is-invalid @enderror" value="{{old('bulk_price') ? old('bulk_price') : $data->bulk_price}}" id="bulk_price" name="bulk_price" placeholder="Enter Bulk Price" onkeypress="return isNumberKey(event)" required>
                                            <label for="bulk_price">Enter Bulk Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('bulk_price')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="col-sm-4 my-3" style="margin-top: 37px!important">
                                        <div class="form-floating">
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" value="{{old('date') ? old('date') : ''}}" id="date" name="date" placeholder="Enter Date" required>
                                            <label for="date">Enter Date &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('date')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-danger"><i class="fa fa-user"></i> Submit</button>

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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection