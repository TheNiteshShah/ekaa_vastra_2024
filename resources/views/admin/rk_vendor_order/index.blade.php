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
                        <li class="breadcrumb-item"><a href="{{route('rk_vendor.index')}}">Back</a></li>
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
                                <div class="col-md-9">
                                    <h4 class="mt-0 header-title">View {{$title}} List</h4>
                                </div>
                                @if(session()->get('position') == "Super Admin" || session()->get('position') == "Admin")
                                <div class="col-md-3"> <a class="btn btn-info cticket" href="{{route('rk-vendor-order.create',base64_encode($parent_id))}}" role="button" style="margin-left: 20px;"> Add {{$title}}</a></div>
                                @endif
                            </div>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <div class="table-rep-plugin">
                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                    <table id="userTable" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-priority="1">Invoice No.</th>
                                                <th data-priority="1">Invoice Date</th>
                                                <th data-priority="1">SubTotal</th>
                                                <th data-priority="6">GST</th>
                                                <th data-priority="6">Total</th>
                                                @if(session()->get('position') == "Super Admin" || session()->get('position') == "Admin")
                                                <th data-priority="6">Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($foreachData))
                                            @foreach($foreachData as $data)
                                            <tr>
                                                <th>{{$loop->iteration}}</th>
                                                <th>{{$data->invoice_no}}</th>
                                                <th>{{$data->invoice_date}}</th>
                                                <th>₹{{$data->sub_total}}</th>
                                                <th>₹{{$data->gst_amount}}</th>
                                                <th>₹{{$data->total_amount}}</th>
                                                @if(session()->get('position') == "Super Admin" || session()->get('position') == "Admin")
                                                <td>
                                                    <div class="btn-group" id="btns{{$loop->iteration}}">
                                                        <!-- <a href="{{route('rk-vendor-order.edit',base64_encode($data->id))}}"><i class="fas fa-pencil-alt info-icon" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> -->
                                                        <a href="{{route('rk-vendor-order.print',base64_encode($data->id))}}"><i class="fas fa-eye info-icon" data-toggle="tooltip" data-placement="top" title="Print"></i></a>
                                                        <!-- @if(session()->get('position') == "Super Admin")
                                                        <a href="javascript:();" class="dCnf" mydata="{{$loop->iteration}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash danger-icon"></i></a>
                                                        @endif -->
                                                    </div>
                                                    <div style="display:none" id="cnfbox{{$loop->iteration}}">
                                                        <p> Are you sure delete this </p>
                                                        <form method="post" action="{{ route('rk_vendor.destroy', base64_encode($data->id)) }}" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </form>
                                                        <a href="javascript:();" class="cans btn btn-default" mydatas="{{$loop->iteration}}">No</a>

                                                    </div>
                                                </td>
                                                @endif
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#userTable').DataTable({
            responsive: true,
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