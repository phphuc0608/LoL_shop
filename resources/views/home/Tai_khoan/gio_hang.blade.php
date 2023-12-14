<!DOCTYPE html>
<html lang="en">
<head>
  @include('home/module/head')
  <link rel="stylesheet" href={{asset('css/home/lich_su_mua_hang.css')}}>
  <title>Giỏ hàng</title>
</head>
<body>
    @include('home/module/navigation')
    <div id="content_top" class="row row-cols-1 pb-4 px-0 m-0">
      <div id="content_top_up" class="col text-center">
        SHOPPING CART
      </div>
      <div id="content_top_down" class="col text-center pb-3">
        Giỏ hàng của bạn
      </div>
      <div id="content_top_center" class="col text-center pb-1">
       <i class="bi bi-cart4 pr-2"></i>
      </div>
    </div>
    <table class="table table-striped table-dark mt-4">
      <thead>
        <tr>
          <th class="text-center">Check</th>
          <th class="text-center">Tên sản phẩm</th>
          <th class="text-center">Giá</th>
          <th class="text-center">Hình ảnh</th>
          <th class="text-center">Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="text-center"><input type="checkbox" name="" style="width:20px; height:20px;"></th>
          <th class="text-center">Aatrox vinh quang</th>
          <th class="text-center price_skin">100000</th>
          <th class="text-center">
            <img src="{{asset('img/template.webp')}}" width="200px" height="100px">
          </th>
          <th class="text-center">
            <button class="btn_container"><a href="#"><i class="table_btn bi bi-trash3 remove_icon"></i></a></button>
          </th>
        </tr>
        <tr>
          <th class="text-center"><input type="checkbox" name="" style="width:20px; height:20px;"></th>
          <th class="text-center">Aatrox vinh quang</th>
          <th class="text-center price_skin">100000</th>
          <th class="text-center">
            <img src="{{asset('img/template.webp')}}" width="200px" height="100px">
          </th>
          <th class="text-center">
            <button class="btn_container"><a href="#"><i class="table_btn bi bi-trash3 remove_icon"></i></a></button>
          </th>
        </tr>
      </tbody>
    </table>
    <div class="col-md-12 my-3 d-flex justify-content-between align-items-center">
      <h5>Tổng tiền: <span id="price_total"></span></h5>
      <button class="btn btn-warning text-right" type="submit">Thanh toán</button>
    </div>
</body>
<script>
$(document).ready(function(){
  $('input[type="checkbox"]').change(function(){
    var total = 0;
    $('input[type="checkbox"]:checked').each(function(){
      var price = $(this).closest('tr').find('.price_skin').text();
      total += parseFloat(price);
    });
    $('#price_total').text(total);
  });
});
</script>
</html>