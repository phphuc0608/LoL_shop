<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <link rel="stylesheet" href={{asset('css/home/mua_trang_phuc.css')}}>
    <title>Mua trang phục tướng</title>
</head>
<body>
    @include('home/module/navigation')
    <div id="content" class="container-fluid">
        <div id="content_top" class="container-fluid row row-cols-1 pb-4">
            <div id="content_top_up" class="col text-center">
                CHOOSE YOUR
            </div>
            <div id="content_top_center" class="col text-center pb-3">
                CHAMPION
            </div>
            <div id="content_top_down" class="col text-center pb-1">
               Với hơn 140 tướng, bạn sẽ tìm thấy vị tướng phù hợp với lối chơi của bạn. Thành thạo một hoặc tất cả các tướng.
            </div>
        </div>
        <form action="" method="" id="content_center" class="container d-flex justify-content-center align-items-center mt-3">
            <input class="p-2" type="text" placeholder="Tìm vị tướng bạn muốn">
            <button type="submit">Search</button>
        </form>
        <div id="content_bottom" class="container-fluid d-flex align-items-center justify-content-center">
          <div class="row col-md-12">
            @foreach($skins as $skin)
              <a href="#" class="col-md-3 p-0 my-1 mx-3 skin_container">
                <img src="{{asset('skin/'.$skin->hinh_anh)}}" alt="" class="skin_img text-center">
                <div class="item_name d-flex align-items-center">
                    <div class="skin_info ">
                        <div class="skin_name text-center pt-3">
                            <h5>{{$skin->ten_trang_phuc}}</h5>
                        </div>
                        <div class="skin_price text-center pb-3 pr-3">
                            <h5>{{$skin->gia}}</h5>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center m-0">
                  <button class="buy_button">Mua <i class="bi bi-bag"></i> </button>
                </div>
              </a>
            @endforeach
            </div>
        </div>
    </div>
    @include('home/module/footer')
</body>
</html>