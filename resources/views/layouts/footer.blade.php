<footer class="footer_style_2">
  <div class="container-fuild">
    <div class="row">
      <div class="map_section">
        <div id="map"></div>
      </div>
      <div class="footer_blog">
        <div class="row">
          <div class="col-md-6">
            <div class="main-heading left_text">
              <h2>LIÊN KẾT BỔ SUNG</h2>
            </div>
            <ul class="footer-menu">
              <li><a href="{{ route('index') }}"><i class="fa fa-angle-right"></i> Trang chủ</a></li>
              <li><a href="{{ route('about-us') }}"><i class="fa fa-angle-right"></i> Giới thiệu</a></li>
              <li><a href="{{  route('make-appointment') }}"><i class="fa fa-angle-right"></i> Đặt lịch hẹn</a></li>
            </ul>
          </div>
          <div class="col-md-6">
            <div class="main-heading left_text">
              <h2>DỊCH VỤ</h2>
            </div>
            <ul class="footer-menu">
              <li><a href="{{ route('product-list')}}?type=1"><i class="fa fa-angle-right"></i> Phục hồi dữ liệu</a></li>
              <li><a href="{{ route('product-list')}}?type=2"><i class="fa fa-angle-right"></i> Sửa máy tính</a></li>
              <li><a href="{{ route('product-list')}}?type=3"><i class="fa fa-angle-right"></i> Dịch vụ di động</a></li>
              <li><a href="{{ route('product-list')}}?type=4"><i class="fa fa-angle-right"></i> Giải pháp mạng</a></li>
            </ul>
          </div>
          <div class="col-md-6">
            <div class="main-heading left_text">
              <h2>Liên hệ</h2>
            </div>
            <p>68 Đỗ Ngọc Du, P. Thanh Trung, Thành phố Hải Dương,<br>
               Hải Dương<br>
              <span style="font-size:18px;"><a href="tel:+9876543210">+84 332 123 xxx</a></span></p>
          </div>
          <div class="col-md-6">
            <div class="footer_mail-section">
              <form>
                <fieldset>
                <div class="field">
                  <input placeholder="Email" type="text">
                  <button class="button_custom"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="cprt">
        <p>Laptop365 © Bản quyền 2021 Thiết kế bởi Quang Minh</p>
      </div>
    </div>
  </div>
</footer>
