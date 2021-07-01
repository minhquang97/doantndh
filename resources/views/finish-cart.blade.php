@extends('index')
@section('content')
<div class="section padding_layout_1 product_detail">
    <div class="container">
        <div class="col-md-9">
            <div class="row">
                <div class="content-wrapper">
                    <!-- Main content -->
                    <section class="content">
                        <div class="error-page">
                            <h2 class="headline text-warning"></h2>
                            <div class="error-content">
                            	@if (\Session::has('success'))
						        <h3><i class="fa fa-check text-success"></i>Đặt hàng thành công!</h3>
                                <p>Chúng tôi sẽ xác nhận lại đơn hàng và liên hệ lại với bạn sớm nhất. Trong khi đó, bạn có thể<a href="{{ route('index') }}"> Trở lại trang chủ</a></p>
						        @endif
						        @if (\Session::has('fail'))
						        <h3><i class="fa fa-exclamation-triangle text-warning"></i>Đặt hàng thất bại!</h3>
                                <p>Có phát sinh lỗi, bạn vui lòng đặt hàng lại. <a href="{{ route('index') }}"> Trở lại trang chủ</a></p>
						        @endif
                            </div>
                            <!-- /.error-content -->
                        </div>
                        <!-- /.error-page -->
                    </section>
                    <!-- /.content -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection