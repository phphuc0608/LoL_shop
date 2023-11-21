<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý người dùng</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
        <div class="form-group" style="margin-bottom: 90px!important">
            <label for="ten_tai_khoan">Tên tài khoản</label>
            <input class="form-control" type="text" name="ten_tai_khoan" id="ten_tai_khoan">
        </div>
        <div class="form-group">
            <label for="chuc_vu">Chức năng</label>
            <select class="form-control" name="" id="chuc_vu">
              <option value="">Tất cả</option>
              @foreach($chuc_nangs as $chuc_nang)
                <option value="{{$chuc_nang->ma_chuc_nang}}">{{$chuc_nang->ten_chuc_nang}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="trang_thai">Trạng thái</label>
            <select class="form-control" name="" id="trang_thai">
                <option value="">Tất cả</option>
                @foreach($nguoi_dungs as $nguoi_dung)
                  <option value="{{$nguoi_dung->trang_thai}}"><?php echo $nguoi_dung->trang_thai == 1?'Kích hoạt':'Khóa' ?></option>
                @endforeach
            </select>
        </div>
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
              @foreach ($nguoi_dungs as $nguoi_dung)
                <tr>
                    <th class="text-center">{{$nguoi_dung->tai_khoan}}</th>
                    <th class="text-center">{{$nguoi_dung->chuc_nang->ten_chuc_nang}}</th>
                    <th class="text-center"><?php echo $nguoi_dung->trang_thai == 1?'Kích hoạt':'Khóa' ?></th>
                    <th class="text-center">
                        <button class="table_btn"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <button class="table_btn"><i class="bi bi-trash3 remove_icon"></i></button>
                    </th>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
      <div class="pagination d-flex justify-content-center">
        <ul class="pagination">
          <li class="page-item">
            @if($page > 1)
                <a class="previous page-link" href="{{route('quan_ly_nguoi_dung',['page'=>($page-1)])}}">&lt;</a>
            @endif
          </li>
            @for($i = 1; $i <= $page_number; ++$i)
              <li class="page-item">
                <a class="page-link" href="{{route('quan_ly_nguoi_dung',['page'=>$i])}}">{{$i}}</a>  
              </li>
            @endfor
          <li class="page-item">
            @if($page < $page_number)
              <a class="next page-link" href="{{route('quan_ly_nguoi_dung',['page'=>($page+1)])}}">&gt;</a>
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
        <form>
          <div class="form-group">
            <label for="username">Tên tài khoản</label>
            <input type="text" class="form-control" id="username" placeholder="Nhập tên tài khoản">
          </div>
          <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
          </div>
          <div class="form-group">
            <label for="state">Trạng thái</label>
            <select class="form-control" id="state">
              <option value="">Kích hoạt</option>
              <option value="">Khóa</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Lưu</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
            