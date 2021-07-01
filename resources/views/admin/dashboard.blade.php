@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Trang thống kê</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Trang thống kê</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ count($order) }}</h3>

                <p>Số đơn hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('admin-order-list') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $order_percent_success }}<sup style="font-size: 20px">%</sup></h3>

                <p>Tỉ lệ đơn hàng thành công</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('admin-order-list') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ count($make_appointment) }}</h3>

                <p>Tổng số đặt lịch</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('admin-make-appointment') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ count($products) }}</h3>

                <p>Tổng số sản phẩm</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('admin-product-list') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- TABLE: LATEST ORDERS -->
        <div class="row">
	        <div class="col-md-6">
	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Top hóa đơn thanh toán</h3>

	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                  <button type="button" class="btn btn-tool" data-card-widget="remove">
	                    <i class="fas fa-times"></i>
	                  </button>
	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body p-0">
	                <div class="table-responsive">
	                  <table class="table m-0">
	                    <thead>
	                    <tr>
	                      <th>Mã hóa đơn</th>
	                      <th>Tổng hóa đơn</th>
	                      <th>Trạng thái</th>
	                      <th>Ngày đặt</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($order->slice(0, 5) as $item)
	                    <tr title="
	                    @foreach(json_decode($item->order_detail) as $product)
	                    Mã sản phẩm: {{$product->code}} | Giá: {{$product->price}}| Số lượng: {{$product->quantity}}
	                    @endforeach
	                    ">
	                      <td><a href="{{ route('admin-detail-order', $item->id) }}">{{ $item->id }}</a></td>
	                      <td>{{ number_format($item->total_price) }} VNĐ</td>
	                      <td><span class="badge {{ $order_status_color[$item->status] }}">{{ $order_status[$item->status] }}</span></td>
	                      <td>
	                        <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $item->order_date }}</div>
	                      </td>
	                    </tr>
	                    @endforeach
	                    </tbody>
	                  </table>
	                </div>
	                <!-- /.table-responsive -->
	              </div>
	              <!-- /.card-body -->
	              <div class="card-footer clearfix">
	                <a href="{{ route('admin-order-list') }}" class="btn btn-sm btn-secondary float-right">Xem thêm</a>
	              </div>
	              <!-- /.card-footer -->
	            </div>
	        </div>

	         <div class="col-md-6">
	            <div class="card">
	              <div class="card-header border-transparent">
	                <h3 class="card-title">Top hóa đơn thanh toán thành công</h3>

	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                  <button type="button" class="btn btn-tool" data-card-widget="remove">
	                    <i class="fas fa-times"></i>
	                  </button>
	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body p-0">
	                <div class="table-responsive">
	                  <table class="table m-0">
	                    <thead>
	                    <tr>
	                      <th>Mã hóa đơn</th>
	                      <th>Tổng hóa đơn</th>
	                      <th>Trạng thái</th>
	                      <th>Ngày đặt</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($order_success->slice(0, 5) as $success)
	                    <tr title="
	                    @foreach(json_decode($success->order_detail) as $product)
	                    Mã sản phẩm: {{$product->code}} | Giá: {{$product->price}}| Số lượng: {{$product->quantity}}
	                    @endforeach
	                    ">
	                      <td ><a href="{{ route('admin-detail-order', $success->id) }}">{{ $success->id }}</a></td>
	                      <td >{{ number_format($success->total_price) }} VNĐ</td>
	                      <td><span class="badge {{ $order_status_color[$success->status] }}" >{{ $order_status[$success->status] }}</span></td>
	                      <td>
	                        <div class="sparkbar" data-color="#00a65a" data-height="20" >{{ $success->order_date }}</div>
	                      </td>
	                    </tr>
	                    @endforeach
	                    </tbody>
	                  </table>
	                </div>
	                <!-- /.table-responsive -->
	              </div>
	              <!-- /.card-body -->
	              <div class="card-footer clearfix">
	                <a href="{{ route('admin-order-list') }}" class="btn btn-sm btn-secondary float-right">Xem thêm</a>
	              </div>
	              <!-- /.card-footer -->
	            </div>
	        </div>
	        
        </div>
        <div class="row">
        	<div class="col-md-12">
	        	<div class="card">
	              <div class="card-header border-0">
	                <h3 class="card-title">Top sản phẩm giá cao</h3>
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                  <button type="button" class="btn btn-tool" data-card-widget="remove">
	                    <i class="fas fa-times"></i>
	                  </button>
	                </div>
	              </div>
	              <div class="card-body table-responsive p-0">
	                <table class="table table-striped table-valign-middle" style="font-size:15px">
	                  	<thead>
	                  	<tr>
	                    	<th>Mã sản phẩm</th>
	                    	<th>Tên sản phẩm</th>
	                    	<th>Giá</th>
	                    	<th>Chi tiết</th>
	                  	</tr>
	                  	</thead>
	                  	<tbody>
	                  	@foreach($products->slice(0, 5) as $product)
	                  	<tr>
	                    	<td>{{ $product->code }}</td>
	                    	<td style="white-space: nowrap; overflow: hidden; text-overflow: clip;">
	                      		<img src="{{ asset('upload') }}/{{ $product->image }}" alt="Product 1" class="img-circle img-size-32 mr-2">
	                      		{{ $product->name}}
	                    	</td>
	                    	<td>{{ number_format($product->cost_sale) }} VNĐ</td>
		                    <td>
		                      <a href="{{ route('product-detail', $product->id) }}" class="text-muted">
		                        <i class="fas fa-search"></i>
		                      </a>
		                    </td>
	                  </tr>
	                  @endforeach
	                  </tbody>
	                </table>
	              </div>
	              <div class="card-footer clearfix">
	                <a href="{{ route('admin-product-create') }}" class="btn btn-sm btn-info float-left">Tạo thêm</a>
	                <a href="{{ route('admin-product-list') }}" class="btn btn-sm btn-secondary float-right">Xem thêm</a>
	              </div>
	            </div>
	        </div>
        </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection