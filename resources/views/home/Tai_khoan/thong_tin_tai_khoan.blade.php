<!DOCTYPE html>
<html lang="en">
<head>
  @include('home/module/head')
    <link rel="stylesheet" href={{asset('css/home/thong_tin_tai_khoan.css')}}>
  <title>Thông tin tài khoản</title>
</head>
<body>
  @include('home/module/navigation')
  <div id="account_info"> 
    <div id="content_top" class="row row-cols-1 pb-4 px-0 m-0">
      <div id="content_top_up" class="col text-center">
        ACCOUNT INFORMATION
      </div>
      <div id="content_top_down" class="col text-center pb-3">
        Thông tin tài khoản của bạn
      </div>
      <div id="content_top_center" class="col text-center pb-1">
        <i class="bi bi-person-circle"></i>
      </div>
    </div>
    <form action="{{url('cap_nhat_khach_hang')}}" method="post" class="mt-3 container">
      @csrf
      <div class="row col-md-12 d-flex justify-content-center align-items-center">
        <div class="col-md-6">
          <div class="form-group">
            <label for="tai_khoan">Tên đăng nhập</label>
            <input type="text" class="form-control" id="tai_khoan" readonly name="tai_khoan" value="{{$khach_hang->tai_khoan}}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{$khach_hang->email}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="mat_khau">Mật khẩu mới</label>
            <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu mới">
          </div>
          <div class="form-group">
            <label for="mat_khau">Xác nhận lại mật khẩu</label>
            <input type="password" class="form-control" id="mat_khau" name="xac_nhan_mat_khau" placeholder="Nhập lại mật khẩu mới">
          </div>
        </div>
      </div>
      <div class="col-md-12 button_container d-flex justify-content-center">
        <button type="submit" class="submit_btn px-5 py-3">Cập nhật</button>
      </div>
    </form>
  </div>
  <script>
    @if(isset($bao_loi) && $bao_loi != '')
        alert('{{$bao_loi}}');
    @endif
    // sesson()->put('bao_loi', '');
  </script>
</body>
</html>