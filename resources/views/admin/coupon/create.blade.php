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
                            <h3 class="card-title">Thêm mã giảm giá</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('p-admin-coupon') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Mã </label><span class="text-danger"><i> (Để trống sẽ sử dụng mã mặc định của hệ thống)</i></span>
                                    <input type="text" name="coupon_code" class="form-control" id="name" placeholder="Nhập tên mã"/>
                                    @if ($errors->has('coupon_code'))
                                        <p style="color: red;">{{ $errors->first('coupon_code') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Giá trị (VNĐ)</label>
                                    <input type="text" class="form-control" name="value" placeholder="Nhập địa giá trị" />
                                    @if ($errors->has('value'))
                                        <p style="color: red;">{{ $errors->first('value') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Hạn sử dụng</label>
                                    <input type="date" class="form-control" name="expire" />
                                    @if ($errors->has('expire'))
                                        <p style="color: red;">{{ $errors->first('expire') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select class="form-control" name="status">
                                        <option value="1" selected>Chưa sử dụng</option>
                                        <option value="0">Đã sử dụng</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <p style="color: red;">{{ $errors->first('status') }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Thêm</button>
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