@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cập nhật hóa đơn</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('p-update-admin-order', $data->id) }}" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên khách hàng</label>
                                    <input type="text" name="name" class="form-control" id="name"  value="{{ $data->hasCustomer->name }}" disabled="disabled" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="email"  value="{{ $data->hasCustomer->email }}" disabled="disabled"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Giá bán" name="cost_sale" value="{{ $data->hasCustomer->phone }}" disabled="disabled"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tổng hóa đơn (VNĐ)</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Giá bán" name="unit" value="{{ $data->total_price }}" disabled="disabled"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày đặt</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Tiêu đề" name="title" value="{{ $data->order_date }}" disabled="disabled"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lưu ý</label>
                                    <textarea class="form-control" cols="20" rows="5" name="note" placeholder="Lưu ý từ khách hàng">{{ $data->note?? "" }}</textarea>
                                    @if ($errors->has('note'))
                                        <p style="color: red;">{{ $errors->first('note') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select class="form-control" name="status">
                                    	<option value="">Trạng thái đơn hàng</option>
                                    	@foreach($order_status as $key => $status)
                                    	<option value="{{ $key }}" {{ $data->status == $key ? 'selected' : '' }} >{{ $status }}</option>
                                    	@endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <p style="color: red;">{{ $errors->first('status') }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection