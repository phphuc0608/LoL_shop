<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin/module/head')
    <title>Quản lý người dùng</title>
</head>
<body>
    @include('admin/module/header_admin')
    <div class="sort_cotainer p-3 ">
        <div class="form-group">
            <label for="ten_tai_khoan">Tên tài khoản</label>
            <input class="form-control" type="text" name="te" id="ten_tai_khoan">
        </div>
        <div class="form-group">
            <label for="chuc_vu">Chức vụ</label>
            <select class="form-control" name="" id="chuc_vu">
                <option value="">Tất cả</option>
                <option value="">Admin</option>
                <option value="">Nhân viên</option>
                <option value="">Khách hàng</option>
            </select>
        </div>
        <div class="form-group">
            <label for="chuc_vu">Trạng thái</label>
            <select class="form-control" name="" id="trang_thai">
                <option value="">Tất cả</option>
                <option value="">Kích hoạt</option>
                <option value="">Khóa</option>
            </select>
        </div>
    </div>
    <div class="table-striped p-3 table_admin">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tài khoản</th>
                    <th>Chức vụ</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>admin</th>
                    <th>Admin</th>
                    <th>Hoạt động</th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
        
    </div>
</body>
</html>