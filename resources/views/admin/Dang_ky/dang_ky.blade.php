<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin/module/head')
  <title>Đăng ký</title>
</head>
<body>
  <div id="dang_nhap_container" class="d-flex align-items-center justify-content-center">
      <div id="container_center" class="p-5">
        <div id="container_center_top">
          <div class="text-center mb-4">
            <h3>ĐĂNG KÝ</h3>
          </div>
        </div>
        <form action="{{url('them_khach_hang')}}" method="post">
          @csrf
          <div id="container_center_bottom" class="d-flex align-items-center justify-content-center">
          
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
              </div>
              <div class="form-group">
                <label for="tai_khoan">Tên đăng nhập</label>
                <input type="text" class="form-control" id="tai_khoan" name="tai_khoan" placeholder="Nhập tên đăng nhập" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="mat_khau">Mật khẩu</label>
                <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu" required>
              </div>
              <div class="form-group">
                <label for="xac_nhan_mat_khau"> Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="xac_nhan_mat_khau" name="xac_nhan_mat_khau" placeholder="Nhập lại mật khẩu" required>
              </div>              
            </div>
          </div>
          <div class=" button_container col-md-6 mx-auto">
            <button type="submit" class="button_login_logout px-5 py-3">Đăng ký</button>
          </div>
        </form>
        
        <div id="dang_ky" class="mt-4 text-center">
          <span>Bạn có tài khoản rồi?</span> <a href="{{route('dang_nhap')}}">Đăng nhập</a>
        </div>
      </div>
  </div>
  <script>
    @if(isset($bao_loi) && $bao_loi != '')
        alert('{{$bao_loi}}');
    @endif
  </script>
</body>
</html>