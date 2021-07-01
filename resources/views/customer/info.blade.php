@extends('index')
@section('content')
<div class="section padding_layout_1 checkout_page">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <div class="text-center">
        <label><h3>Thông tin của bạn</h3></label>
      </div>
        <div class="checkout-form">
          <form action="{{ route('update-customer-info') }}" id="form-control" method="post">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <fieldset>
            <div class="row">
              <div class="col-md-6">
                <div class="form-field">
                  <label>Họ tên<span class="red">*</span></label>
                  <input name="name" type="text" value="{{ Auth::guard('customer')->user()->name }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label>Ngày sinh <span class="red">*</span></label>
                  <input name="date_of_birth" type="text" value="{{ Auth::guard('customer')->user()->date_of_birth }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label>Số điện thoại <span class="red">*</span></label>
                  <input name="phone" type="text" value="{{ Auth::guard('customer')->user()->phone }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label>Email <span class="red">*</span></label>
                  <input name="email" type="email" value="{{ Auth::guard('customer')->user()->email }}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-field inline-block">
                  <label>Giới tính<span class="red"></span></label>
                  <span class="d-flex">
                    Nam<input name="gender" type="radio" value="1" {{ Auth::guard('customer')->user()->gender == 1 ? 'checked' : '' }}>
                    Nữ<input name="gender" type="radio" value="0" {{ Auth::guard('customer')->user()->gender == 0 ? 'checked' : '' }}>
                </span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-field">
                  <label>Địa chỉ <span class="red">*</span></label>
                  <textarea name="address" placeholder="Địa chỉ cụ thể">{{ Auth::guard('customer')->user()->address }}</textarea>
                </div>
              </div>
            </div>
            <button class="button"style="height: 35px;background: #039ee3;color: #fff;padding: 0 5px;" id="send-checkout" type="submit">Cập nhật</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection