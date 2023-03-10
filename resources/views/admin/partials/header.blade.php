<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="#"><img src="{{ asset('admin/img/logo.png') }}" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('admin/img/menu-icon/dashboard.svg') }}" alt="">
                </div>
                <span>Dashboard</span>
            </a>
            <ul>
                <li><a href="#">Marketing</a></li>
                <li><a href="#">Default</a></li>
            </ul>
        </li>
        <li class="">
            <a class="" href="{{ asset('admin/hoa-don') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('admin/img/menu-icon/10.svg') }}" alt="">
                </div>
                <span>Danh sách hóa đơn</span>
            </a>
        </li>
        <li class="">
            <a class="" href="{{ asset('admin/hoa-don/create') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('admin/img/menu-icon/10.svg') }}" alt="">
                </div>
                <span>Thêm hóa đơn</span>
            </a>
        </li>
        <li class="">
            <a class="" href="{{ asset('admin/hoa-don/createNhapHang') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('admin/img/menu-icon/10.svg') }}" alt="">
                </div>
                <span>Nhập hàng</span>
            </a>
        </li>
        <li class="">
            <a class="" href="{{ asset('admin/hoa-don/indexNhapHang') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('admin/img/menu-icon/10.svg') }}" alt="">
                </div>
                <span>Danh sách nhập hàng</span>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('admin/img/menu-icon/2.svg') }}" alt="">
                </div>
                <span>Nhập một lần rồi thôi</span>
            </a>
            <ul>
                <li><a href="{{ asset('admin/loai-hang-hoa') }}">Loại hàng hóa</a></li>
                <li><a href="{{ asset('admin/hang-hoa') }}">Hàng hóa</a></li>
                <li><a href="{{ asset('admin/nha-cung-cap') }}">Nhà cung cấp</a></li>
                <li><a href="{{ asset('admin/cong-no-dai-ly') }}">Công nợ đại lý</a></li>
                <li><a href="{{ asset('admin/khach-hang') }}">Khách hàng</a></li>
                <li><a href="{{ asset('admin/cong-no') }}">Công nợ khách hàng</a></li>
            </ul>
        </li>
    </ul>
</nav>
