@extends('admin.base_template')
@section('title', $title)
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ $title }}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('rk_vendor.index') }}">Back</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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

                            <h4 class="mt-0 header-title">{{ $title }} Form</h4>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <form action="{{ route('rk-vendor-product.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="vendor_id"
                                    value="{{ $data->id ? base64_encode($data->vendor_id) : $parent_id }}">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-group row">
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') ? old('name') : $data->name }}" id="name"
                                                name="name" placeholder="Enter Name" required>
                                            <label for="name">Enter Name &nbsp;<span
                                                    style="color:red;">*</span></label>
                                        </div>
                                        @error('name')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price') ? old('price') : $data->price }}" id="price"
                                                name="price" placeholder="Enter Price" required
                                                onkeypress="return isNumberKey(event)">
                                            <label for="price">Enter Price &nbsp;<span
                                                    style="color:red;">*</span></label>
                                        </div>
                                        @error('price')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                      <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('hsn_code') is-invalid @enderror"
                                                value="{{ old('hsn_code') ? old('hsn_code') : $data->hsn_code }}" id="hsn_code"
                                                name="hsn_code" placeholder="Enter HSN Code">
                                            <label for="hsn_code">Enter HSN Code &nbsp;<span
                                                    style="color:red;"></span></label>
                                        </div>
                                        @error('hsn_code')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3 my-3" style="margin-top: 23px!important">
                                        <label for="unit">Select Unit <span style="color:red;">*</span></label>
                                        <select class="form-select @error('unit') is-invalid @enderror" id="unit"
                                            name="unit" required>
                                            <option value="" disabled
                                                {{ old('unit', $data->unit ?? '') == '' ? 'selected' : '' }}>--
                                                Select Unit --</option>
                                            <option value="Set"
                                                {{ old('unit', $data->unit ?? '') == 'Set' ? 'selected' : '' }}>Set
                                            </option>
                                            <option value="Pc"
                                                {{ old('unit', $data->unit ?? '') == 'Pc' ? 'selected' : '' }}>Pc
                                            </option>
                                        </select>

                                        @error('unit')
                                        <div style="color:red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                  
                                    <div class="form-group">
                                        <div class="w-100 text-center">
                                            <button type="submit" style="margin-top: 10px;" class="btn btn-info"><i
                                                    class="fa fa-save"></i> Submit</button>

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