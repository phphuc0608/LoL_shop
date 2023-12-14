<div class="container-fluid d-flex align-items-center justify-content-between px-5 py-4" id="header_home">
    <div id="header_left">
        <img src="{{asset('img/logoRiot.png')}}" id="logo_home">
    </div>
    <div id="header_center">
        <a class="nav_item px-3 py-2" href="{{route('home_ds_tuong')}}">DANH SÁCH TƯỚNG</a>
        <a class="nav_item px-3 py-2" href="{{route('home_mua_trang_phuc')}}">MUA TRANG PHỤC</a>
        <a class="nav_item px-3 py-2" href="{{route('home_mua_bau_vat')}}">MUA BÁU VẬT</a>
        <a class="nav_item px-3 py-2" href="{{route('home_mua_vat_pham')}}">MUA VẬT PHẨM</a>
    </div>
    <div id="header_right" class="d-flex align-items-center justify-content-center">
        @if (isset($nguoi_dung) && $nguoi_dung != '')
            <div class="icon_navigation" id="person-icon">
                <i class="bi bi-person-circle"> {{$nguoi_dung}}</i>
                <div id="sub-menu">
                    <a class="p-0 m-0" href="{{url('thong_tin_tai_khoan')}}"><i class="bi bi-person"></i> Thông tin tài khoản</a><br>
                    <a class="p-0 m-0" href="{{url('lich_su_mua_hang')}}"><i class="bi bi-bag-check pr-2"></i>Lịch sử mua hàng</a>
                </div>
            </div>
            <a title="Giỏ hàng" href="{{url('gio_hang')}}"><i class="bi bi-cart4 icon_navigation mx-5"></i></a>
            <a title="Đăng xuất" href="{{route('dang_xuat')}}"><i class="bi bi-box-arrow-right icon_navigation icon_navigation"></i></a>
        @else
            <a href="{{route('dang_nhap')}}" style="text-decoration: none"><i class="bi bi-box-arrow-in-left icon_navigation icon_navigation"> Đăng nhập</i></a>
        @endif
        
    </div>
</div>