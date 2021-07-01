@extends('admin.index') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mã giảm giá</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Mã giảm giá</li>
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
                            <h3 class="card-title">Danh sách mã giảm giá</h3>
                            <div class="">
                                <a class="btn btn-success" href="{{ route('admin-coupon-create') }}">Thêm mã giảm giá</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        	<p class="pull-left">Tìm thấy {{count($data)}} mã.</p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã</th>
                                        <th>Giá trị</th>
                                        <th>Người sử dụng</th>
                                        <th>Hết hạn</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->coupon_code }}</td>
                                        <td>{{ number_format($item->value) }} VNĐ</td>
                                        <td>{{ $item->customer ? $item->customer->name : '' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->date_of_birth)) }}</td>
                                        <td>{{ $status_coupon[$item->status] }}</td>
                                        <td>
                                            @if(Auth::user()->role_id == 1)
                                        	<!-- <a href="" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a> -->
					                        <a href="{{ route('update-admin-coupon', $item->id )}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
					                        <a href="{{ route('delete-admin-coupon', $item->id )}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></a>
                                            @else
                                            <i style="font-size:15px; color: gray;">Hành động không khả dụng</i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã</th>
                                        <th>Giá trị</th>
                                        <th>Người sử dụng</th>
                                        <th>Hết hạn</th>
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
