@extends('index')
@section('content')
<!-- section -->
<div class="section padding_layout_1 product_list_main">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
	    Tìm thấy {{ count($data )}} kết quả
        <div class="row pt-2">
          	@foreach($data as $item)
	        <div class="col-md-4 col-sm-6 col-xs-12 margin_bottom_30_all">
	            <div class="product_list" id="product_{{ $item->id }}">
	              <div class="product_img"> <a href="{{ route('product-detail', $item->id) }}"><img class="img-responsive" src="{{ asset('upload')}}/{{$item->image}}" alt="" width="270" height="226"> </a></div>
	              <div class="product_detail_btm">
	                <div class="center">
	                  <h4><a href="{{ route('product-detail', $item->id) }}">{{ $item->name }}</a></h4>
	                </div>
	                <div class="product_price">
	                  <p><span class="old_price">{{ number_format($item->cost_price) }}</span> – <span class="new_price">{{ number_format($item->cost_sale) }}</span></p>
	                </div>
	              </div>
	            </div>
	        </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-3">
        <div class="side_bar">
          <div class="side_bar_blog">
            <h4>SEARCH</h4>
            <form action="{{ route('product-list')}}" method="get">
	            <div class="side_bar_search">
	              <div class="input-group stylish-input-group">
	                <input class="form-control" placeholder="Search" type="text" name="search">
	                <span class="input-group-addon">
	                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
	                </span> </div>
	            </div>
            </form>
          </div>
          <div class="side_bar_blog">
            <h4>Lọc theo dịch vụ</h4>
            <div class="categary">
              <ul>
              	@foreach($data_type as $item)
                <li><a href="{{ route('product-list')}}?type={{ $item->id }}"><i class="fa fa-angle-right"></i>{{ $item->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="side_bar_blog">
            <h4>Sắp xếp theo giá bán</h4>
            <div class="categary">
              <ul>
                <li><a href="{{ route('product-list')}}?price=DESC"><i class="fa fa-angle-right"></i>Cao đến thấp</a></li>
                <li><a href="{{ route('product-list')}}?price=ASC"><i class="fa fa-angle-right"></i>Thấp đến cao</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end section -->
@endsection