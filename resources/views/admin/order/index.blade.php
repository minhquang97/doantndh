@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hóa đơn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Hóa đơn</li>
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
                            <h3 class="card-title">Danh sách sản phẩm</h3>
                            <!-- <div class="">
                                <a class="btn btn-success" href="{{ route('admin-product-create') }}">Tạo sản phẩm</a>
                            </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        	<p class="pull-left">Tìm thấy {{count($data)}} hóa đơn.</p>
                            <table id="example1" class="table table-bordered table-striped" style="font-size:15px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Tổng hóa đơn</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($data as $key => $item)
                                        <td style="font-size: 15px;">{{ $key + 1 }}</td>
                                        <td style="font-size: 15px;">{{ $item->hasCustomer['name'] }}</td>
                                        <td style="font-size: 15px;">{{ $item->hasCustomer['email'] }}</td>
                                        <td style="font-size: 15px;">{{ $item->hasCustomer['phone'] }}</td>
                                        <td style="font-size: 15px;">{{ number_format($item->total_price) }}  (VNĐ)</td>
                                        <td style="font-size: 15px;">
                                        	{{ $item->order_date }}
                                        </td>
                                        <td style="font-size: 15px;">
                                        	@if($item->status == 4)
	                                    	<span class="btn bg-danger  display-4" style="font-size: 13px;">Chờ xác nhận</span></button>
	                                    	@elseif($item->status == 3)
	                                    	<span  class="btn bg-warning display-4" style="font-size: 13px;">Đã xác nhận</span>
	                                    	@elseif($item->status == 2)
	                                    	<span  class="btn bg-primary display-4" style="font-size: 13px;">Đang xử lý</span>
	                                    	@elseif($item->status == 1)
	                                    	<span  class="btn bg-success display-4" style="font-size: 13px;">Thành công</span>
	                                    	@else
	                                    	<span  class="btn bg-secondary display-4" style="font-size: 13px;">Hủy</span>
	                                    	@endif
                                        </td>
                                        <td>
                                        	<a href="{{ route('admin-detail-order', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-search" title="Chi tiết đơn hàng"></i></a>
					                        <a href="{{ route('update-admin-order', $item->id) }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
					                        <a href="{{ route('delete-admin-order', $item->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Tổng hóa đơn</th>
                                        <th>Ngày đặt</th>
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
@endsection