<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin/module/head')
  <title>Thống kê</title>
</head>
<body style="background-color: black">
  @include('admin/module/header_admin')
  <div class="sort_cotainer p-3 "></div>
      <div class="p-3 table_admin">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Tháng</th>
                    <th class="text-center">Doanh thu trang phục</th>
                    <th class="text-center">Doanh thu vật phẩm</th>
                    <th class="text-center">Doanh thu báu vật</th>
                    <th class="text-center">SL trang phục đã bán</th>
                    <th class="text-center">SL vật phẩm đã bán</th>
                    <th class="text-center">SL báu vật đã bán</th>
                    <th class="text-center">Tổng sl đã bán</th>
                    <th class="text-center">Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
              @if ($thong_kes != null)
                @foreach ($thong_kes as $thong_ke) 
                  <tr>
                    <th class="text-center">{{$thong_ke->thang}}</th>
                    <th class="text-center">{{$thong_ke->doanh_thu_trang_phuc}}<span style="font-size: 15px">₫</span></th>
                    <th class="text-center">{{$thong_ke->doanh_thu_vat_pham}}<span style="font-size: 15px">₫</span></th>
                    <th class="text-center">{{$thong_ke->doanh_thu_bau_vat}}<span style="font-size: 15px">₫</span></th>
                    <th class="text-center">{{$thong_ke->trang_phuc_da_ban}}</th>
                    <th class="text-center">{{$thong_ke->vat_pham_da_ban}}</th>
                    <th class="text-center">{{$thong_ke->bau_vat_da_ban}}</th>
                    <th class="text-center">{{$thong_ke->tong_da_ban}}</th>
                    <th class="text-center">{{$thong_ke->tong_doanh_thu}}</th>
                </tr>
                @endforeach
              @endif
            </tbody>
        </table>
    </div>
    {{-- <div class="col-md-6" style="margin-left: 510px">
      <div class="pagination d-flex justify-content-center">
        <ul class="pagination">
          <li class="page-item">
            @if($page > 1)
                <a class="previous page-link" href="{{route('quan_ly_item_search',['page'=>($page-1), 'keyword'=>$keyword, 'state'=>$state, 'type'=>$type])}}">&lt;</a>
            @endif
          </li>
            @for($i = 1; $i <= $page_number; ++$i)
              <li class="page-item">
                <a class="page-link" href="{{route('quan_ly_item_search',['page'=>$i, 'keyword'=>$keyword, 'state'=>$state, 'type'=>$type])}}">{{$i}}</a>  
              </li>
            @endfor
          <li class="page-item">
            @if($page < $page_number)
              <a class="next page-link" href="{{route('quan_ly_item_search',['page'=>($page+1), 'keyword'=>$keyword, 'state'=>$state, 'type'=>$type])}}">&gt;</a>
            @endif
          </li>
        </ul>
      </div>
    </div> --}}
</body>
</html>