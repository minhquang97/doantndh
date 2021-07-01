<header id="default_header" class="header_style_1">
  <!-- header top -->
  <div class="header_top">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="full">
            <div class="topbar-left">
              <ul class="list-inline">
                <li> <span class="topbar-label"><i class="fa  fa-home"></i></span> <span class="topbar-hightlight">68 Đỗ Ngọc Du, P. Thanh Trung, Thành phố Hải Dương, Hải Dương</span> </li>
                <li> <span class="topbar-label"><i class="fa fa-envelope-o"></i></span> <span class="topbar-hightlight"><a href="mailto:dinhquangminh26101997@gmail.com">dinhquangminh26101997@gmail.com</a></span> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4 right_section_header_top">
          <div class="float-left">
            <div class="social_icon">
              <ul class="list-inline">
                <li><a class="fa fa-facebook" href="https://www.facebook.com/" title="Facebook" target="_blank"></a></li>
                <li><a class="fa fa-google-plus" href="https://plus.google.com/" title="Google+" target="_blank"></a></li>
                <li><a class="fa fa-twitter" href="https://twitter.com" title="Twitter" target="_blank"></a></li>
                <li><a class="fa fa-linkedin" href="https://www.linkedin.com" title="LinkedIn" target="_blank"></a></li>
                <li><a class="fa fa-instagram" href="https://www.instagram.com" title="Instagram" target="_blank"></a></li>
              </ul>
            </div>
          </div>
          <div class="float-right">
            <div class="make_appo"> <a class="btn white_btn" href="{{ route('make-appointment') }}">Đặt lịch hẹn</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end header top -->
  <!-- header bottom -->
  <div class="header_bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
          <!-- logo start -->
          <div class="logo"> <a href="{{ route('index')}}"><img src="" alt="" /><h1>Laptop 365</h1></a> </div>
          <!-- logo end -->
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
          <!-- menu start -->
          <div class="menu_side">
            <div id="navbar_menu">
              <ul class="first-ul">
                <li> <a class="active" href="{{ route('index')}}">Trang chủ</a>
                  <!-- <ul>
                    <li><a href="it_home.html">It Home Page</a></li>
                    <li><a href="it_home_dark.html">It Dark Home Page</a></li>
                  </ul> -->
                </li>
                <li><a href="{{ route('about-us') }}">Giới thiệu</a></li>
                <li> <a href="#">Dịch vụ</a>
                  <ul>
                    <li><a href="{{ route('product-list')}}?type=1">Phục hồi dữ liệu</a></li>
                    <li><a href="{{ route('product-list')}}?type=2">Sửa máy tính</a></li>
                    <li><a href="{{ route('product-list')}}?type=3">Dịch vụ di động</a></li>
                    <li><a href="{{ route('product-list')}}?type=4">Giải pháp mạng</a></li>
                  </ul>
                </li>
               <!--  <li> <a href="#">Pages</a>
                  <ul>
                    <li><a href="it_career.html">Career</a></li>
                    <li><a href="it_price.html">Pricing</a></li>
                    <li><a href="it_faq.html">Faq</a></li>
                    <li><a href="it_privacy_policy.html">Privacy Policy</a></li>
                    <li><a href="it_error.html">Error 404</a></li>
                  </ul>
                </li> -->
                <li> <a href="{{ route('product-list')}} ">Sản phẩm</a>
                  <ul>
                    <li><a href="{{ route('product-list')}}?price=DESC">Theo giá tăng dần</a></li>
                    <li><a href="{{ route('product-list')}}?price=ASC">Theo giá tăng dần</a></li>
                    <!-- <li><a href="it_checkout.html">Checkout</a></li> -->
                  </ul>
                </li>
                <li> 
                  @if(Auth::guard('customer')->check())
                  <a href="{{ route('customer-info') }}"><i class="fa fa-user"></i> {{ Auth::guard('customer')->user()->name }}</a>
                  @else
                  <a href="{{ route('login') }}">Đăng nhập</a>
                  @endif
                  @if(Auth::guard('customer')->check())
                  <ul>
                    <li><a href="{{ route('shopping-cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                    <li><a href="{{ route('change-customer-password') }}"><i class="fa fa-user"></i> Đổi mật khẩu</a></li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                  </ul>
                  @endif
                </li>
              </ul>
            </div>
            <div class="search_icon">
              <ul>
                <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
          <!-- menu end -->
        </div>
      </div>
    </div>
  </div>
  <!-- header bottom end -->
</header>