<!DOCTYPE html>
<html lang="en">
<head>
  @include('home/module/head')
  <link rel="stylesheet" href={{asset('css/home/lich_su_mua_hang.css')}}>
  <title>Lịch sử mua hàng</title>
</head>
<body>
  @include('home/module/navigation')
    <div id="account_info"> 
    <div id="content_top" class="row row-cols-1 pb-4 px-0 m-0">
      <div id="content_top_up" class="col text-center">
        PURCHASE HISTORY
      </div>
      <div id="content_top_down" class="col text-center pb-3">
        Lịch sử mua hàng của bạn
      </div>
      <div id="content_top_center" class="col text-center pb-1">
        <i class="bi bi-bag-check pr-2"></i>
      </div>
    </div>
    <table class="table table-striped table-dark mt-4 mb-0">
      <thead>
        <tr>
          <th class="text-center">Tên sản phẩm</th>
          <th class="text-center">Giá</th>
          <th class="text-center">Hình ảnh</th>
        </tr>
      </thead>
      <tbody>
        @php
          $sum=0;
        @endphp
        @if ($san_phams!=null)
          @foreach ($san_phams as $san_pham)
          <tr>
            <th class="text-center">{{$san_pham->ten_san_pham}}</th>
            <th class="text-center">{{$san_pham->gia}}<span style="font-size: 18px">₫</span></th>
            <th class="text-center">
              @if ($san_pham->loai_san_pham == 'bau_vat')
                <img src="{{asset('chest/'.$san_pham->hinh_anh)}}" width="100px" height="100px">
              @elseif($san_pham->loai_san_pham == 'vat_pham')
                <img src="{{asset('item/'.$san_pham->hinh_anh)}}" width="100px" height="100px">
              @else
                <img src="{{asset('skin/'.$san_pham->hinh_anh)}}" width="200px" height="100px">
              @endif
            </th>
          </tr>
          @php
            $sum+=$san_pham->gia;
          @endphp
          @endforeach
        @endif
      </tbody>
    </table>
    <div class="col-md-12 my-3 d-flex justify-content-between align-items-center">
      <h5>Tổng tiền đã thanh toán: <span id="price_total">{{$san_phams!=null?$sum:'0'}}<span style="font-size: 25px">₫</span></span></h5>
    </div>
    @include('home/module/footer')
</body>
</html>