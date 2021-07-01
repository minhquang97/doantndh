@extends('index')
@section('content')
<div class="section padding_layout_1 product_detail">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="product_detail_feature_img hizoom hi2">
              <div class='hizoom hi2'> <img src="{{ asset('upload')}}/{{$data->image}}" alt="#" width="300" /> </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-12 product_detail_side detail_style1">
            <div class="product-heading">
              <h2>{{ $data->name }}</h2>
            </div>
            <div class="product-detail-side"> <span><del>{{ number_format($data->cost_sale) }}</del></span><span class="new-price">{{ number_format($data->cost_price) }} VND</span></div>
            <div class="detail-contant">
              <p>{{ $data->title }}</p>
              <form class="cart" method="post" action="{{ route('post-add-cart') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="quantity">
                  <input name="quantity" value="1" class="input-text qty text" type="number">
                  <input name="price" class="input-text qty text" type="hidden" value="{{$data->cost_price}}">
                  <input name="product_id" class="input-text qty text" type="hidden" value="{{$data->id}}">
                </div>
                <button type="submit" class="btn sqaure_bt">Thêm vào giỏ hàng</button>
              </form>
            </div>
            <div class="share-post"> <a href="#" class="share-text">Chia sẻ</a>
              <ul class="social_icons">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="full">
              <div class="tab_bar_section">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#description">Mô tả</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="description" class="tab-pane active">
                    <div class="product_desc">
                  		<p><b>{{ $data->title }}</b><br>
                      	{{ $data->description }}.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="full">
              <div class="main_heading text_align_left" style="margin-bottom: 35px;">
                <h3>Sản phẩm liên quan</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
        	@foreach($data_related as $item)
          	<div class="col-md-4 col-sm-6 col-xs-12 margin_bottom_30_all">
            	<div class="product_list">
              <div class="product_img"> <img class="img-responsive" src="{{ asset('upload')}}/{{$item->image}}" alt="" width="270" height="226"> </div>
              <div class="product_detail_btm">
                <div class="center">
                  <h4><a href="{{ route('product-detail', $item->id)}}">{{ $item->name }}</a></h4>
                </div>
                <div class="product_price">
                  <p><span class="old_price">{{ number_format($item->cost_sale) }}</span> – <span class="new_price">{{ number_format($item->cost_price) }}</span></p>
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
            <h4>Xem sản phẩm theo danh mục</h4>
            <div class="categary">
              <ul>
              	@foreach($data_type as $item)
                <li><a href="{{ route('product-list')}}?type={{ $item->id }}"><i class="fa fa-angle-right"></i>{{ $item->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="side_bar_blog">
            <h4>Xem sắp xếp theo giá bán</h4>
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
@endsection