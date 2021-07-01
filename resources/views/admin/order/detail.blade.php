@extends('admin.index')
@section('content')
<div class="content-wrapper">
	<section class="content pt-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if($data->note)
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Lưu ý từ khách hàng :</h5>
              <b>#</b> {{ $data->note }}
            </div>
            @endif
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-user"></i> {{ $data->hasCustomer->name }}
                    <small class="float-right">{{ $data->order_date }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">
                  <strong>Liên hệ</strong>
                  <address>
                    <br>
                    <div class="row pl-2">
                    	Địa chỉ: {{ $data->address }}
                    </div>
                    Số điện thoại: {{ $data->hasCustomer->phone }}<br>
                    Email: {{ $data->hasCustomer->email }}
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b>Hóa đơn #{{ $data->id }}</b><br>
                  <br>
                  <b>Mã giảm giá:</b> {{ $data->coupon ? $data->coupon->coupon_code : '(Không sử dụng)' }} <span class="text-danger">{{ $data->coupon ? '('.number_format($data->coupon->value).'VNĐ)' : '' }}</span><br>
                  <b>Tổng thanh toán:</b> {{ number_format($data->total_price) }} VNĐ<br>
                  <b>Trạng thái:</b> {{ $order_status[$data->status] }}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Mã sản phẩm</th>
                      <th>Tên sản phẩm</th>
                      <th>Giá</th>
                      <th>Số lượng</th>
                      <th>Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(json_decode($data->order_detail) as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item->code }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ number_format($item->price) }} VNĐ</td>
                      <td>{{ $item->quantity }}</td>
                      <td>{{ number_format($item->price * $item->quantity) }} VNĐ</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection