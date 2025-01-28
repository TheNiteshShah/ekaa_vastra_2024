@extends('admin.base_template')
@section('title',$title)
@section('main')
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">View <b>{{$parentData->name}}</b> > {{$title}}</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{$type=='category'?route('category.index'):route('subcategory.index')}}">Back</a></li>
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
                                    <h4 class="mt-0 header-title">View <b>{{$parentData->name}}</b> > {{$title}} List</h4>
                                </div>
                                @if(session()->get('position') == "Super Admin" || session()->get('position') == "Admin")
                                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('products.create',[$type,$parent_id])}}" role="button" style="margin-left: 20px;"> Add {{$title}}</a></div>
                                @endif
                            </div>
                            <hr style="margin-bottom: 50px;background-color: darkgrey;">
                            <div class="table-rep-plugin">
                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                    <table id="userTable" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-priority="1">Name</th>
                                                <th data-priority="1">SKU</th>
                                                <th data-priority="1">MRP</th>
                                                <th data-priority="1">Price</th>
                                                <th data-priority="1">GST %</th>
                                                <th data-priority="1">GST</th>
                                                <th data-priority="1">Selling Price </th>
                                                <th data-priority="1">New</th>
                                                <th data-priority="1">Featured</th>
                                                <th data-priority="1">Image</th>
                                                <th data-priority="1">Label</th>
                                                <th data-priority="1">Sequence</th>
                                                <th data-priority="6">Status</th>
                                                <th data-priority="6">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($foreachData))
                                            @foreach($foreachData as $data)
                                            <tr>
                                                <th>{{$loop->iteration}}</th>
                                                <th>{{$data->name}}</th>
                                                <th>{{$data->sku}}</th>
                                                <th>₹{{$data->mrp}}</th>
                                                <th>₹{{$data->price}}</th>
                                                <th>{{$data->gst_percentage}}%</th>
                                                <th>₹{{$data->gst}}</th>
                                                <th>₹{{$data->selling_price}}</th>
                                                <th>{{$data->is_trending==1?'Yes':'No'}}</th>
                                                <th>{{$data->is_top==1?'Yes':'No'}}</th>
                                                <th>
                                                    @if (!empty($data->image))
                                                    <img src="{{asset($data->image)}}" alt="image" style="border:solid red 1px;padding: 5px;" height=50 width=80>
                                                    @endif

                                                </th>
                                                <th>{{$data->label}}</th>
                                                <th>{{$data->seq}}</th>
                                                @if($data->is_active == "1")
                                                <td>
                                                    <p class="label  status-active">Active</p>
                                                </td>
                                                @else
                                                <td>
                                                    <p class="label  status-inactive">Inactive</p>
                                                </td>
                                                @endif
                                                <td>
                                                    <div class="btn-group" id="btns{{$loop->iteration}}">
                                                        @if(session()->get('position') == "Super Admin" || session()->get('position') == "Admin")
                                                        @if($data->is_active == 0)
                                                        <a href="{{route('products.show',base64_encode($data->id))}}"><i class="fas fa-check success-icon" data-toggle="tooltip" data-placement="top" title="Active"></i></a>
                                                        @else
                                                        <a href="{{route('products.show',base64_encode($data->id))}}"><i class="fas fa-times danger-icon" data-toggle="tooltip" data-placement="top" title="Inactive"></i></a>
                                                        @endif
                                                        <a href="{{route('products.edit',base64_encode($data->id))}}"><i class="fas fa-pencil-alt info-icon" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                        @if(session()->get('position') == "Super Admin")
                                                        <a href="javascript:();" class="dCnf" mydata="{{$loop->iteration}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash danger-icon"></i></a>
                                                        @endif
                                                        @endif
                                                        <a href="{{route('types.index',base64_encode($data->id))}}"><i class="fa fa-arrow-right info-icon" data-toggle="tooltip" data-placement="top" title="Types"></i></a>
                                                    </div>
                                                    <div style="display:none" id="cnfbox{{$loop->iteration}}">
                                                        <p> Are you sure delete this </p>
                                                        <form method="post" action="{{ route('products.destroy', base64_encode($data->id)) }}" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </form>
                                                        <a href="javascript:();" class="cans btn btn-default" mydatas="{{$loop->iteration}}">No</a>

                                                    </div>
                                                </td>
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