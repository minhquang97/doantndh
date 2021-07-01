<div class="section padding_layout_1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="main_heading text_align_center">
                        <h2>Sản phẩm nổi bật</h2>
                        <p class="large">Chúng tôi đóng gói các sản phẩm với dịch vụ tốt nhất để làm cho bạn một khách hàng hài lòng.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $item)
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                <div class="product_list">
                    <div class="product_img"><img class="img-responsive" src="{{ asset('upload')}}/{{$item->image}}" alt="" width="270" height="226" /></div>
                    <div class="product_detail_btm">
                        <div class="center">
                            <h4><a href="{{ route('product-detail', $item->id )}}">{{$item->name}}</a></h4>
                        </div>
                        <div class="product_price">
                            <p><span class="old_price">{{number_format($item->cost_sale)}}</span> – <span class="new_price">{{ number_format($item->cost_price) }} </span>VND</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="text-center">{{$products->links()}}</div>
        </div>
        <div class="row float-right">
            <div style="text-align: end;"><a href="{{ route('product-list') }}">>> Xem thêm sản phẩm</a></div>
        </div>
    </div>
</div>
