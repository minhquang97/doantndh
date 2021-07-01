@extends('admin.index') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý tài khoản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý tài khoản</li>
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
                            <h3 class="card-title">Danh sách user</h3>
                            @if(Auth::user()->role_id < 2)
                            <div class="">
                                <a class="btn btn-success" href="{{ route('admin-user-create') }}">Thêm tài khoản</a>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        	<p class="pull-left">Tìm thấy {{count($data)}} tài khoản.</p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên tài khoản</th>
                                        <th>Email</th>
                                        <th>Phân quyền</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                        	{{ $item->role_id == 1 ? 'Admin' : 'User' }}
                                        </td>
                                        <td>{{ $item->status == 1 ? 'Kích hoạt' : 'Vô hiệu hóa' }}</td>
                                        <td>
                                        	<!-- <a href="" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i></a> -->
					                        <a href="{{ route('update-admin-user', $item->id )}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                            @if(Auth::user()->role_id < 2)
					                        <a href="{{ route('delete-admin-user', $item->id )}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên tài khoản</th>
                                        <th>Email</th>
                                        <th>Phân quyền</th>
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
