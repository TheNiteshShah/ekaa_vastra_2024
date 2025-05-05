@extends('admin.base_template')
@section('title',$title)
@section('main')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<style>
    .trending-box {
        background-color: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); */
    }

    .trending-box h5 {
        font-weight: 600;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid #eee;
        padding-bottom: 0.5rem;
    }

    .trending-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .trending-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        margin-bottom: 0.75rem;
        background-color: #f9f9f9;
        border-radius: 10px;
        transition: box-shadow 0.3s ease;
    }

    .trending-item:hover {
        background-color: #f1f1f1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .trending-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .trending-info img {
        border-radius: 8px;
        width: 60px;
        height: 60px;
        object-fit: cover;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
    }

    .trending-meta small {
        color: #666;
    }

    .trending-seq {
        background-color: #1976d2;
        color: #fff;
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
        font-weight: 500;
        font-size: 0.9rem;
        min-width: 80px;
        text-align: center;
    }

    .sortable-ghost {
        opacity: 0.4;
        background: #e0e0e0;
    }
</style>
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        @if(!empty($title))
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="state-information d-none d-sm-block">
                    </div>
                </div>
            </div>
        </div>
        @endif
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
                                    @if(!empty($parentData))
                                    <h4 class="mt-0 header-title">View <b>{{$parentData->name}}</b> > {{$title}} List</h4>
                                    @else
                                    <h4 class="mt-0 header-title">View {{$title}} List</h4>
                                    @endif
                                </div>
                                @if(session()->get('position') == "Super Admin" && !empty($parentData) || session()->get('position') == "Admin")
                                <div class="col-md-2"> <a class="btn btn-info cticket" href="{{route('products.create',[$type,$parent_id])}}" role="button" style="margin-left: 20px;"> Add {{$title}}</a></div>
                                @endif
                            </div>
                            <hr style="margin-bottom: 10px;background-color: darkgrey;">
                            <div class="trending-box">
                                <p class="text-muted mb-2">Drag and drop to reorder trending products</p>
                                <ul id="trendingProductList" class="trending-list">
                                    @foreach($foreachData as $product)
                                    <li class="trending-item" data-id="{{ $product->id }}">
                                        <div class="trending-info">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                            <div class="trending-meta">
                                                <strong>{{ $product->name }}</strong><br>
                                                <small>SKU: {{ $product->sku }}</small>
                                            </div>
                                        </div>
                                        <span class="trending-seq">Seq: <span class="seq">{{ $type==1?$product->seq: $product->trending_seq }}</span></span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="form-group">
                                <div class="w-100 text-center">
                                    <button style="margin-top: 10px;" id="saveSequence" class="btn btn-info"><i class="fa fa-save"></i> Submit</button>
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
<script>
    let orderedIds = [];

    const sortable = new Sortable(document.getElementById('trendingProductList'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function() {
            orderedIds = [];
            document.querySelectorAll('#trendingProductList li').forEach((li, index) => {
                orderedIds.push(li.dataset.id);
                // Optionally update visible Seq on the UI
                li.querySelector('.seq').innerText = index + 1;
            });
        }
    });

    document.getElementById('saveSequence').addEventListener('click', function() {
        if (orderedIds.length === 0) {
            alert("No changes made.");
            return;
        }

        $.ajax({
            url: '{{ route("products.updateProductSequence") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                order: orderedIds,
                type: "{{ $type }}",
            },
            success: function(res) {
                alert('Sequence updated successfully.');
                console.log(res);
            },
            error: function() {
                alert('Failed to update sequence.');
            }
        });
    });
</script>

<script>
    $(function() {
        // Enable drag-and-drop sorting
        $("#trendingProductList").sortable();

        // Save new sequence
        $("#saveSequence").click(function() {
            let order = [];
            $("#trendingProductList li").each(function(index) {
                order.push({
                    id: $(this).data("id"),
                    seq: index + 1
                });
                $(this).find(".seq").text(index + 1);
            });

            $.ajax({
                url: "{{ route('products.updateProductSequence') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order,
                    type: "{{$type}}",
                },
                success: function() {
                    alert('Product sequence updated.');
                },
                error: function() {
                    alert('Error saving sequence.');
                }
            });
        });
    });
</script>

@endsection