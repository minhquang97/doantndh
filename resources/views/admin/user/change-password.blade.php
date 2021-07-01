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
                            <h3 class="card-title">Đổi mật khẩu</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('post-admin-change-password') }}" method="post">
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card-body">
                            	@if(Auth::user()->role_id < 2)
                                <div class="form-group">
                                    <label for="name">Tên tài khoản</label>
                                    <select class="form-control" name="user_id">
                                        <option value="">Tên tài khoản</option>
                                        @foreach($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->username }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('username'))
                                        <p style="color: red;">{{ $errors->first('username') }}</p>
                                    @endif
                                </div>
                                @endif
                                @if(Auth::user()->role_id > 1)
                                <div class="form-group">
                                    <label for="name">Mật khẩu cũ</label>
                                    <input type="password" name="old_password" class="form-control" id="name" placeholder="Nhập mật khẩu cũ" />
                                    @if ($errors->has('old_password'))
                                        <p style="color: red;">{{ $errors->first('old_password') }}</p>
                                    @endif
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="name">Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control" id="name" placeholder="Nhập mật khẩu" />
                                    @if ($errors->has('new_password'))
                                        <p style="color: red;">{{ $errors->first('new_password') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Nhập lại mật khẩu</label>
                                    <input type="password" id="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" />
                                    @if ($errors->has('password_confirmation'))
                                        <p style="color: red; text-align: left; padding-left: 30px">{{ $errors->first('password_confirmation') }}</p>
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