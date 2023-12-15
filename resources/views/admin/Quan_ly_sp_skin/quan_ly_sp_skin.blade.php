<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý sản phẩm skin</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
      <form action="{{url('tim_kiem_skin_process')}}" method="post">
        @csrf
        <div class="form-group" style="margin-bottom: 90px!important">
            <label for="ten_trang_phuc">Tên trang phục</label>
            <input class="form-control mb-2" type="search" name="ten_trang_phuc" id="ten_trang_phuc">
            <button class="btn" type="submit" style="background-color: #B2893F">Tìm kiếm</button>
        </div>
        <div class="form-group">
            <label for="tuong">Tướng</label>
            <select class="form-control" name="tuong" id="tuong">
              <option value="0">Tất cả</option>
              @foreach($tuongs as $tuong)
                <option value="{{$tuong->ma_tuong}}">{{$tuong->ten_tuong}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="trang_thai">Trạng thái</label>
            <select class="form-control" name="trang_thai" id="trang_thai">
                <option value="-1">Tất cả</option>
                <option value="1">Đang bán</option>
                <option value="0">Ngừng bán</option>
            </select>
        </div>
      </form>
    </div>
    <div class="p-3 table_admin">
        <div class="col-md-12 d-flex justify-content-between mb-3">
            <h3>QUẢN LÝ TRANG PHỤC</h3>
            <button id="add_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_skin">
                Thêm trang phục
            </button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px">Mã</th>
                    <th class="text-center">Tên trang phục</th>
                    <th class="text-center">Tên tướng</th>
                    <th class="text-center" style="width: 150px">Độ hiếm</th>
                    <th class="text-center" style="width: 200px">Dòng skin</th>
                    <th class="text-center" style="width: 150px">Giá</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($skins as $skin)
                <tr>
                    <th class="text-center">{{$skin->ma_trang_phuc}}</th>
                    <th class="text-center">{{$skin->ten_trang_phuc}}</th>
                    <th class="text-center">{{$skin->ds_tuong->ten_tuong}}</th>
                    <th class="text-center">{{$skin->do_hiem->ten_do_hiem}}</th>
                    <th class="text-center">{{$skin->dong_skin->ten_dong_skin}}</th>
                    <th class="text-center">{{$skin->do_hiem->gia}}<span style="font-size: 15px">₫</span></th>
                    <th class="text-center"><?php echo $skin->trang_thai == 1?'Đang bán':'Ngừng bán' ?></th>
                    <th class="text-center"><img style="width: 200px; height: 150px;" src="{{asset('skin/'.$skin->hinh_anh)}}" alt=""></th>
                    <th class="text-center">
                        <button class="table_btn" data-toggle="modal" data-target="#update_skin"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <button class="table_btn"><a href="{{route('xoa_skin',['ma_trang_phuc'=>$skin->ma_trang_phuc])}}"><i class="bi bi-trash3 remove_icon"></i></a></button>
                    </th>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6" style="margin-left: 520px">
      <div class="pagination d-flex justify-content-center">
        <ul class="pagination">
          <li class="page-item">
            @if($page > 1)
                <a class="previous page-link" href="{{route('quan_ly_skin',['page'=>($page-1)])}}">&lt;</a>
            @endif
          </li>
            @for($i = 1; $i <= $page_number; ++$i)
              <li class="page-item">
                <a class="page-link" href="{{route('quan_ly_skin',['page'=>$i])}}">{{$i}}</a>  
              </li>
            @endfor
          <li class="page-item">
            @if($page < $page_number)
              <a class="next page-link" href="{{route('quan_ly_skin',['page'=>($page+1)])}}">&gt;</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
<!-- Add skin Modal -->
<div class="modal" id="add_skin" tabindex="-1" role="dialog" aria-labelledby="add_skinLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_skin_label">Thêm trang phục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('them_skin')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ten_skin">Tên trang phục</label>
            <input name="ten_skin" type="text" class="form-control" id="ten_skin" placeholder="Nhập tên trang phục" required> 
          </div>
          <div class="form-group">
            <label for="hinh_anh">Hình ảnh</label><br>
            <input name="hinh_anh" type="file" id="hinh_anh">
          </div>
          <div class="form-group">
            <label for="model">Model 3D</label><br>
            <input name="model" type="file" id="model">
          </div>
          <div class="form-group">
            <label for="add_tuong">Tướng</label>
            <select class="form-control" id="add_tuong" name="add_tuong">
              @foreach($tuongs as $tuong)
                <option value="{{$tuong->ma_tuong}}">{{$tuong->ten_tuong}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="do_hiem">Độ hiếm</label>
            <select class="form-control" id="do_hiem" name="do_hiem">
              @foreach($do_hiems as $do_hiem)
                <option value="{{$do_hiem->ma_do_hiem}}">{{$do_hiem->ten_do_hiem}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="dong_skin">Dòng skin</label>
            <select class="form-control" id="dong_skin" name="dong_skin">
              @foreach($dong_skins as $dong_skin)
                <option value="{{$dong_skin->ma_dong_skin}}">{{$dong_skin->ten_dong_skin}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="state">Trạng thái</label>
            <select class="form-control" id="state" name="state">
              <option value="1">Đang bán</option>
              <option value="0">Ngừng bán</option>
            </select>
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
{{-- Update skin --}}
<div class="modal" id="update_skin" tabindex="-1" role="dialog" aria-labelledby="update_skinLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_skin_label">Cập nhật trang phục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('sua_skin')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ma_skin">Mã trang phục</label>
            <input name="ma_skin" type="text" class="form-control" id="ma_skin" readonly value="{{$skin->ma_trang_phuc}}">
          </div>
          <div class="form-group">
            <label for="up_ten_skin">Tên trang phục</label>
            <input name="up_ten_skin" type="text" class="form-control" id="up_ten_skin" value="{{$skin->ten_trang_phuc}}" required>
          </div>
          <div class="form-group">
            <label for="up_hinh_anh">Hình ảnh</label><br>
            <input name="up_hinh_anh" type="file" id="up_hinh_anh" value="{{$skin->hinh_anh}}">
          </div>
          <div class="form-group">
            <label for="up_model">Model 3D</label><br>
            <input name="up_model" type="file" id="up_model" value="{{$skin->model}}">
          </div>
          <div class="form-group">
            <label for="up_tuong">Tướng</label>
            <select class="form-control" id="up_tuong" name="up_tuong">
              @foreach($tuongs as $tuong)
                <option value="{{$tuong->ma_tuong}}" {{$skin->ma_tuong==$tuong->ma_tuong?" selected":""}}>{{$tuong->ten_tuong}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="up_do_hiem">Độ hiếm</label>
            <select class="form-control" id="up_do_hiem" name="up_do_hiem">
              @foreach($do_hiems as $do_hiem)
                <option value="{{$do_hiem->ma_do_hiem}}" {{$skin->ma_do_hiem==$do_hiem->ma_do_hiem?" selected":""}}>{{$do_hiem->ten_do_hiem}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="up_dong_skin">Dòng skin</label>
            <select class="form-control" id="up_dong_skin" name="up_dong_skin">
              @foreach($dong_skins as $dong_skin)
                <option value="{{$dong_skin->ma_dong_skin}}" {{$skin->ma_dong_skin==$dong_skin->ma_dong_skin?" selected":""}}>{{$dong_skin->ten_dong_skin}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="up_state">Trạng thái</label>
            <select class="form-control" id="up_state" name="up_state">
              <option value="1" {{$skin->trang_thai=="1"?" selected":""}}>Đang bán</option>
              <option value="0" {{$skin->trang_thai=="0"?" selected":""}}>Ngừng bán</option>
            </select>
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
    var ma_trang_phuc = row.find('th:eq(0)').text();
    var ten_trang_phuc = row.find('th:eq(1)').text();
    var ten_tuong = row.find('th:eq(2)').text();
    var do_hiem = row.find('th:eq(3)').text();
    var dong_skin = row.find('th:eq(4)').text();
    var gia = row.find('th:eq(5)').text();
    var trang_thai_text = row.find('th:eq(6)').text();
    var trang_thai = trang_thai_text === "Đang bán" ? "1" : "0";

    $('#update_skin #ma_skin').val(ma_trang_phuc);
    $('#update_skin #up_ten_skin').val(ten_trang_phuc);
    $('#update_skin #up_state').val(trang_thai);
    $('#update_skin #up_tuong option:contains("' + ten_tuong + '")').prop('selected', true);
    $('#update_skin #up_do_hiem option:contains("' + do_hiem + '")').prop('selected', true);
    $('#update_skin #up_dong_skin option:contains("' + dong_skin + '")').prop('selected', true);
    $('#update_skin #up_gia').val(gia);

    if (trang_thai === "1") {
        $('#update_skin #up_state option[value="1"]').prop('selected', true);
    } else if (trang_thai === "0") {
        $('#update_skin #up_state option[value="0"]').prop('selected', true);
    }
});

</script>
</body>
</html>
            