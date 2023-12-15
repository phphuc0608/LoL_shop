<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý danh sách tướng</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
<div class="sort_cotainer p-3">
    <form action="{{url('tim_kiem_tuong_process')}}" method="post" id="searchForm">
        @csrf
        <div class="form-group" style="margin-bottom: 90px!important">
            <label for="ten_tuong">Tên tướng</label>
            <input class="form-control mb-2" type="search" name="ten_tuong" id="ten_tuong">
            <button class="btn" type="submit" style="background-color: #B2893F">Tìm kiếm</button>
        </div>
    </form>
</div>
    <div class="p-3 table_admin">
        <div class="col-md-12 d-flex justify-content-between mb-3">
            <h3>QUẢN LÝ DANH SÁCH TƯỚNG</h3>
            <button id="add_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_champion">
                Thêm tướng
            </button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Mã tướng</th>
                    <th class="text-center">Tên tướng</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($tuongs as $tuong)
                <tr>
                    <th class="text-center">{{$tuong->ma_tuong}}</th>
                    <th class="text-center">{{$tuong->ten_tuong}}</th>
                    <th class="text-center"><img style="width: 80px; height: 150px;" src="{{asset('danh_sach_tuong/'.$tuong->hinh_anh)}}" alt=""></th>
                    <th class="text-center">
                        <button class="table_btn" data-toggle="modal" data-target="#update_champion"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <a class="table_btn" href="{{route('xoa_tuong',['ma_tuong'=>$tuong->ma_tuong])}}"><i class="bi bi-trash3 remove_icon"></i></a>
                    </th>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6" style="margin-left: 510px">
      <div class="pagination d-flex justify-content-center">
        <ul class="pagination">
          <li class="page-item">
            @if($page > 1)
                <a class="previous page-link" href="{{route('quan_ly_danh_sach_tuong',['page'=>($page-1)])}}">&lt;</a>
            @endif
          </li>
            @for($i = 1; $i <= $page_number; ++$i)
              <li class="page-item">
                <a class="page-link" href="{{route('quan_ly_danh_sach_tuong',['page'=>$i])}}">{{$i}}</a>  
              </li>
            @endfor
          <li class="page-item">
            @if($page < $page_number)
              <a class="next page-link" href="{{route('quan_ly_danh_sach_tuong',['page'=>($page+1)])}}">&gt;</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
{{-- Add User Modal  --}}
<div class="modal" id="add_champion" tabindex="-1" role="dialog" aria-labelledby="add_championLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_champion_label">Thêm tướng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('them_tuong')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ten_tuong">Tên tướng</label>
            <input name="ten_tuong" type="text" class="form-control" id="ten_tuong" placeholder="Nhập tên tướng" required>
          </div>
          <div class="form-group">
            <label for="hinh_anh">Hình ảnh</label><br>
            <input name="hinh_anh" type="file" id="hinh_anh">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Update champion --}}
<div class="modal" id="update_champion" tabindex="-1" role="dialog" aria-labelledby="update_championLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_champion_label">Sửa tướng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('sua_tuong')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ma_tuong">Mã tướng</label>
            <input name="ma_tuong" type="text" class="form-control" id="ma_tuong" value="{{$tuong->ma_tuong}}" readonly>
          </div>
          <div class="form-group">
            <label for="ten_tuong">Tên tướng</label>
            <input name="ten_tuong" type="text" class="form-control" id="ten_tuong" value="{{$tuong->ten_tuong}}" required>
          </div>
          <div class="form-group">
            <label for="hinh_anh">Hình ảnh</label><br>
            <input name="hinh_anh" type="file" id="hinh_anh">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary">Lưu</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $('.table_btn').click(function() {
    var row = $(this).closest('tr');
    var ma_tuong = row.find('th:eq(0)').text();
    $('#update_champion #ma_tuong').val(ma_tuong);
    var ten_tuong = row.find('th:eq(1)').text();
    $('#update_champion #ten_tuong').val(ten_tuong);
});
</script>
</body>
</html>
            