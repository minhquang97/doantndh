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
                            <h2 class="headline text-warning">404</h2>
                            <div class="error-content">
                                <h3><i class="fa fa-exclamation-triangle text-warning"></i> Ôi không! Không tìm thấy nội dung.</h3>
                                <p>Chúng tôi không thể tìm thấy trang bạn đang tìm kiếm. Trong khi đó, bạn có thể<a href="{{ route('index') }}"> Trở lại trang chủ</a></p>
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
