<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý người dùng</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
        <form action="{{url('tim_kiem_nguoi_dung_process')}}" method="post">
            @csrf
            <div class="form-group" style="margin-bottom: 90px!important">
                <label for="ten_tai_khoan">Tên tài khoản</label>
                <input class="form-control mb-2" type="search" name="ten_tai_khoan" id="ten_tai_khoan" {{$keyword != '\0'?"value=$keyword":""}}>
                <button class="btn" type="submit" style="background-color: #B2893F" >Tìm kiếm</button>
            </div>
            <div class="form-group">
                <label for="chuc_nang">Chức năng</label>
                <select class="form-control" name="chuc_nang" id="chuc_nang">
                <option value="0">Tất cả</option>
                @foreach($chuc_nangs as $chuc_nang)
                    <option value="{{$chuc_nang->ma_chuc_nang}}" {{$pos == $chuc_nang->ma_chuc_nang?'selected':''}}>{{$chuc_nang->ten_chuc_nang}}</option>
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
            <h3>QUẢN LÝ NGƯỜI DÙNG</h3>
            <button id="add_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user_form">
                Thêm người dùng
            </button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Tài khoản</th>
                    <th class="text-center">Chức năng</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($tim_kiems as $tim_kiem)
                <tr>
                    <th class="text-center">{{$tim_kiem->tai_khoan}}</th>
                    <th class="text-center">{{$tim_kiem->chuc_nang->ten_chuc_nang}}</th>
                    <th class="text-center"><?php echo $tim_kiem->trang_thai == 1?'Kích hoạt':'Khóa' ?></th>
                    <th class="text-center">
                        <button class="table_btn"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <button class="table_btn"><a href="{{route('xoa_nguoi_dung',['tai_khoan'=>$tim_kiem->tai_khoan])}}"><i class="bi bi-trash3 remove_icon"></i></a></button>
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
              <li class="page-item">
                <a class="previous page-link" href="{{route('quan_ly_nguoi_dung_search',['page'=>($page-1), 'keyword'=>($keyword), 'state'=>$state, 'pos'=>$pos])}}">&lt;</a>
              </li>
            @endif
          </li>
            @for($i = 1; $i <= $page_number; ++$i)
              <li class="page-item">
                <a class="page-link" href="{{route('quan_ly_nguoi_dung_search',['page'=>$i, 'keyword'=>$keyword, 'state'=>$state, 'pos'=>$pos])}}">{{$i}}</a>  
              </li>  
            @endfor
          <li class="page-item">
            @if($page < $page_number)
              <li class="page-item">
                <a class="next page-link" href="{{route('quan_ly_nguoi_dung_search',['page'=>($page+1), 'keyword'=>$keyword, 'state'=>$state, 'pos'=>$pos])}}">&gt;</a>
              </li>  
            @endif
          </li>
        </ul>
      </div>
    </div>
<!-- Add User Modal -->
<div class="modal" id="add_user_form" tabindex="-1" role="dialog" aria-labelledby="add_user_formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_user_form_label">Thêm người dùng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('them_nguoi_dung')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="username">Tên tài khoản</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên tài khoản" required>
          </div>
          <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
          </div>
          <div class="form-group">
            <label for="state">Trạng thái</label>
            <select class="form-control" id="state" name="state">
              <option value="1">Kích hoạt</option>
              <option value="0">Khóa</option>
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
{{-- Update user --}}
<div class="modal" id="update_user" tabindex="-1" role="dialog" aria-labelledby="update_userLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_user_label">Cập nhật người dùng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('sua_nguoi_dung')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="update_tk">Tài khoản</label>
            <input name="update_tk" type="text" class="form-control" readonly id="update_tk" {{$empty!=1?"value=$tim_kiem->tai_khoan":""}}>
          </div>
          <div class="form-group">
            <label for="update_state">Trạng thái</label>
            <select class="form-control" id="update_state" name="update_state">
              <option value="1" @if($empty!=1){$tim_kiem->trang_thai=="1"?" selected":""}@endif>Kích hoạt</option>
              <option value="0" @if($empty!=1){$tim_kiem->trang_thai=="0"?" selected":""}@endif>Khóa</option>
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
    var tai_khoan = row.find('th:eq(0)').text();
    $('#update_user #update_tk').val(tai_khoan);
    var trang_thai = row.find('th:eq(2)').text();
    $('#update_user #update_state').val(trang_thai);
  });
</script>
</body>
</html>
            