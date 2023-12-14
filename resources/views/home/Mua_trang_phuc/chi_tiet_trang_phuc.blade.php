<!DOCTYPE html>
<html>
<head>
  @include('home/module/head')
  <link rel="stylesheet" href={{asset('css/home/chi_tiet_trang_phuc.css')}}>
  <title>Chi tiết trang phục</title>
</head>
<body>
  <img src="{{asset('skin/'.$skin->hinh_anh)}}" id="splash_art">
  <div class="col-md-5 p-0 m-0" id="skin_info">
    <a href="{{url('home_mua_trang_phuc')}}" id="back_btn" class="ml-4"><i class="bi bi-arrow-left-circle"></i></a>
    <div class="d-flex justify-content-center align-items-center mb-5">
      <img src="{{asset('danh_sach_tuong/'.$skin->ds_tuong->hinh_anh)}}" class="champ_img">
    </div>
    <div class="skin_name text-center">
      <h3>{{$skin->ten_trang_phuc}}</h3>
    </div>
    <div class="info_container mt-4 d-flex justify-content-center align-items-center">
      {{-- <img src="{{asset('img/model.webp')}}" class="model_img"> --}}
      <img src="{{asset('skin/'.$skin->model)}}" class="model_img">
      <div class="sub_info_container ml-3">
        <div id="dong_skin">
          <h5>Dòng skin: {{$skin->dong_skin->ten_dong_skin}}</h5>
        </div>
        <div id="do_hiem">
          <h5>Độ hiếm: {{$skin->do_hiem->ten_do_hiem}}</h5>
        </div>
        <div id="gia">
          <h5>Giá: {{$skin->do_hiem->gia}}</h5>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-5">
      <div class="buy_button py-3 text-center" onclick="location.href='{{route('xu_ly_them_gio_hang',['keyword'=>$skin->ten_trang_phuc, 'type'=>'trang_phuc'])}}';"><h4 class="m-0">MUA</h4></div>
    </div>
  </div>
</body>
</html>