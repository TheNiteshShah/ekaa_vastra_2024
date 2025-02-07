<!DOCTYPE html>
<html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" href="{{asset('admin/assets/images/favicon.png')}}">
    <title>Invoice No #{{$OrderData->id}}</title>
</head>
<style>
    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<body style="padding-top:75px;">
    <div class="container main_container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="{{asset('admin/assets/images/logo.png')}}" class="img-fluid" style="width:180px;">
                <p class="mb-0"><b>INVOICE</b></p>
                <p style="font-size:12px">(Original for Recipient)</p>
            </div>
        </div><br>
        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-6"><span class="font-weight-bold ">Seller</span><br>
                    <span class="seller_details">Ekaa Vastra <br>
                        105, 1st floor, Sunshine Aditya, Maharana Pratap Marg, <br> Near Teoler High School, Jaipur, Rajasthan
                        <br> 302012<br>
                        <span class="font-weight-bold">GSTIN : </span> 08BVTPJ7597L1ZC
                        <br>
                    </span>
                </div>
                <div class="col-sm-6">
                    <span class="font-weight-bold ">Billing Details:</span><br>
                    <div class="d-flex">
                        <ul style="list-style-type:none;padding-left: 0px;">
                            <li style="padding-left: 0px;">Name<span style="margin-left:30px">:</span></li>
                            <li style="padding-left: 0px;">Phone<span style="margin-left:28px">:</span></li>
                            @if($OrderData->address->email)<li style="padding-left: 0px;">Email<span style="margin-left:16px">:</span></li>@endif
                            <li style="padding-left: 0px;">Address<span style="margin-left:16px">:</span></li>
                        </ul>
                        <ul style="list-style-type:none">
                            <li>{{$OrderData->address->first_name}} {{$OrderData->address->last_name}}</li>
                            <li>{{$OrderData->address->phone}}</li>
                            @if($OrderData->address->email) <li>{{$OrderData->address->email}}</li>@endif
                            <li>{{$OrderData->address->address}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <span class="font-weight-bold ">Order Details</span><br>
                    <div class="d-flex">
                        <ul style="list-style-type:none;padding-left: 0px;">
                            <li style="padding-left: 0px;"><span>Order Id</span><span style="margin-left:80px">:</span></li>
                            <li style="padding-left: 0px;">Invoice No<span style="margin-left:63px">:</span></li>
                            <li style="padding-left: 0px;">Mode of Payment<span style="margin-left:11px">:</span></li>
                            <li style="padding-left: 0px;">Order Date<span style="margin-left:61px">:</span></li>
                        </ul>
                        <ul style="list-style-type:none">
                            <li>#{{$OrderData->id}}</li>
                            <li>{{$OrderData->invoice_no?$OrderData->invoice_no:'--'}}</li>
                            <li>{{$OrderData->payment_mode==1?'Cash On Delivery':'Prepaid'}}</li>
                            <li>{{$OrderData->created_at}}</li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 shipping_content"><span class="font-weight-bold ">Shipping Details:</span> <br>
                    <div class="d-flex">
                        <ul style="list-style-type:none;padding-left: 0px;">
                            <li style="padding-left: 0px;">Name<span style="margin-left:30px">:</span></li>
                            <li style="padding-left: 0px;">Phone<span style="margin-left:28px">:</span></li>
                            @if($OrderData->address->email)<li style="padding-left: 0px;">Email<span style="margin-left:16px">:</span></li>@endif
                            <li style="padding-left: 0px;">Address<span style="margin-left:16px">:</span></li>
                        </ul>
                        <ul style="list-style-type:none">
                            <li>{{$OrderData->address->first_name}} {{$OrderData->address->last_name}}</li>
                            <li>{{$OrderData->address->phone}}</li>
                            @if($OrderData->address->email) <li>{{$OrderData->address->email}}</li>@endif
                            <li>{{$OrderData->address->address}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="container">
                    <table class="table table-black">
                        <thead class="product_table" style="background-color: #e1dbd5;">
                            <tr>
                                <th>SNo.</th>
                                <th>Description</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <!-- <th>Net Amount</th>
                                <th>GST(%)</th>
                                <th>Tax Amount</th> -->
                                <th>Total Amount</th>
                        </thead>
                        <tbody>
                            @if(!empty($foreachData))
                            @foreach($foreachData as $data)
                            @php
                            $value = ($data->gst_percentage / 100) + 1;
                            $unit_price = round(($data->price* $data->quantity) / $value, 2);
                            $tax_amt = round(($unit_price * $data->gst_percentage / 100),2);
                            @endphp
                            <tr class="product_table2">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->product->name}} - {{$data->type->size->name}}</td>
                                <td>{{$data->product->sku?$data->product->sku:'-'}}</td>
                                <td>{{$data->quantity}}</td>
                                <!-- <td>₹{{$unit_price}}</td>
                                <td>CGST {{$data->gst_percentage/2}}% <br> SGST {{$data->gst_percentage/2}}%</td>
                                <td>₹{{round($tax_amt/2,2)}}<br>₹{{round($tax_amt/2,2)}}</td> -->
                                <td class=" text-right">₹{{$data->price* $data->quantity}}</td>
                            </tr>
                            @endforeach
                            @endif
                            <tr>
                                <td colspan="3"></td>
                                <td>SubTotal</td>
                                <td class="product_table text-right">₹{{$OrderData->total_amount}}</td>
                            </tr>
                            @if($OrderData->promo_discount)
                            <tr>
                                <td colspan="3"></td>
                                <td>Discount</td>
                                <td class="product_table text-right">-₹{{$OrderData->promo_discount}}</td>
                            </tr>
                            @endif
                            @if($OrderData->wallet_discount)
                            <tr>
                                <td colspan="3"></td>
                                <td>Wallet Discount</td>
                                <td class="product_table text-right">-₹{{$OrderData->wallet_discount}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3"></td>
                                <td>Shipping</td>
                                <td class="product_table text-right">+₹{{$OrderData->shipping}}</td>
                            </tr>
                            <!-- <tr>
                                <td colspan="6"></td>
                                <td>Free Shipping (First Order)</td>
                                <td class="product_table text-right">-₹{{$OrderData->shipping}}</td>
                            </tr> -->


                            <tr>
                                <th colspan="3"></th>
                                <th>Total</th>
                                <th class="product_table text-right">₹{{$OrderData->final_amount}}</th>
                            </tr>

                        </tbody>
                    </table>
                    <h6 class="amount_content">Amount in Words:
                        <span id="checks123" style="text-transform: capitalize;font-style: revert;"></span>
                    </h6>
                    <hr>
                    <div class="text-center d-flex justify-content-between">
                        <p class="mb-0"><i class="fa fa-envelope"></i> ekaavastra@gmail.com</p>
                        <p class="mb-0"><i class="fa fa-globe"></i> www.ekaavastra.com</p>
                        <p class="mb-0"><i class="fa fa-phone"></i> +91 9636373743</p>
                    </div>
                    <input type="hidden" value="{{$OrderData->final_amount}}" id="tot_amnt">
                    <!-- <div style="display: flex;
    justify-content: space-between;
    align-items: center;">
            <div>
              <h5>
                Terms & Condition:
              </h5>
              <span>1) All subject to Jaipur Jurisdiction <br>2) No Return/Refund and Only Exchange<br>3) No Exchange after 7 days</span>
            </div>
            <div>
              <h5 class="oswal_head"><br><br>
                Authorized Signatory </h5>
              </tr>
              <h5 class="warning">Whether tax is payable under reverse charge-No</h5>
            </div>
          </div> -->
                </div>
            </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    //alert('Changed!')
    $('#gst_percentage').keyup(function() {
        // alert("Key up detected");
        var total_price = $("#mrp").val();
        //var gst_percentage = $("#gst_percentage").val();$(this).val
        var gst_percentage = $(this).val();
        var gst_price = (total_price * gst_percentage) / 100;
        var total_gst_price = parseInt(total_price) + parseInt(gst_price);
        //alert(total_gst_price);
        $('#gst_percentage_price').val(gst_price);
        $('#selling_price').val(total_gst_price);
    });
</script>
<script>
    window.onload = function() {
        var unit_mrp = $(".unit_mrp").text();
        var unit_qty = $(".qty").text();
        //var gst_percentage = $("#gst_percentage").val();$(this).val
        var total_unit_mrp = parseInt(unit_mrp) * parseInt(unit_qty);
        //alert(total_gst_price);
        $('.net_unit_mrp').text(total_unit_mrp);
        var total_amount = document.getElementById("tot_amnt").value;
        // alert(total_amount);
        inWords(total_amount);
        window.print();
    };
    var a = ['', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine ', 'Ten ', 'Eleven ', 'Twelve ', 'Thirteen ', 'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ', 'Eighteen ', 'Nineteen'];
    var b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    function inWords(num) {
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return;
        var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'And ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
        //return str;
        // alert(str);
        $("#checks123").text('Rupees ' + str + ' Only');
    }
</script>

</html>