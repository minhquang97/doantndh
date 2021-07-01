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
                            <h3 class="card-title">Quản lý tài khoản</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('p-admin-user') }}" method="post">
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên tài khoản</label>
                                    <input type="text" name="username" class="form-control" id="name" placeholder="Nhập tên tài khoản" />
                                    @if ($errors->has('username'))
                                        <p style="color: red;">{{ $errors->first('username') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" name="email" class="form-control" id="name" placeholder="Nhập địa chỉ email" />
                                    @if ($errors->has('email'))
                                        <p style="color: red;">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quyền</label>
                                    <select class="form-control" name="role_id">
                                        <option value="">Phân quyền tài khoản</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <p style="color: red;">{{ $errors->first('role_id') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" id="name" placeholder="Nhập mật khẩu" />
                                    @if ($errors->has('password'))
                                        <p style="color: red;">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Nhập lại mật khẩu</label>
                                    <input type="password" id="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" />
                                    @if ($errors->has('password_confirmation'))
                                        <p style="color: red; text-align: left; padding-left: 30px">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select class="form-control" name="status">
                                        <option value="">Trạng thái tài khoản</option>
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Chưa kích hoạt</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <p style="color: red;">{{ $errors->first('status') }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
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