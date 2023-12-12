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
      <div class="ten_bau_vat text-center mt-5">
        <h3>Rương Hextech</h3>
      </div>
      <div class="px-4 my-3">
        <h5>Loại báu vật: Rương</h5>
      </div>
      <div class="px-4 my-3">
        <h5>Mô tả</h5>
        <p>Có tỉ lệ 50% ra mảnh trang phục, 25% ra mảnh tướng, 11.5% ra mảnh mẫu mắt, 
          10% ra biểu cảm, 3.5% ra biểu tượng anh hùng. Có thể chứa 10% rương hextech 
          và chìa khóa, 2.68% ra đá quý, 0.04% ra báu vật đặc biệt.</p>
      </div>
      <div class="px-4 my-3">
        <h5>Giá: 100000</h5>
      </div>
      <div class="d-flex justify-content-center align-items-center mt-5">
        <button class="buy_button py-3"><h4 class="m-0">MUA</h4></button>
      </div>
    </div>
    <div class="col-md-7 text-center" id="img_container">
      <img src="{{asset('img/test2.webp')}}" alt="">
    </div>
  </div>
</body>
</html>