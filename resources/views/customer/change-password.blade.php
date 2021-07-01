@extends('index')
@section('content')
<div class="section padding_layout_1 checkout_page">
  <div class="container pl-5 pr-5">
    <div class="row">
      <div class="col-md-12">
      	<div class="text-center">
        	<label><h3>Thay đổi mật khẩu</h3></label>
      	</div>
        <div class="checkout-form">
          <form action="{{ route('p-change-customer-password') }}" id="form-control" method="post">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <fieldset>
	            <div class="row">
	              	<div class="col-md-12">
		                <div class="form-field">
		                  	<label>Mật khẩu cũ<span class="red">*</span></label>
		                  	<input name="old_password" type="password">
		                  	@if ($errors->has('old_password'))
                                <p style="color: red;">{{ $errors->first('old_password') }}</p>
                            @endif
		                </div>
	              	</div>
	              	<div class="col-md-12">
		                <div class="form-field">
		                  	<label>Mật khẩu mới<span class="red">*</span></label>
		                  	<input name="new_password" type="password">
		                  	@if ($errors->has('new_password'))
                                <p style="color: red;">{{ $errors->first('new_password') }}</p>
                            @endif
		                </div>
	              	</div>
	              	<div class="col-md-12">
		                <div class="form-field">
		                  	<label>Nhập lại mật khẩu <span class="red">*</span></label>
		                  	<input name="confirm_password" type="password">
		                  	@if ($errors->has('confirm_password'))
                                <p style="color: red;">{{ $errors->first('confirm_password') }}</p>
                            @endif
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