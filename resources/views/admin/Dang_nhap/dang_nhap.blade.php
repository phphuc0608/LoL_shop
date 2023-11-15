<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin/module/head')
  <title>Đăng nhập</title>
</head>
<body>
  <div id="dang_nhap_container" class="d-flex align-items-center justify-content-center">
      <div id="container_center" class="p-5">
        <div id="container_center_top">
          <div id="container_center_top_left" class="text-center mb-4">
            <img style="width: 120px; height: 60px" src="{{asset('img/logo.png')}}">
          </div>
        </div>
        <div id="container_center_bottom" class="d-flex align-items-center justify-content-center">
          <form action="{{url('dang_nhap_process')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="tai_khoan">Tên đăng nhập</label>
              <input type="text" class="form-control" id="tai_khoan" name="tai_khoan" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
              <label for="mat_khau">Mật khẩu</label>
              <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="button_container d-flex justify-content-center">
              <button type="submit" class="button_login_logout px-5 py-3">Đăng nhập</button>
            </div>
          </form>
          
        </div>
        <div id="dang_ky" class="mt-4">
          <span>Bạn chưa có tài khoản?</span> <a href="#">Đăng ký</a>
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