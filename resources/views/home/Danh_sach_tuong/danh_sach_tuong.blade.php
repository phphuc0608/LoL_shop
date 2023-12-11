<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <link rel="stylesheet" href={{asset('css/home/ds_tuong.css')}}>
    <title>Danh sách tướng</title>
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
        <form action="{{url('tim_kiem_tuong')}}" method="post" id="content_center" class="container d-flex justify-content-center align-items-center mt-3">
            @csrf
            <input class="p-2" type="text" placeholder="Tìm vị tướng bạn muốn" id="keyword" name="keyword" {{$search != '0'?" value=$keyword":""}}>
            <button type="submit">Search</button>
        </form>
        <div id="content_bottom" class="container-fluid d-flex align-items-center justify-content-center">
            <div class="row col-md-12">
                @foreach($tuongs as $tuong)
                <a href="{{route('tim_kiem_skin_home_keyword',['keyword'=>$tuong->ten_tuong])}}" class="col-md-2 p-0 my-1 mx-3 content_container">
                    <img src="{{asset('danh_sach_tuong/'.$tuong->hinh_anh)}}" alt="" class="img_item text-center">
                    <div class="item_name d-flex align-items-center">
                        <h3>{{$tuong->ten_tuong}}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <div id="gif_container" class="container-fluid p-0 d-flex justify-content-center align-items-center">
        <img src="{{asset("/img/footer_gif.gif")}}" alt="">
    </div>
    @include('home/module/footer')
</body>
</html>