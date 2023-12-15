<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý sản phẩm báu vật</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
      <form action="{{url('tim_kiem_chest_process')}}" method="post">
        @csrf
        <div class="form-group" style="margin-bottom: 90px!important">
            <label for="ten_trang_phuc">Tên báu vật</label>
            <input class="form-control mb-2" type="search" name="ten_bau_vat" id="ten_bau_vat">
            <button class="btn" type="submit" style="background-color: #B2893F">Tìm kiếm</button>
        </div>
        <div class="form-group">
            <label for="loai_bau_vat">Loại báu vật</label>
            <select class="form-control" name="loai_bau_vat" id="loai_bau_vat">
              <option value="0">Tất cả</option>
              @foreach($loai_bau_vats as $loai_bau_vat)
                <option value="{{$loai_bau_vat->ma_loai_bau_vat}}">{{$loai_bau_vat->ten_loai_bau_vat}}</option>
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
            <h3>QUẢN LÝ BÁU VẬT</h3>
            <button id="add_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_chest">
                Thêm báu vật
            </button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px">Mã</th>
                    <th class="text-center">Tên báu vật</th>
                    <th class="text-center" style="width: 150px">Loại báu vật</th>
                    <th class="text-center" style="width: 150px">Giá</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($chests as $chest)
                <tr>
                    <th class="text-center">{{$chest->ma_bau_vat}}</th>
                    <th class="text-center">{{$chest->ten_bau_vat}}</th>
                    <th class="text-center">{{$chest->loai_bau_vat->ten_loai_bau_vat}}</th>
                    <th class="text-center">{{$chest->loai_bau_vat->gia}}<span style="font-size: 15px">₫</span></th>
                    <th class="text-center"><?php echo $chest->trang_thai == 1?'Đang bán':'Ngừng bán' ?></th>
                    <th class="text-center"><img style="width: 100px; height: 100px;" src="{{asset('chest/'.$chest->hinh_anh)}}" alt=""></th>
                    <th class="text-center">
                        <button class="table_btn" data-toggle="modal" data-target="#update_chest"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <button class="table_btn"><a href="{{route('xoa_chest',['ma_bau_vat'=>$chest->ma_bau_vat])}}"><i class="bi bi-trash3 remove_icon"></i></a></button>
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
                <a class="previous page-link" href="{{route('quan_ly_chest',['page'=>($page-1)])}}">&lt;</a>
            @endif
          </li>
            @for($i = 1; $i <= $page_number; ++$i)
              <li class="page-item">
                <a class="page-link" href="{{route('quan_ly_chest',['page'=>$i])}}">{{$i}}</a>  
              </li>
            @endfor
          <li class="page-item">
            @if($page < $page_number)
              <a class="next page-link" href="{{route('quan_ly_chest',['page'=>($page+1)])}}">&gt;</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
<!-- Add skin Modal -->
<div class="modal" id="add_chest" tabindex="-1" role="dialog" aria-labelledby="add_chestLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_skin_label">Thêm trang phục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('them_chest')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ten_chest">Tên báu vật</label>
            <input name="ten_chest" type="text" class="form-control" id="ten_chest" placeholder="Nhập tên báu vật" required>
          </div>
          <div class="form-group">
            <label for="hinh_anh">Hình ảnh</label><br>
            <input name="hinh_anh" type="file" id="hinh_anh">
          </div>
          <div class="form-group">
            <label for="add_loai_bau_vat">Loại báu vật</label>
            <select class="form-control" id="add_loai_bau_vat" name="add_loai_bau_vat">
              @foreach($loai_bau_vats as $loai_bau_vat)
                <option value="{{$loai_bau_vat->ma_loai_bau_vat}}">{{$loai_bau_vat->ten_loai_bau_vat}}</option>
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
<div class="modal" id="update_chest" tabindex="-1" role="dialog" aria-labelledby="update_chestLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_skin_label">Cập nhật trang phục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('sua_chest')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ma_chest">Mã báu vật</label>
            <input name="ma_chest" type="text" class="form-control" id="ma_chest" readonly value="{{$chest->ma_bau_vat}}">
          </div>
          <div class="form-group">
            <label for="up_ten_chest">Tên báu vật</label>
            <input name="up_ten_chest" type="text" class="form-control" id="up_ten_chest" value="{{$chest->ten_bau_vat}}" required>
          </div>
          <div class="form-group">
            <label for="up_hinh_anh">Hình ảnh</label><br>
            <input name="up_hinh_anh" type="file" id="up_hinh_anh">
          </div>
          <div class="form-group">
            <label for="up_loai_bau_vat">Loại báu vật</label>
            <select class="form-control" id="up_loai_bau_vat" name="up_loai_bau_vat">
              @foreach($loai_bau_vats as $loai_bau_vat)
                <option value="{{$loai_bau_vat->ma_loai_bau_vat}}" {{$chest->ma_loai_bau_vat==$loai_bau_vat->ma_loai_bau_vat?" selected":""}}>{{$loai_bau_vat->ten_loai_bau_vat}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="up_state">Trạng thái</label>
            <select class="form-control" id="up_state" name="up_state">
              <option value="1" {{$chest->trang_thai=="1"?" selected":""}}>Đang bán</option>
              <option value="0" {{$chest->trang_thai=="0"?" selected":""}}>Ngừng bán</option>
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
    var ma_bau_vat = row.find('th:eq(0)').text();
    var ten_bau_vat = row.find('th:eq(1)').text();
    var trang_thai_text = row.find('th:eq(4)').text();
    var trang_thai = trang_thai_text === "Đang bán" ? "1" : "0";

    $('#update_chest #ma_chest').val(ma_bau_vat);
    $('#update_chest #up_ten_chest').val(ten_bau_vat);
    $('#update_chest #up_state').val(trang_thai);

    if (trang_thai === "1") {
      $('#update_chest #up_state option[value="1"]').prop('selected', true);
    } else if (trang_thai === "0") {
      $('#update_chest #up_state option[value="0"]').prop('selected', true);
    }
});
</script>
</body>
</html>
            