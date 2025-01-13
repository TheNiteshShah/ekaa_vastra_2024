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
                        <li class="breadcrumb-item"><a href="{{route('popup.index')}}">Back</a></li>
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
                            <form action="{{route('popup.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="form-group row">
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="url" class="form-control @error('link') is-invalid @enderror" value="{{old('link') ? old('link') : $data->link}}" id="link" name="link" placeholder="Enter Link">
                                            <label for="link">Enter Link &nbsp;<span style="color:red;"></span></label>
                                        </div>
                                        @error('link')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label>Is Form Active &nbsp;<span style="color:red;"></span></label>
                                        <select name="form_active" id="form_active" class="form-control" required>
                                            <option value="">---- Select----</option>
                                            <option value="1" @if ( ($data->form_active == 1)) selected @endif>Yes</option>
                                            <option value="0" @if ( ($data->form_active == 0)) selected @endif>No</option>
                                        </select>
                                        @error('form_active')
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
@endsection