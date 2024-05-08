@extends('admin.base_template')
@section('main')
<!-- Start content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">View Team</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Team</a></li>
            <li class="breadcrumb-item active">View Team</li>
          </ol>
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
                  <h4 class="mt-0 header-title">View Team List</h4>
                </div>
                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('add_team_view')}}" role="button" style="margin-left: 20px;"> Add Team</a></div>
              </div>
              <hr style="margin-bottom: 50px;background-color: darkgrey;">
              <div class="table-rep-plugin">
                <div class="table-responsive b-0" data-pattern="priority-columns">
                  <table id="userTable" class="table  table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th data-priority="1">Name</th>
                        <th data-priority="3">Email</th>
                        <th data-priority="1">Phone</th>
                        <th data-priority="3">Position</th>
                        <th data-priority="3">Permissions</th>
                        <th data-priority="6">Images</th>
                        <th data-priority="6">status</th>
                        <th data-priority="6">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($teamdetails))
                      @php $a = 0; @endphp
                      @foreach($teamdetails as $team)
                      @php $a++; @endphp
                      <tr>
                        <th>{{$a}}</th>
                        <td>{{ $team->name}}</td>
                        <td>{{ $team->email}}</td>
                        <td>{{ $team->phone}}</td>
                        @php $pow = $team->power; @endphp
                        @if($pow == "1")
                        <td>{{ 'Super Admin' }}</td>
                        @endif
                        @if($pow == "2")
                        <td>{{ 'Admin' }}</td>
                        @endif
                        @if($pow == "3")
                        <td>{{ 'Manager' }}</td>
                        @endif
                        <td>
                          <?php
                          $servicess = $team->services;
                          if ($servicess != "" && $servicess != null) {
                            $ser = json_decode($servicess);
                            // print_r($ser); die();
                            if ($ser[0] == "999") {
                              echo "All";
                            } else {
                              // $ser_count= count($ser);
                              foreach ($ser as $s) {
                                // for ($i=0; $i < $ser_count; $i++) {
                                // $side_srv_id= $ser[$i];
                                $sidebar_ser = App\Models\AdminSidebar::where('id', $s)->first();
                                if (!empty($sidebar_ser)) {
                                  echo $sidebar_ser->name;
                                  echo "<br />";
                                }
                              }
                            }
                          }
                          ?>
                        </td>
                        @if( $team->image != "" && $team->image!= null)
                        <td>
                          <img id="slide_img_path" height=100 width=200 src="{{asset($team->image)}}">
                        </td>
                        @else
                        <td>Sorry, No Image!</td>
                        @endif
                        <?php $activ = $team->is_active; ?>
                        @if($team->is_active == 1)
                        <td>
                          <p class="label pull-right status-active">Active</p>
                        </td>
                        @else
                        <td>
                          <p class="label pull-right status-inactive">InActive</p>
                        </td>
                        @endif
                        <td>
                          <div class="btn-group" id="btns<?php echo $a ?>">

                            @if ($team->is_active == 0)
                            <a href="{{route('UpdateTeamStatus',['active',base64_encode($team->id)])}}" data-toggle="tooltip" data-placement="top" title="Active"><i class="fas fa-check success-icon"></i></a>
                            @else
                            <a href="{{route('UpdateTeamStatus',['inactive',base64_encode($team->id)])}}" data-toggle="tooltip" data-placement="top" title="Inactive"><i class="fas fa-times danger-icon"></i></a>
                            @endif
                            <a href="javascript:();" class="dCnf" mydata="<?php echo $a ?>" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash danger-icon"></i></a>
                          </div>
                          <div style="display:none" id="cnfbox<?php echo $a ?>">
                            <p> Are you sure delete this </p>
                            <a href="{{route('deleteTeam',base64_encode($team->id))}}" class="btn btn-danger">Yes</a>
                            <a href="javascript:();" class="cans btn btn-default" mydatas="<?php echo $a ?>">No</a>
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