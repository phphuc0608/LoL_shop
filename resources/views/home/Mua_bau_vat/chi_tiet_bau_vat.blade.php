<!DOCTYPE html>
<html lang="en">
<head>
  @include('home/module/head')
  <link rel="stylesheet" href={{asset('css/home/chi_tiet_bau_vat.css')}}>
  <title>Chi tiết báu vật</title>
</head>
<body>
  <img src="{{asset('img/bau_vat2.jpg')}}" alt="" id="background">
  <div class="d-flex justify-content-center align-items-center" id="content">
    <div class="col-md-5 p-0 m-0 d-flex flex-column justify-content-center" id="bau_vat_info">
      <a href="{{url('home_mua_bau_vat')}}" id="back_btn" class="ml-4"><i class="bi bi-arrow-left-circle"></i></a>
      <div class="ten_bau_vat text-center mt-5">
        <h3>{{$chest->ten_bau_vat}}</h3>
      </div>
      <div class="px-4 my-3">
        <h5>Loại báu vật: {{$chest->loai_bau_vat->ten_loai_bau_vat}}</h5>
      </div>
      <div class="px-4 my-3">
        <h5>Mô tả:</h5>
        <p>{{$chest->mo_ta}}</p>
      </div>
      <div class="px-4 my-3">
        <h5>Giá: {{$chest->loai_bau_vat->gia}}</h5>
      </div>
      <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="buy_button py-3 text-center" onclick="location.href='{{route('xu_ly_them_gio_hang',['keyword'=>$chest->ten_bau_vat, 'type'=>'bau_vat'])}}';"><h4 class="m-0">MUA</h4></div>
      </div>
    </div>
    <div class="col-md-7 text-center" id="img_container">
      <img src="{{asset('chest/'.$chest->hinh_anh)}}" alt="">
    </div>
  </div>
</body>
</html>