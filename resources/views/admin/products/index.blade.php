@extends('admin.index') 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
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
                            <div class="">
                                <a class="btn btn-success" href="{{ route('admin-product-create') }}">Tạo sản phẩm</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        	<p class="pull-left">Tìm thấy {{count($data)}} sản phẩm.</p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Ảnh minh họa</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->hasType ? $item->hasType['name'] : ''  }}</td>
                                        <td>
                                        	<img src="{{asset('upload')}}/{{ $item->image ? $item->image : 'default-product.jpg' }}" alt="" width="50" height="50">
                                        </td>
                                        <td>{{ $item->status ? 'Kích hoạt' : 'Vô hiệu hóa' }}</td>
                                        <td>
                                        	<a href="{{ route('product-detail', $item->id )}}" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
					                        <a href="{{ route('update-admin-product', $item->id )}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
					                        <a href="{{ route('delete-admin-product', $item->id )}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Ảnh minh họa</th>
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
