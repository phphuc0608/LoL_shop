<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin/module/head')
  <title>Quên mật khẩu</title>
</head>
<body>
  <div id="dang_nhap_container" class="d-flex align-items-center justify-content-center">
      <div id="container_center" class="p-5">
        <div id="container_center_top">
          <div class="text-center mb-4">
            <img style="width: 70px; height: 70px" src="{{asset('img/logo.png')}}">
          </div>
        </div>
        <div id="container_center_bottom" class="d-flex align-items-center justify-content-center">
          <form action="{{url('quen_mk_process')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="tai_khoan">Tên đăng nhập</label>
              <input type="text" class="form-control" id="tai_khoan" name="tai_khoan" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
              <label for="mat_khau">Mật khẩu mới</label>
              <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
              <label for="mat_khau">Nhập lại mật khẩu</label>
              <input type="password" class="form-control" id="xac_nhan_mat_khau" name="xac_nhan_mat_khau" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="button_container d-flex justify-content-center">
              <button type="submit" class="button_login_logout px-5 py-3">Đổi mật khẩu</button>
            </div>
          </form>
          
        </div>
        <div id="dang_nhap" class="mt-4">
          <span>Bạn đã có tài khoản?</span> <a href="{{route('dang_nhap')}}">Đăng nhập</a>
        </div>
        <div id="dang_ky" class="mt-2">
          <span>Bạn chưa có tài khoản?</span> <a href="{{route('dang_ky')}}">Đăng ký</a>
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