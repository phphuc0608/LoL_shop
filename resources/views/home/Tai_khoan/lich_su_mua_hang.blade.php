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
    <table class="table table-striped table-dark mt-4">
      <thead>
        <tr>
          <th class="text-center">Tên sản phẩm</th>
          <th class="text-center">Giá</th>
          <th class="text-center">Hình ảnh</th>
        </tr>
      </thead>
      <tbody>
        {{-- @foreach ($ds_ls as $item) --}}
          @foreach ($san_phams as $san_pham)
            {{$san_pham->ten_vat_pham}}
            {{-- @if ($san_pham->ten_vat_pham == $item || $san_pham->ten_bau_vat == $item || $san_pham->ten_trang_phuc == $item)
                {{$san_pham}}
            @endif --}}
          @endforeach
        {{-- @endforeach --}}
       
        {{-- <tr>
          <th class="text-center">Aatrox vinh quang</th>
          <th class="text-center">100000</th>
          <th class="text-center">
            <img src="{{asset('img/template.webp')}}" width="200px" height="100px">
          </th>
        </tr> --}}
      </tbody>
    </table>
</body>
</html>