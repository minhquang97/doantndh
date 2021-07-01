<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
        <span class="brand-text font-weight-light">Laptop 365</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <i class="far fa-user nav-icon"></i> 
                    {{ Auth::user()->username }} ({{ Auth::user()->role_id == 1 ? 'Admin' : 'User'}})
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin-index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Trang chủ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="cursor: pointer;">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Tài khoản
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-user-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                @if(Auth::user()->role_id == 1)
                                <p>Danh sách tài khoản</p>
                                @else
                                <p>Tài khoản của bạn</p>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-change-password') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đổi mật khẩu</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-product-list')}}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Danh sách sản phẩm
                        </p>
                    </a>
                </li>
                @if(Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a href="{{ route('admin-customer-list')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Danh sách khách hàng
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin-order-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Hóa đơn
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-coupon-list') }}" class="nav-link">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Mã giảm giá
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-make-appointment')}}" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Danh sách lịch hẹn
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
