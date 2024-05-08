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
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Back</a></li>
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
                            <form action="{{route('types.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="hidden" name="copy" value="{{!empty($copy)?$copy:null}}">
                                <input type="hidden" name="product_id" value="{{!empty($product_id)?$product_id:$data->product_id}}">
                                <div class="form-group row">
                                    @php
                                    $index = 1;
                                    @endphp
                                    @foreach($MasterTypeData as $master)
                                    <div class="col-sm-6 my-3">
                                        <label>{{$master->name}} &nbsp;<span style="color:red;"></span></label>
                                        <select name="attribute{{$index}}" id="attribute{{$index}}" class="form-control" >
                                            <option value="">---- Select----</option>
                                            @foreach($master->masterAttributes as $masterAttribute)
                                            <option value="{{$masterAttribute->id}}" @if ($data->{"attribute" . $index} == $masterAttribute->id) selected @endif>{{$masterAttribute->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('attribute{{$index}}')
                                        <span class='invalid-feedback' role='alert' style='color:#dc3545 !important'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    @php
                                    $index++;
                                    @endphp
                                    @endforeach
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('mrp') is-invalid @enderror" value="{{old('mrp') ? old('mrp') : $data->mrp}}" id="mrp" name="mrp" placeholder="Enter MRP" required onkeypress="return isNumberKey(event)">
                                            <label for="mrp">Enter MRP &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('mrp')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('selling_price') is-invalid @enderror" value="{{old('selling_price') ? old('selling_price') : $data->selling_price}}" id="selling_price" name="selling_price" placeholder="Enter Selling Price" required onkeypress="return isNumberKey(event)">
                                            <label for="selling_price">Enter Selling Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('selling_price')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('gst_percentage') is-invalid @enderror" value="{{old('gst_percentage') ? old('gst_percentage') : $data->gst_percentage}}" id="gst_percentage" name="gst_percentage" placeholder="Enter GST%" required onkeypress="return isNumberKey(event)">
                                            <label for="gst_percentage">Enter GST% &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('gst_percentage')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('gst') is-invalid @enderror" value="{{old('gst') ? old('gst') : $data->gst}}" id="gst" name="gst" placeholder="GST" required readonly>
                                            <label for="gst">GST &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('gst')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{old('price') ? old('price') : $data->price}}" id="price" name="price" placeholder="Price" required readonly>
                                            <label for="price">Price &nbsp;<span style="color:red;">*</span></label>
                                        </div>
                                        @error('price')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3" style="margin-top: 23px!important">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('inventory') is-invalid @enderror" value="{{old('inventory') ? old('inventory') : $data->inventory}}" id="sku" name="inventory" placeholder="Enter Inventory">
                                            <label for="inventory">Enter Inventory &nbsp;<span style="color:red;"></span></label>
                                        </div>
                                        @error('inventory')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label for="image">Image &nbsp;<span style="color:red;"></span></label>
                                        <input type="file" class="form-control" type="text" value="" id="image" name="image" placeholder="Enter Image">
                                        @if($data->image)
                                        <img id="slide_img_path2" height=100 width=100 src="{{asset($data->image)}} ">
                                        <a href="{{route('types.img_remove',[base64_encode($data->id),'image'])}}">Remove</a>
                                        @endif
                                        @error('image')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label for="image2">Image 2 &nbsp;<span style="color:red;"></span></label>
                                        <input type="file" class="form-control" type="text" value="" id="image2" name="image2" placeholder="Enter Image 2">
                                        @if($data->image2)
                                        <img id="image2" height=100 width=100 src="{{asset($data->image2)}} ">
                                        <a href="{{route('types.img_remove',[base64_encode($data->id),'image2'])}}">Remove</a>
                                        @endif
                                        @error('image2')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label for="image3">Image 3&nbsp;<span style="color:red;"></span></label>
                                        <input type="file" class="form-control" type="text" value="" id="image3" name="image3" placeholder="Enter Image 3">
                                        @if($data->image3)
                                        <img id="image3" height=100 width=100 src="{{asset($data->image3)}} ">
                                        <a href="{{route('types.img_remove',[base64_encode($data->id),'image3'])}}">Remove</a>
                                        @endif
                                        @error('image3')
                                        <div style="color:red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <label for="image4">Image 4 &nbsp;<span style="color:red;"></span></label>
                                        <input type="file" class="form-control" type="text" value="" id="image4" name="image4" placeholder="Enter Image 4">
                                        @if($data->image4)
                                        <img id="image4" height=100 width=100 src="{{asset($data->image4)}} ">
                                        <a href="{{route('types.img_remove',[base64_encode($data->id),'image4'])}}">Remove</a>
                                        @endif
                                        @error('image4')
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
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('editor1');
        $('#gst_percentage, #selling_price').keyup(function() {
            var price = $('#selling_price').val();
            var gst = $('#gst_percentage').val();
            if (price && gst) {
                var n = 100 + parseInt(gst);
                var gst_price = price / n * 100;
                var wgst = (price - gst_price).toFixed(2);
                $('#gst').val(wgst);
                $('#price').val(gst_price.toFixed(2));
            }
        });
    });
</script>
@endsection