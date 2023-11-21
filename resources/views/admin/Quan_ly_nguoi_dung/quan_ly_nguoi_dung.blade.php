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
                <option value="">Admin</option>
                <option value="">Nhân viên</option>
                <option value="">Khách hàng</option>
            </select>
        </div>
        <div class="form-group">
            <label for="trang_thai">Trạng thái</label>
            <select class="form-control" name="" id="trang_thai">
                <option value="">Tất cả</option>
                <option value="">Kích hoạt</option>
                <option value="">Khóa</option>
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
                <tr>
                    <th class="text-center">admin</th>
                    <th class="text-center">Admin</th>
                    <th class="text-center">Kích hoạt</th>
                    <th class="text-center">
                        <button class="table_btn"><i class="bi bi-pencil update_icon"></i></button>
                        |
                        <button class="table_btn"><i class="bi bi-trash3 remove_icon"></i></button>
                    </th>
                </tr>
            </tbody>
        </table>
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
            