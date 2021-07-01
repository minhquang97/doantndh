@extends('index')
@section('content')
<!-- end header -->
<!-- inner page banner -->
<div class="it_serv_shopping_cart shopping-cart">
	<div id="inner_banner" class="section inner_banner_section">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="full">
	                    <div class="title-holder">
	                        <div class="title-holder-cell text-left">
	                            <h1 class="page-title">Giỏ hàng</h1>
	                            <ol class="breadcrumb">
	                                <li><a href="index.html">Trang chủ</a></li>
	                                <li class="active">Giỏ hàng</li>
	                            </ol>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- end inner page banner -->
	<div class="section padding_layout_1 Shopping_cart_section">
	    <div class="container">
	        <div class="row">
	            <div class="col-sm-12 col-md-12">
	                <div class="product-table">
	                	@if(count($data))
	                    <table class="table">
	                        <thead>
	                            <tr>
	                                <th>Sản phẩm</th>
	                                <th>Số lượng</th>
	                                <th class="text-center">Giá</th>
	                                <th class="text-center">Tổng tiền</th>
	                                <th></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<form id="checkout-form" action="{{ route('p-checkout-cart') }}" method="post" enctype="multipart/form-data">
	                        	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	                        	@foreach($data as $key => $item)
	                            <tr>
	                                <td class="col-sm-8 col-md-6">
	                                    <div class="media">
	                                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{ asset('upload') }}/{{$item->infoProduct->image }}" alt="#" /></a>
	                                        <div class="media-body">
	                                            <h4 class="media-heading"><a href="#">{{ $item->infoProduct->name }}</a></h4>
	                                        </div>
	                                    </div>
	                                </td>
	                                <td class="col-sm-1 col-md-1" style="text-align: center;">
	                                	<input class="form-control" value="{{$item->quantity}}" type="number" />
	                                </td>
	                                <td class="col-sm-1 col-md-1 text-center"><p class="price_table">{{ number_format($item->price) }} VND</p></td>
	                                <td class="col-sm-1 col-md-1 text-center"><p class="price_table">{{ number_format($item->price * $item->quantity)  }} VND</p></td>
	                                <td class="col-sm-1 col-md-1">
	                                    <a type="button" href="{{ route('remove-cart', $item->id) }}" class="bt_main"><i class="fa fa-trash"></i> Bỏ</a>
	                                </td>
	                            </tr>
	                            <input type="hidden" name="products[{{ $key }} ][code]" value="{{ $item->infoProduct->code }}">
	                            <input type="hidden" name="products[{{ $key }} ][name]" value="{{ $item->infoProduct->name }}">
	                            <input type="hidden" name="products[{{ $key }} ][price]" value="{{ $item->price }}">
	                            <input type="hidden" name="products[{{ $key }} ][quantity]" value="{{ $item->quantity }}">
	                            <input type="hidden" name="coupon_id" value="{{ $coupon ? $coupon->id : 0 }}" />
	                            <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">
	                            @endforeach
	                            </form>
	                        </tbody>
	                    </table>
	                    
	                    <table class="table">
	                        <tbody>
	                            <tr class="cart-form">
	                                <td class="actions">
	                                    <div class="coupon">
	                                        <input name="coupon_code" class="input-text" id="coupon_code" placeholder="Thêm mã giảm giả" type="text" />
	                                        <button class="button" name="apply_coupon" id="add_code"/>Thêm mã</button>
	                                    </div>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    @else
	                    <table class="table">
	                        <tbody>
	                            <tr class="cart-form">
	                                <td class="actions">
	                                    <div class="coupon">
	                                        <div class="row text-center">Giỏ hàng bạn đang trống !! <a href="{{ route('index') }}"> Thêm sản phẩm ngay</a></div>
	                                    </div>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    @endif
	                </div>
	                @if(count($data))
	                <div class="shopping-cart-cart">
	                    <table>
	                        <tbody>
	                            <tr class="head-table">
	                                <td><h5>Hóa đơn mua hàng:</h5></td>
	                                <td class="text-right"></td>
	                            </tr>
	                            <tr>
	                                <td><h4>Tổng tiền</h4></td>
	                                <td class="text-right"><h4>{{ number_format($cart_total) }} VND</h4></td>
	                            </tr>
	                            <tr>
	                                <td><h5>Mã giảm giá <p style="color: red;">{{ $coupon ? '('.$coupon->coupon_code.")" : '' }}
	                                	@if($coupon)
	                                	<a href="{{ route('remove-coupon', $coupon->id) }}"><i class="fa fa-remove"></i></a>
	                                	@endif</p>
	                                </h5></td>
	                                <td class="text-right"><p>{{ $coupon ? '-'.number_format($coupon->value) : 0 }} VND</p></td>
	                            </tr>
	                            <tr>
	                                <td><h3>Thành tiền</h3></td>
	                                <td class="text-right"><h4>{{ number_format($cart_total - ($coupon ? $coupon->value : 0)) }} VND</h4></td>
	                            </tr>
	                            <tr>
	                                <td><a href="{{ route('product-list')}}" class="button" style="padding: 9px 16px; height:35px">Tiếp tục mua</a></td>
	                                <td><button class="button"style="height: 35px" id="send-checkout">Thanh toán</button></td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	                @endif
	            </div>
	        </div>
	    </div>
	</div>
</div>
<!-- End Model search bar -->
@section('script')
<script>
	$('#add_code').click(function(){
		let couponCode = $('#coupon_code').val();
		let customerId = $('#customer_id').val();
		$.ajax({
           type: "POST",
           url: `{{ route('add-coupon') }}`,
           dataType: "json",
           data: {code: couponCode, customer_id: customerId, _token: `{{ csrf_token() }}`},
           success: function (data) {
               alert(data.message)
               location.reload()
           },
       });
	})

	$('#send-checkout').click(function(){
		$('#checkout-form').submit();
	})
</script>
@endsection
@endsection
