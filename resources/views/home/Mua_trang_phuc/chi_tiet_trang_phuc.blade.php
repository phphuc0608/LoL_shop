<!DOCTYPE html>
<html>
<head>
  @include('home/module/head')
  <link rel="stylesheet" href={{asset('css/home/chi_tiet_trang_phuc.css')}}>
  <title>Chi tiết trang phục</title>
</head>
<body>
  <img src="{{asset('img/template.webp')}}" id="splash_art">
  <div class="col-md-5 p-0 m-0" id="skin_info">
    <div class="d-flex justify-content-center align-items-center my-5">
      <img src="{{asset('img/test.jpg')}}" class="champ_img">
    </div>
    <div class="skin_name text-center">
      <h3>AATROX VINH QUANG</h3>
    </div>
    <div class="info_container mt-4 d-flex justify-content-center align-items-center">
      <img src="{{asset('img/model.webp')}}" class="model_img">
      <div class="sub_info_container ml-3">
        <div id="dong_skin">
          <h5>Dòng skin: Vinh quang</h5>
        </div>
        <div id="do_hiem">
          <h5>Độ hiếm: Sử thi</h5>
        </div>
        <div id="gia">
          <h5>Giá: 100000</h5>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-5">
      <button class="buy_button py-3"><h4 class="m-0">MUA</h4></button>
    </div>
  </div>
</body>
</html>