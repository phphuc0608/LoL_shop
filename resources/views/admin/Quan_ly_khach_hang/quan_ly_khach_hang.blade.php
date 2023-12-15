<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý khách hàng</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
      <form action="{{url('tim_kiem_khach_hang_process')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="ten_tai_khoan">Tên tài khoản</label>
            <input class="form-control mb-2" type="search" name="ten_tai_khoan" id="ten_tai_khoan">
        </div>
        <div class="form-group" style="margin-bottom: 90px!important">
          <label for="s_email">Email</label>
          <input class="form-control mb-2" type="search" name="s_email" id="s_email">
          <button class="btn" type="submit" style="background-color: #B2893F">Tìm kiếm</button>
      </div>
        <div class="form-group">
            <label for="trang_thai">Trạng thái</label>
            <select class="form-control" name="trang_thai" id="trang_thai">
                <option value="-1">Tất cả</option>
                <option value="1">Kích hoạt</option>
                <option value="0">Khóa</option>
            </select>
        </div>
      </form>
    </div>
    <div class="p-3 table_admin">
        <div class="col-md-12 d-flex justify-content-between mb-3">
            <h3>QUẢN LÝ KHÁCH HÀNG</h3>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Mã</th>
                    <th class="text-center">Tài khoản</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Giỏ hàng</th>
                    <th class="text-center">Lịch sử mua hàng</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($khach_hangs as $khach_hang)
                <tr>
                    <th class="text-center">{{$khach_hang->ma_khach_hang}}</th>
                    <th class="text-center">{{$khach_hang->tai_khoan}}</th>
                    <th class="text-center">{{$khach_hang->email}}</th>
                    <th class="text-center"><?php echo $khach_hang->nguoi_dung->trang_thai == 1?'Kích hoạt':'Khóa' ?></th>
                    <th class="text-center" width="200px">{{$khach_hang->gio_hang->ds_hang==''?'Trống':$khach_hang->gio_hang->ds_hang}}</th>
                    <th class="text-center" width="200px">{{$khach_hang->lich_su_mua_hang->ds_ls_mua_hang==''?'Trống':$khach_hang->lich_su_mua_hang->ds_ls_mua_hang}}</th>
                    <th class="text-center">
                        <button class="table_btn" data-toggle="modal" data-target="#update_customer"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <button class="table_btn"><a href="{{route('xoa_khach_hang',['ma_khach_hang'=>$khach_hang->ma_khach_hang])}}"><i class="bi bi-trash3 remove_icon"></i></a></button>
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
                <a class="previous page-link" href="{{route('quan_ly_khach_hang',['page'=>($page-1)])}}">&lt;</a>
            @endif
          </li>
            @for($i = 1; $i <= $page_number; ++$i)
              <li class="page-item">
                <a class="page-link" href="{{route('quan_ly_khach_hang',['page'=>$i])}}">{{$i}}</a>  
              </li>
            @endfor
          <li class="page-item">
            @if($page < $page_number)
              <a class="next page-link" href="{{route('quan_ly_khach_hang',['page'=>($page+1)])}}">&gt;</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
{{-- Update customer --}}
<div class="modal" id="update_customer" tabindex="-1" role="dialog" aria-labelledby="update_customerLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_customer_label">Cập nhật khách hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('sua_khach_hang')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="update_ma">Mã khách hàng</label>
            <input name="update_ma" type="text" class="form-control" readonly id="update_ma" value="{{$khach_hang->ma_khach_hang}}">
          </div>
          <div class="form-group">
            <label for="update_tk">Tài khoản</label>
            <input name="update_tk" type="text" class="form-control" readonly id="update_tk" value="{{$khach_hang->tai_khoan}}">
          </div>
          <div class="form-group">
            <label for="update_state">Trạng thái</label>
            <select class="form-control" id="update_state" name="update_state">
              <option value="1" {{$khach_hang->nguoi_dung->trang_thai=="1"?" selected":""}}>Kích hoạt</option>
              <option value="0" {{$khach_hang->nguoi_dung->trang_thai=="0"?" selected":""}}>Khóa</option>
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
    var ma_khach_hang = row.find('th:eq(0)').text();
    $('#update_customer #update_ma').val(ma_khach_hang);
    var tai_khoan = row.find('th:eq(1)').text();
    $('#update_customer #update_tk').val(tai_khoan);
    var trang_thai_text = row.find('th:eq(3)').text();
    var trang_thai = trang_thai_text === "Kích hoạt" ? "1" : "0";
    $('#update_customer #update_state').val(trang_thai);
    if (trang_thai === "1") {
      $('#update_customer #update_state option[value="1"]').prop('selected', true);
    } else if (trang_thai === "0") {
      $('#update_customer #update_state option[value="0"]').prop('selected', true);
    }
  });
</script>
</body>
</html>
            