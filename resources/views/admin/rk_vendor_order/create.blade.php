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
                                <form action="{{ route('rk-vendor-order.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="vendor_id"
                                        value="{{ $data->id ? base64_encode($data->vendor_id) : $parent_id }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" id="count"
                                        value="{{ !empty($data) ? count($data->orderDetails) : 1 }}" name="count">

                                    <div class="form-group row">
                                        <div class="col-sm-3 my-3" style="margin-top: 23px!important">
                                            <div class="form-floating">
                                                <input type="date"
                                                    class="form-control @error('invoice_date') is-invalid @enderror"
                                                    value="{{ old('invoice_date') ? old('invoice_date') : $data->invoice_date }}"
                                                    id="invoice_date" name="invoice_date" placeholder="Enter Date" required>
                                                <label for="invoice_date">Enter Date &nbsp;<span
                                                        style="color:red;">*</span></label>
                                            </div>
                                            @error('invoice_date')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 my-3" style="margin-top: 23px!important">
                                            <div class="form-floating">
                                                <input type="number"
                                                    class="form-control @error('invoice_no') is-invalid @enderror"
                                                    value="{{ old('invoice_no') ? old('invoice_no') : $data->invoice_no }}"
                                                    id="invoice_no" name="invoice_no" placeholder="Enter Invoice No."
                                                    required>
                                                <label for="invoice_no">Enter Invoice No. &nbsp;<span
                                                        style="color:red;">*</span></label>
                                            </div>
                                            @error('invoice_no')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                            <div id="validate_status"></div>
                                        </div>
                                        <div class="col-sm-3 my-3">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('reverse_charge') is-invalid @enderror"
                                                    value="{{ old('reverse_charge', $data->reverse_charge ?? 'N') }}"
                                                    id="reverse_charge" name="reverse_charge"
                                                    placeholder="Enter Reverse Charge">
                                                <label for="reverse_charge">Reverse Charge</label>
                                            </div>
                                            @error('reverse_charge')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-3 my-3">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('challan_no') is-invalid @enderror"
                                                    value="{{ old('challan_no', $data->challan_no) }}" id="challan_no"
                                                    name="challan_no" placeholder="Enter Challan No." required>
                                                <label for="challan_no">Challan No. &nbsp;<span
                                                    style="color:red;">*</span></label>
                                            </div>
                                            @error('challan_no')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-3 my-3">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('transport') is-invalid @enderror"
                                                    value="{{ old('transport', $data->transport ?? 'Self') }}" id="transport"
                                                    name="transport" placeholder="Enter Transport Name">
                                                <label for="transport">Transport</label>
                                            </div>
                                            @error('transport')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-3 my-3">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('vehicle_no') is-invalid @enderror"
                                                    value="{{ old('vehicle_no', $data->vehicle_no) }}" id="vehicle_no"
                                                    name="vehicle_no" placeholder="Enter Vehicle No.">
                                                <label for="vehicle_no">Vehicle No.</label>
                                            </div>
                                            @error('vehicle_no')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-3 my-3">
                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control @error('station') is-invalid @enderror"
                                                    value="{{ old('station', $data->station) }}" id="station"
                                                    name="station" placeholder="Enter Station">
                                                <label for="station">Station</label>
                                            </div>
                                            @error('station')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            @if (!empty($data->orderDetails) && count($data->orderDetails) > 0)
                                                @foreach ($data->orderDetails as $index => $order)
                                                    @php
                                                        $i = $index + 1;
                                                    @endphp

                                                    <div class="row product-row" id="tb-{{ $i }}">
                                                        <!-- Product Dropdown -->
                                                        <div class="col-sm-3 my-3">
                                                            <label>Product</label>
                                                            <select name="name[]" id="name-{{ $i }}"
                                                                data-id="{{ $i }}" onchange="change(this)"
                                                                class="form-control select2">
                                                                <option value="">----Select Product----</option>
                                                                @foreach ($productData as $product)
                                                                    <option value="{{ $product->id }}"
                                                                        {{ $order->product_id == $product->id ? 'selected' : '' }}
                                                                        data-price="{{ $product->price }}">
                                                                        {{ $product->name }} - ₹{{ $product->price }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Quantity Input -->
                                                        <div class="col-sm-3 my-3" style="margin-top: 23px!important">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                    name="quantity[]" placeholder="Enter Quantity"
                                                                    id="qty-{{ $i }}"
                                                                    value="{{ $order->quantity }}"
                                                                    onkeypress="return isNumberKey(event)"
                                                                    onkeyup="calculate_selling('{{ $i }}')">
                                                                <label for="qty-{{ $i }}">Enter
                                                                    Quantity</label>
                                                            </div>
                                                        </div>

                                                        <!-- Total Input + Buttons -->
                                                        <div class="col-sm-4 my-3" style="margin-top: 23px!important;">
                                                            <div class="form-floating d-flex align-items-center">
                                                                <input type="text" readonly class="form-control"
                                                                    name="total[]" id="total-{{ $i }}"
                                                                    value="{{ $order->price * $order->quantity }}"
                                                                    style="background-color: white">
                                                                <label for="total-{{ $i }}">Total</label>

                                                                {{-- Buttons Logic --}}
                                                                @if ($loop->first)
                                                                    <button style="margin-left: 5px;"
                                                                        class="btn btn-success" type="button"
                                                                        onclick="addMore()">
                                                                        Add <i class="fa fa-plus"></i>
                                                                    </button>
                                                                @else
                                                                    <button style="margin-left: 5px;"
                                                                        class="btn btn-success" type="button"
                                                                        onclick="addMore()">
                                                                        Add <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button style="margin-left: 5px;" type="button"
                                                                        onclick="remove({{ $i }})"
                                                                        class="btn btn-danger">
                                                                        Remove <i class="fa fa-times"></i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-sm-3 my-3">
                                                    <label>Product &nbsp;<span style="color:red;"></span></label>
                                                    <select name="name[]" id="name-1" data-id="1"
                                                        onchange="change(this)" class="form-control select2" required>
                                                        <option value="">----Select Product----</option>
                                                        @foreach ($productData as $product)
                                                            <option value="{{ $product->id }}"
                                                                {{ $data->product_id == $product->id ? 'selected' : '' }}
                                                                data-price="{{ $product->price }}">{{ $product->name }} -
                                                                ₹{{ $product->price }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 my-3" style="margin-top: 23px!important">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Quantity" required name="quantity[]"
                                                            onkeypress="return isNumberKey(event)" id="qty-1"
                                                            onkeyup="calculate_selling('1')">
                                                        <label for="quantity">Enter Quantity &nbsp;<span
                                                                style="color:red;">*</span></label>
                                                    </div>
                                                    @error('quantity')
                                                        <div style="color:red">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4 my-3" style="margin-top: 23px!important;">
                                                    <div class="form-floating" style="display: flex;align-items: center;">
                                                        <input type="text" readonly class="form-control"
                                                            name="total[]" id="total-1"
                                                            style="background-color: white">
                                                        <label for="Total">Total &nbsp;<span
                                                                style="color:red;">*</span></label>
                                                        <button style="margin-left:10px;" class="btn btn-success"
                                                            type="button" onclick="addMore()">Add <i
                                                                class="fa fa-plus"></i></button>
                                                    </div>
                                                    @error('total')
                                                        <div style="color:red">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div id="more"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="w-100 text-center">
                                                <button type="submit" style="margin-top: 10px;" class="btn btn-info"><i
                                                        class="fa fa-save"></i> {{ empty($data) ? 'Generate' : 'Update' }}
                                                    Invoice</button>

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
            $('#invoice_date').on('change', function() {
                const selectedDate = $(this).val();
                if (selectedDate) {
                    $.ajax({
                        url: "{{ route('rk-get-next-invoice-no') }}", // Define this route
                        type: "GET",
                        data: {
                            date: selectedDate
                        },
                        success: function(response) {
                            $('#invoice_no').val(response.next_invoice_no);
                        },
                        error: function() {
                            alert('Could not fetch next invoice number.');
                        }
                    });
                }
            });
            $('#invoice_no').on('change', function () {
            const invoiceNo = $(this).val();
            const invoiceDate = $('#invoice_date').val();

            if (invoiceNo && invoiceDate) {
                $.ajax({
                    url: "{{ route('rk-validate-invoice-no') }}",
                    type: "GET",
                    data: {
                        invoice_no: invoiceNo,
                        invoice_date: invoiceDate,
                        id: "{{ $data->id ?? '' }}"
                    },
                    success: function (response) {
                        const statusDiv = $('#validate_status');
                        if (!response.valid) {
                            $('#invoice_no').val('').focus();
                            statusDiv
                                .html('Invoice number already exists for the selected year.')
                                .css({ color: 'red', marginTop: '5px' });
                        } else {
                            statusDiv
                                .html('Invoice number is valid.')
                                .css({ color: 'green', marginTop: '5px' });
                        }
                    },
                    error: function () {
                        $('#validate_status').html('Could not validate invoice number.')
                            .css({ color: 'orange', marginTop: '5px' });
                    }
                });
            } else {
                $('#validate_status').html('');
            }
        });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').each(function() {
                if (!$(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2();
                }
            });
        });
    </script>
    <script>
        function change(obj) {
            var vf = $(obj).val();
            var id = $(obj).data('id');
            var price = $('#name-' + id + ' option:selected').data('price');

            var qty = parseFloat($('#qty-' + id).val());
            if (isNaN(vf) || isNaN(qty)) {
                return false;
            } else {
                $('#total-' + id).val(price * qty);
            }
        }
        //--type change -------
        function calculate_selling(id) {
            var price = $('#name-' + id + ' option:selected').data('price');
            var qty = parseFloat($('#qty-' + id).val());
            if (isNaN(price) || isNaN(qty)) {
                return false;
            } else {
                $('#total-' + id).val(price * qty);
            }
            // })
        }
        // });
        //===================Get vendor  End===================
        function addMore() {
            var count = parseInt($("#count").val());
            var index = count + 1;
            var div = '<div id="tb-' + index +
                '" class="row"><div class="col-sm-3 my-3"><label>Product &nbsp;<span style="color:red;"></span></label><select name="name[]" id="name-' +
                index + '" data-id="' + index +
                '" onchange="change(this)" class="form-control select2" required><option value="">----Select Product----</option>@foreach ($productData as $product)<option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - ₹{{ $product->price }}</option>@endforeach</select></div> <div class="col-sm-3 my-3" style="margin-top: 23px!important"><div class="form-floating"><input type="text" class="form-control" placeholder="Enter Quantity" required name="quantity[]" onkeypress="return isNumberKey(event)" onkeyup="calculate_selling(' +
                index + ')"  id="qty-' + index +
                '"><label for="quantity">Enter Quantity &nbsp;<span style="color:red;">*</span></label></div></div><div class="col-sm-4 my-3" style="margin-top: 23px!important;"><div class="form-floating" style="display: flex;align-items: center;"><input type="text" readonly class="form-control" name="total[]" id="total-' +
                index +
                '" style="background-color: white"><label for="Total">Total &nbsp;<span style="color:red;">*</span></label><button style="margin-left:5px;" class="btn btn-success" type="button" onclick="addMore()">Add <i class="fa fa-plus"></i></button><button style="margin-left:5px" type="button" onclick="remove(' +
                index + ')" class="btn btn-danger">Remove <i class="fa fa-times" ></i></button></div></div></div>';

            $('#more').append(div);
            $("#count").val(index);
            $(".select2").select2();
        }

        function remove(id) {
            document.getElementById("tb-" + id).remove();
            var count = parseInt($("#count").val()) - 1;
            $("#count").val(count);
        }
    </script>

@endsection
