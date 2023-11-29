<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý danh sách tướng</title>
</head>
<body style="background-color: black">
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
      <div class="form-group" style="margin-bottom: 90px!important">
          <label for="ten_tuong">Tên tướng</label>
          <input class="form-control" type="text" name="ten_tuong" id="ten_tuong">
      </div>
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
        <form>
          <div class="form-group">
            <label for="ten_tuong">Tên tướng</label>
            <input type="text" class="form-control" id="ten_tuong" placeholder="Nhập tên tài khoản">
          </div>
          <div class="form-group">
            <label for="hinh_anh">Hình ảnh</label><br>
            <input type="file" id="hinh_anh">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
            