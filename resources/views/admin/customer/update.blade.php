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
                            <h3 class="card-title">Quản lý khách hàng</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('p-update-admin-customer', $data->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên khách hàng</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên sản phẩm" value="{{ $data->name }}" />
                                    @if ($errors->has('name'))
                                        <p style="color: red;">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Ngày sinh</label>
                                    <input type="date" class="form-control" name="date_of_birth" value="{{ $data->date_of_birth }}" />
                                    @if ($errors->has('date_of_birth'))
                                        <p style="color: red;">{{ $errors->first('date_of_birth') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email"value="{{ $data->email }}" />
                                    @if ($errors->has('email'))
                                        <p style="color: red;">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="phone"value="{{ $data->phone }}" />
                                    @if ($errors->has('phone'))
                                        <p style="color: red;">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Địa chỉ" name="address" value="{{ $data->address }}" />
                                    @if ($errors->has('address'))
                                        <p style="color: red;">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giới tính</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Chọn giới tính</option>
                                        <option value="1" {{ $data->gender == 1 ? 'selected' : '' }}>Nam</option>
                                        <option value="0" {{ $data->gender == 0 ? 'selected' : '' }}>Nữ</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <p style="color: red;">{{ $errors->first('gender') }}</p>
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