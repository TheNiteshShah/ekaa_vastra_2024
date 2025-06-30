@extends('admin.base_template')
@section('title', $title)
@section('main')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">View {{ $title }}</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('rk_vendor.index') }}">Back</a></li>
                            <li class="breadcrumb-item active">View {{ $title }}</li>
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
                                        <h4 class="mt-0 header-title">View {{ $title }} List</h4>
                                    </div>
                                    @if (session()->get('position') == 'Super Admin' || session()->get('position') == 'Admin')
                                        <div class="col-md-2"> <a class="btn btn-info cticket"
                                                href="{{ route('rk-vendor-order.create', base64_encode($parent_id)) }}"
                                                role="button" style="margin-left: 20px;">Create New Invoice</a></div>
                                    @endif
                                </div>
                                <div class="accordion mb-4 mt-3" id="exportAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="exportHeading">
                                            <button class="accordion-button collapsed fw-bold py-2 px-3" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#exportCollapse"
                                                aria-expanded="false" aria-controls="exportCollapse"
                                                style="font-size: 0.95rem;">
                                                📁 Export Sales Register to Excel
                                            </button>
                                        </h2>

                                        <div id="exportCollapse" class="accordion-collapse collapse"
                                            aria-labelledby="exportHeading" data-bs-parent="#exportAccordion">
                                            <div class="accordion-body bg-light border rounded">
                                                <form action="{{ route('rk-vendor-order.export') }}" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">

                                                    <div class="row g-3 align-items-end">
                                                        <div class="col-md-4">
                                                            <label for="start_date" class="form-label fw-semibold">Start
                                                                Date:</label>
                                                            <input type="date" id="start_date" name="start_date"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="end_date" class="form-label fw-semibold">End
                                                                Date:</label>
                                                            <input type="date" id="end_date" name="end_date"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="col-md-3 d-grid">
                                                            <button type="submit" class="btn btn-info">
                                                                <i class="fas fa-file-excel me-2"></i> Export to Excel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <hr style="margin-bottom: 50px;background-color: darkgrey;">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive b-0" data-pattern="priority-columns">
                                        <table id="userTable" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @if (session()->get('position') == 'Super Admin' || session()->get('position') == 'Admin')
                                                        <th data-priority="6">Action</th>
                                                    @endif
                                                    <th data-priority="1">Invoice No.</th>
                                                    <th data-priority="1">Invoice Date</th>
                                                    <th data-priority="1">SubTotal</th>
                                                    <th data-priority="6">GST</th>
                                                    <th data-priority="6">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($foreachData))
                                                    @foreach ($foreachData as $data)
                                                        @php
                                                            $date = \Carbon\Carbon::parse($data->invoice_date);
                                                            $no = $data->invoice_no;

                                                            if ($date->month >= 4) {
                                                                $fy = $date->year . '-' . substr($date->year + 1, -2);
                                                            } else {
                                                                $fy = $date->year - 1 . '-' . substr($date->year, -2);
                                                            }
                                                        @endphp

                                                        <tr>
                                                            <th>{{ $loop->iteration }}</th>
                                                            @if (session()->get('position') == 'Super Admin' || session()->get('position') == 'Admin')
                                                                <td>
                                                                    <div class="btn-group" id="btns{{ $loop->iteration }}">
                                                                        <a
                                                                            href="{{ route('rk-vendor-order.edit', base64_encode($data->id)) }}"><i
                                                                                class="fas fa-pencil-alt info-icon"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Edit"></i></a>
                                                                        <a
                                                                            href="{{ route('rk-vendor-order.print', base64_encode($data->id)) }}"><i
                                                                                class="fas fa-print danger-icon"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Print"></i></a>
                                                                        <!-- @if (session()->get('position') == 'Super Admin')
    <a href="javascript:();" class="dCnf" mydata="{{ $loop->iteration }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash danger-icon"></i></a>
    @endif -->
                                                                    </div>
                                                                    <div style="display:none"
                                                                        id="cnfbox{{ $loop->iteration }}">
                                                                        <p> Are you sure delete this </p>
                                                                        <form method="post"
                                                                            action="{{ route('rk_vendor.destroy', base64_encode($data->id)) }}"
                                                                            style="display:inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Yes</button>
                                                                        </form>
                                                                        <a href="javascript:();"
                                                                            class="cans btn btn-default"
                                                                            mydatas="{{ $loop->iteration }}">No</a>

                                                                    </div>
                                                                </td>
                                                            @endif
                                                            <th>{{ $fy }}/{{ $no }}/GST</th>
                                                            <th>{{ $data->invoice_date }}</th>
                                                            <th>₹{{ $data->sub_total }}</th>
                                                            <th>₹{{ $data->gst_amount }}</th>
                                                            <th>₹{{ $data->total_amount }}</th>

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
