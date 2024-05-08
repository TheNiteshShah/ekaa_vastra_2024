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

<body style="padding-top:75px;">
    <div class="container main_container">
        <div class="row">
            <div class="col-sm-6 oswal_logo">
                <img src="{{asset('admin/assets/images/logo.png')}}" class="img-fluid" style="width:150px;">
            </div>
            <div class="col-sm-6 content_part">Tax Invoice/Bill of Supply/Cash Memo
                <p>(Original for Recipient)</p>
            </div>
        </div><br>
        <div class="container">
            <div class="row">
                <div class="col-sm-6"><span class="font-weight-bold ">Sold By</span><br>
                    <span class="seller_details">Fineoutput<br>
                        19 Kalyanpuri, New Sanganer Road, Sodala,<br> Jaipur, Rajasthan,
                        <br> 302019
                        <br>
                        www.fineoutput.com
                        <br>
                        <br></span>
                </div>
                <div class="col-sm-6 billing_content"><span class="font-weight-bold ">Billing Address:</span><br>
                    User Name: {{$OrderData->user->name}}
                    <br>Contact: {{$OrderData->user->phone}}
                    <br>Address: {{$OrderData->address}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <br />
                    <br />
                    <span class="font-weight-bold">GST Registration Number : </span> <br> 125478dcsc458
                </div>
                <div class="col-sm-6 shipping_content"><span class="font-weight-bold ">Shipping Address:</span> <br>
                    Name: {{$OrderData->user->name}}<br>
                    Phone:{{$OrderData->user->phone}}<br>
                    Email:{{$OrderData->user->email}}<br>
                    Address: {{$OrderData->address}}<br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    Order Id : &nbsp; #{{$OrderData->id}}<br>
                    <p> Order Date: &nbsp;
                        {{$OrderData->created_at->format('Y-m-d H:i:s')}}
                    <div><br> <br>
                    </div>
                </div>
                <div class="container">
                    <table class="table table-black">
                        <thead class="product_table">
                            <tr>
                                <th>SNo.</th>
                                <th>Description</th>
                                <th>SKU</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Net Amount</th>
                                <th>GST(%)</th>
                                <th>Tax Amount</th>
                                <th>Total Amount</th>
                        </thead>
                        <tbody>
                            @if(!empty($foreachData))
                            @foreach($foreachData as $data)
                            @php
                            $value = ($data->gst_percentage / 100) + 1;
                            $unit_price = round($data->total_price / $value, 2);
                            $tax_amt = round(($unit_price * $data->gst_percentage / 100),2);
                            @endphp
                            <tr class="product_table2">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->product->name}} - {{$data->type->name}}</td>
                                <td>{{$data->product->sku?$data->product->sku:'-'}}</td>
                                <td>₹{{$data->price}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>₹{{$unit_price}}</td>
                                <td>{{$data->gst_percentage}}%</td>
                                <td>₹{{$tax_amt}}</td>
                                <td>₹{{$data->total_price}}</td>
                            </tr>
                            @endforeach
                            @endif
                            @if(!empty($OrderData->promo_id))
                            <tr>
                                <th colspan="8">Sub Total</th>
                                <th class="product_table">₹{{$OrderData->total_amount}}</th>
                            </tr>
                            <tr>
                                <th colspan="8">Promocode Discount:  {{$OrderData->promo->name}}</th>
                                <th class="product_table">₹{{$OrderData->promo_discount}}</th>
                            </tr>
                           
                            @endif
                            <tr>
                                <th colspan="8">Total</th>
                                <th class="product_table">₹{{$OrderData->final_amount}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <h6 class="amount_content">Amount in Words:<br>
                        <span id="checks123" style="text-transform: capitalize;font-style: revert;"></span>
                    </h6><br>
                    <input type="hidden" value="{{$OrderData->final_amount}}" id="tot_amnt">
                    <div style="display: flex;justify-content: space-between;align-items: center;">
                        <div>
                            <h5>
                                Terms & Condition:
                            </h5>
                            <span>1) All subject to Jaipur Jurisdiction <br>2) No Return/Refund and Only Exchange<br>3) No Exchange after 7 days</span>
                        </div>
                        <div>
                            <h4><br><br>
                                Authorized Signatory </h4>
                            </tr>
                            <h5 class="warning">Whether tax is payable under reverse charge-No</h5>
                        </div>
                    </div>
                </div>
            </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        str += (n[5] != 0) ? ((str != '') ? 'And ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'Only ' : '';
        //return str;
        // alert(str);
        $("#checks123").text(str);
    }
</script>

</html>