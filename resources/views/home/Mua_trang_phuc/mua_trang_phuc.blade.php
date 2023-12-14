<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <link rel="stylesheet" href={{asset('css/home/mua_trang_phuc.css')}}>
    <title>Mua trang phục tướng</title>
</head>
<body>
    @include('home/module/navigation')
    <div id="content">
        <div id="content_top" class="container-fluid row row-cols-1 pb-4 px-0 m-0">
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
        <form action="{{url('tim_kiem_trang_phuc')}}" method="post" id="content_center" class="container d-flex justify-content-center align-items-center mt-3">
            @csrf
            <input class="p-2" type="text" placeholder="Tìm kiếm"  id="keyword" name="keyword" {{$search != '0'?" value=$keyword":""}}>
            <button type="submit">Search</button>
        </form>
        <div id="content_bottom" class="container-fluid d-flex align-items-center justify-content-center">
            <div class="row col-md-12">
                @foreach($skins as $skin)
                    <div class="col-md-3 p-0 my-1 mx-3 skin_container">
                        <a href="{{route('chi_tiet_trang_phuc',['keyword'=>$skin->ten_trang_phuc])}}">
                            <img src="{{asset('skin/'.$skin->hinh_anh)}}" alt="" class="skin_img text-center" style=" width: 100%; height: auto;">
                            <div class="item_name d-flex align-items-center">
                                <div class="skin_info ">
                                    <div class="skin_name text-center pt-3">
                                        <h5>{{$skin->ten_trang_phuc}}</h5>
                                    </div>
                                    <div class="skin_price text-center pb-3 pr-3">
                                        <h5>{{$skin->do_hiem->gia}}<span style="font-size: 25px">₫</span></h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex align-items-center justify-content-center m-0">
                            <div class="buy_button" onclick="location.href='{{route('xu_ly_them_gio_hang',['keyword'=>$skin->ten_trang_phuc, 'type'=>'trang_phuc'])}}';">
                                Mua <i class="bi bi-bag"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    @include('home/module/footer')
</body>
</html>