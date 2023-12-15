<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý sản phẩm vật phẩm</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
      <form action="{{url('tim_kiem_item_process')}}" method="post">
        @csrf
        <div class="form-group" style="margin-bottom: 90px!important">
            <label for="ten_trang_phuc">Tên vật phẩm</label>
            <input class="form-control mb-2" type="search" name="ten_vat_pham" id="ten_vat_pham" {{$keyword != '\0'?"value=$keyword":""}}>
            <button class="btn" type="submit" style="background-color: #B2893F">Tìm kiếm</button>
        </div>
        <div class="form-group">
            <label for="loai_vat_pham">Loại vật phẩm</label>
            <select class="form-control" name="loai_vat_pham" id="loai_vat_pham">
              <option value="0">Tất cả</option>
              @foreach($loai_vat_phams as $loai_vat_pham)
                <option value="{{$loai_vat_pham->ma_loai_vat_pham}}" {{$type == $loai_vat_pham->ma_vat_pham?'selected':''}}>{{$loai_vat_pham->ten_loai_vat_pham}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="trang_thai">Trạng thái</label>
          <select class="form-control" name="trang_thai" id="trang_thai">
              <option value="-1" {{$state == '-1'?'selected':''}}>Tất cả</option>
              <option value="1" {{$state == '1'?'selected':''}}>Kích hoạt</option>
              <option value="0" {{$state == '0'?'selected':''}}>Khóa</option>
          </select>
      </div>
      </form>
    </div>
    <div class="p-3 table_admin">
        <div class="col-md-12 d-flex justify-content-between mb-3">
            <h3>QUẢN LÝ vật phẩm</h3>
            <button id="add_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_item">
                Thêm vật phẩm
            </button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px">Mã</th>
                    <th class="text-center">Tên vật phẩm</th>
                    <th class="text-center" style="width: 150px">Loại vật phẩm</th>
                    <th class="text-center" style="width: 150px">Giá</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($tim_kiems as $tim_kiem)
                <tr>
                    <th class="text-center">{{$tim_kiem->ma_vat_pham}}</th>
                    <th class="text-center">{{$tim_kiem->ten_vat_pham}}</th>
                    <th class="text-center">{{$tim_kiem->loai_vat_pham->ten_loai_vat_pham}}</th>
                    <th class="text-center">{{$tim_kiem->loai_vat_pham->gia}}<span style="font-size: 15px">₫</span></th>
                    <th class="text-center"><?php echo $tim_kiem->trang_thai == 1?'Đang bán':'Ngừng bán' ?></th>
                    <th class="text-center"><img style="width: 150px; height: 150px;" src="{{asset('item/'.$tim_kiem->hinh_anh)}}" alt=""></th>
                    <th class="text-center">
                        <button class="table_btn" data-toggle="modal" data-target="#update_item"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <button class="table_btn"><a href="{{route('xoa_item',['ma_vat_pham'=>$tim_kiem->ma_vat_pham])}}"><i class="bi bi-trash3 remove_icon"></i></a></button>
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
    </div>
<!-- Add skin Modal -->
<div class="modal" id="add_item" tabindex="-1" role="dialog" aria-labelledby="add_itemLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_skin_label">Thêm vật phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('them_item')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ten_item">Tên vật phẩm</label>
            <input name="ten_item" type="text" class="form-control" id="ten_item" placeholder="Nhập tên vật phẩm" required>
          </div>
          <div class="form-group">
            <label for="hinh_anh">Hình ảnh</label><br>
            <input name="hinh_anh" type="file" id="hinh_anh">
          </div>
          <div class="form-group">
            <label for="add_loai_vat_pham">Loại vật phẩm</label>
            <select class="form-control" id="add_loai_vat_pham" name="add_loai_vat_pham">
              @foreach($loai_vat_phams as $loai_vat_pham)
                <option value="{{$loai_vat_pham->ma_loai_vat_pham}}">{{$loai_vat_pham->ten_loai_vat_pham}}</option>
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
<div class="modal" id="update_item" tabindex="-1" role="dialog" aria-labelledby="update_itemLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_skin_label">Cập nhật vật phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('sua_item')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="ma_item">Mã vật phẩm</label>
            <input name="ma_item" type="text" class="form-control" id="ma_item" readonly {{$empty!=1?"value=$tim_kiem->ma_vat_pham":""}}>
          </div>
          <div class="form-group">
            <label for="up_ten_item">Tên vật phẩm</label>
            <input name="up_ten_item" type="text" class="form-control" id="up_ten_item" {{$empty!=1?"value=$tim_kiem->ten_vat_pham":""}} required>
          </div>
          <div class="form-group">
            <label for="up_hinh_anh">Hình ảnh</label><br>
            <input name="up_hinh_anh" type="file" id="up_hinh_anh">
          </div>
          <div class="form-group">
            <label for="up_loai_vat_pham">Loại vật phẩm</label>
            <select class="form-control" id="up_loai_vat_pham" name="up_loai_vat_pham">
              @foreach($loai_vat_phams as $loai_vat_pham)
                <option value="{{$loai_vat_pham->ma_loai_vat_pham}}" @if($empty!=1){$tim_kiem->ma_loai_vat_pham==$loai_vat_pham->ma_loai_vat_pham?" selected":""}@endif>{{$loai_vat_pham->ten_loai_vat_pham}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="up_state">Trạng thái</label>
            <select class="form-control" id="up_state" name="up_state">
              <option value="1" @if($empty!=1){$tim_kiem->trang_thai=="1"?" selected":""}@endif>Đang bán</option>
              <option value="0" @if($empty!=1){$tim_kiem->trang_thai=="0"?" selected":""}@endif>Ngừng bán</option>
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
    var ma_vat_pham = row.find('th:eq(0)').text();
    var ten_vat_pham = row.find('th:eq(1)').text();
    var trang_thai_text = row.find('th:eq(4)').text();
    var trang_thai = trang_thai_text === "Đang bán" ? "1" : "0";

    $('#update_item #ma_item').val(ma_vat_pham);
    $('#update_item #up_ten_item').val(ten_vat_pham);
    $('#update_item #up_state').val(trang_thai);

    if (trang_thai === "1") {
      $('#update_item #up_state option[value="1"]').prop('selected', true);
    } else if (trang_thai === "0") {
      $('#update_item #up_state option[value="0"]').prop('selected', true);
    }
});
</script>
</body>
</html>
            