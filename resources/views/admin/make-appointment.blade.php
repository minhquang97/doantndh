@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lịch hẹn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Lịch hẹn</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="text-align: end;">
                            <h3 class="card-title">Danh sách lịch hẹn</h3>
                            <!-- <div class="">
                                <a class="btn btn-success" href="{{ route('admin-product-create') }}">Tạo sản phẩm</a>
                            </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        	<p class="pull-left">Tìm thấy {{count($data)}} hóa đơn.</p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Vấn đề</th>
                                        <th>Ngày đặt lịch</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->first_name.' '.$item->last_name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>{{ $item->created_date }}</td>
                                        <td id="status-{{ $item->id }}">
                                        	@if($item->status == 0)
	                                    	<span class="btn bg-danger display-4">Đặt lịch</span></button>
	                                    	@else
	                                    	<span  class="btn bg-success display-4">Đã liên hệ</span>
	                                    	@endif
                                        </td>
                                        <td>
                                        	<a href="{{ route('admin-make-appointment-detail', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-search" title="Chi tiết lịch hẹn"></i></a>
                                        	<input type="hidden" id="make-{{$item->id}}" value="{{ $item->id }}">
                                        	@if(!$item->creator_id)
					                        <span id="closed-{{ $item->id }}" class="btn btn-success btn-xs" onclick="closed(this)"><i class="fa fa-check"></i></span>
					                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Vấn đề</th>
                                        <th>Ngày đặt lịch</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@section('script')
<script>
	function closed(obj){
		let id = (obj.id).slice(7);
		$.ajax({
           	type: "POST",
           	url: `{{ route('admin-make-appointment-closed') }}`,
           	dataType: "json",
           	data: {id: id, _token: `{{ csrf_token() }}`},
           	success: function (data) {
	           	if (data.status) {
	           		$('#closed-'+id).remove();
	           		$('#status-'+id).children().remove();
	           		$('#status-'+id).append('<span  class="btn bg-success display-4">Đã liên hệ</span>');
	           	}
               	alert(data.message);
           	},
       	});
	}
</script>
@endsection
@endsection