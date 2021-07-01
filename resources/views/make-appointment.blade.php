@extends('index')
@section('content')
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Đặt lịch hẹn</h1>
              <ol class="breadcrumb">
                <li><a href="index.html">Trang chủ</a></li>
                <li class="active">Đặt lịch hẹn</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<div class="section padding_layout_1">
  <div class="container">
    <div class="row">
      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12"></div>
      <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <div class="full">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="main_heading text_align_center">
                <h2>Điền thông tin của bạn</h2>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 appointment_form">
              <div class="form_section">
                <form class="form_contant" action="{{ route('make-appointment-send')}}" method="post">
                	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <fieldset class="row">
                  <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="field_custom" placeholder="Họ" type="text" name="first_name"  >
                    @if ($errors->has('first_name'))
                        <p style="color: red;">{{ $errors->first('first_name') }}</p>
                    @endif
                  </div>
                  <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="field_custom" placeholder="Tên" type="text" name="last_name"  >
                    @if ($errors->has('last_name'))
                        <p style="color: red;">{{ $errors->first('last_name') }}</p>
                    @endif
                  </div>
                  <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="field_custom" placeholder="Email" type="email" name="email"  >
                    @if ($errors->has('email'))
                        <p style="color: red;">{{ $errors->first('email') }}</p>
                    @endif
                  </div>
                  <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="field_custom" placeholder="Số điện thoại" type="text" name="phone"  >
                    @if ($errors->has('phone'))
                        <p style="color: red;">{{ $errors->first('phone') }}</p>
                    @endif
                  </div>
                  <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input class="field_custom" placeholder="Vấn đề" type="text" name="subject"  >
                    @if ($errors->has('subject'))
                        <p style="color: red;">{{ $errors->first('subject') }}</p>
                    @endif
                  </div>
                  <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <textarea class="field_custom" placeholder="Chi tiết" name="description"  ></textarea>
                    @if ($errors->has('description'))
                        <p style="color: red;">{{ $errors->first('description') }}</p>
                    @endif
                  </div>
                  <div class="center">
                    <button class="btn main_bt">Đặt lịch</button>
                  </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection