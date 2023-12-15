<div class="container-fluid px-5 d-flex justify-content-between align-items-center" id="header_container">
  <div id="header_left">
    <img src="{{asset('img/logowhite.jpg')}}" id="logo_admin">
  </div>
  <div id="header_right" class="row">
    <a href="{{route('quan_ly_danh_sach_tuong',1)}}" class="mx-3 item_nav">Danh sách tướng</a>
    <div class="dropdown">
      <a href="#" class="mx-3 item_nav">Sản phẩm</a>
      <div class="dropdown-menu" id="sub_menu">
        <a class="dropdown-item sub_item" href="{{route('quan_ly_skin',1)}}">TRANG PHỤC</a>
        <a class="dropdown-item sub_item" href="{{route('quan_ly_chest',1)}}">BÁU VẬT</a>
        <a class="dropdown-item sub_item" href="{{route('quan_ly_item',1)}}">VẬT PHẨM</a>
      </div>
    </div>
    <a href="{{route('quan_ly_khach_hang',1)}}" class="mx-3 item_nav">Khách hàng</a>
    <a href="{{route('quan_ly_nguoi_dung',1)}}" class="mx-3 item_nav">Người dùng</a>
    <a href="{{route('thong_ke')}}" class="mx-3 item_nav">Thống kê</a>
  </div>
  <a href="{{route('dang_xuat')}}" class="btn btn-warning">Đăng xuất</a>
</div>