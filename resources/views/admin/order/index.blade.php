@extends('admin.base_template')
@section('title',$title)
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">View {{$title}}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{$title}}</a></li>
                        <li class="breadcrumb-item active">View {{$title}}</li>
                    </ol>
                    <div class="state-information d-none d-sm-block">
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
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
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="mt-0 header-title">View {{$title}} List</h4>
                                </div>
                            </div>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <div class="table-rep-plugin">
                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                    <table id="userTable" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-priority="1">Order Id</th>
                                                <th data-priority="1">User Info</th>
                                                <th data-priority="1">User Address</th>
                                                <th data-priority="1">Amount</th>
                                                <th data-priority="1">Payment Mode</th>
                                                <th data-priority="1">Products</th>
                                                <th data-priority="1">Date</th>
                                                <th data-priority="1">Tracking Url</th>
                                                <th data-priority="1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($foreachData))
                                            @foreach($foreachData as $data)
                                            @php
                                            $order2Data = App\Models\Order2Modal::where('main_id', $data->id)->with('product')->get();
                                            $order_details='';
                                            foreach($order2Data as $order2){
                                            $order_details = $order_details.$order2->product->name." x " . $order2->quantity.", ";
                                            }
                                            @endphp
                                            <tr>
                                                <th>{{$loop->iteration}}</th>
                                                <th>#{{$data->id}}</th>
                                                <th>{{$data->address->first_name}} {{$data->address->last_name}} - {{$data->address->phone}}</th>
                                                <th>{{$data->address->address}} - {{$data->address->pincode}}</th>
                                                <th>₹{{$data->final_amount}}</th>
                                                <th>{{$data->payment_mode==1?"COD":"Online"}}</th>
                                                <th>{{$order_details}}</th>
                                                <th>{{$data->created_at->format('Y-m-d H:i:s')}}</th>
                                                <th><a href="{{$data->tracking_url}}" target="_blank" rel="noopener noreferrer">{{$data->tracking_url}}</a></th>
                                                <th>
                                                    @if(session()->get('position') == "Super Admin" || session()->get('position') == "Admin")
                                                    <!---------- New Order-------- -->
                                                    @if($data->order_status==1)
                                                    <a href="{{route('update-order-status',['accept',base64_encode($data->id)])}}" data-toggle="tooltip" data-placement="top" title="Accept Order"><i class="fas fa-check success-icon"></i></a>
                                                    <a href="{{route('update-order-status',['reject',base64_encode($data->id)])}}" data-toggle="tooltip" data-placement="top" title="Reject Order"><i class="fas fa-times danger-icon"></i></a>
                                                    <!---------- Accepted Order-------- -->
                                                    @elseif($data->order_status==2)
                                                    <a href="{{route('update-track',base64_encode($data->id))}}"><i class="fa fa-truck info2-icon" data-toggle="tooltip" data-placement="top" title="Dispatch Order"></i></a>
                                                    <!---------- Dispatched Order -------- -->
                                                    @elseif($data->order_status==3)
                                                    <a href="{{route('update-order-status',['deliver',base64_encode($data->id)])}}"><i class="fas fa-check success-icon" data-toggle="tooltip" data-placement="top" title="Deliever Order"></i></a>
                                                    @endif
                                                    @endif
                                                    <a href="{{route('order-details',base64_encode($data->id))}}" data-toggle="tooltip" data-placement="top" title="Order Details"><i class="fas fa-eye  info-icon"></i></a>
                                                    @if($data->order_status > 0 && $data->order_status <= 4) <a href="{{route('order-invoice',base64_encode($data->id))}}" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="top" title="Invoice"><i class="fas fa-receipt  info2-icon"></i></a>
                                                        @endif
                                                </th>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- end page content-->
    </div> <!-- container-fluid -->
</div> <!-- content -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons JavaScript -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#userTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
        $(document.body).on('click', '.dCnf', function() {
            var i = $(this).attr("mydata");
            console.log(i);
            $("#btns" + i).hide();
            $("#cnfbox" + i).show();
        });
        $(document.body).on('click', '.cans', function() {
            var i = $(this).attr("mydatas");
            console.log(i);
            $("#btns" + i).show();
            $("#cnfbox" + i).hide();
        })
    });
</script>
@endsection