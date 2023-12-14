<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <link rel="stylesheet" href={{asset('css/home/mua_trang_phuc.css')}}>
    <title>Mua báu vật</title>
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
        <form action="{{url('tim_kiem_bau_vat')}}" method="post" id="content_center" class="container mt-3">
            @csrf
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <input class="p-2" type="text" placeholder="Tìm kiếm" name="keyword" id="keyword" {{$search != '0'?" value=$keyword":""}}>
                <button type="submit">Search</button><br>
            </div> 
            <div class="col-md-12 text-right mt-3">
                <input type="checkbox" class="mx-2" name="ruong" id="ruong" value="1" @if($search==1&&isset($ruong)) checked @endif> Rương
                <input type="checkbox" class="mx-2" name="vien" id="vien" value="2" @if($search==1&&isset($vien)) checked @endif> Viên
                <input type="checkbox" class="mx-2" name="chia_khoa" id="chia_khoa" value="3" @if($search==1&&isset($chia_khoa)) checked @endif> Chìa khóa
                <input type="checkbox" class="mx-2" name="token" id="token" value="4" @if($search==1&&isset($token)) checked @endif> Token
            </div>
        </form>
        <div id="content_bottom" class="container-fluid d-flex align-items-center justify-content-center">
            <div class="row col-md-12">
                @foreach($chests as $chest)
                <div class="col-md-3 p-0 my-1 mx-3 skin_container">
                    <a href="{{route('chi_tiet_bau_vat',['keyword'=>$chest->ten_bau_vat])}}" style="text-decoration: none;">
                        <img src="{{asset('chest/'.$chest->hinh_anh)}}" alt="" class="skin_img text-center" style="background-color: #0D1720; width: 100%;height: auto;">
                        <div class="item_name d-flex align-items-center">
                            <div class="skin_info ">
                                <div class="skin_name text-center pt-3">
                                    <h5>{{$chest->ten_bau_vat}}</h5>
                                </div>
                                <div class="skin_price text-center pb-3 pr-3">
                                    <h5>{{$chest->loai_bau_vat->gia}}<span style="font-size: 25px">₫</span></h5>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="d-flex align-items-center justify-content-center m-0">
                        <div class="buy_button" onclick="location.href='{{route('xu_ly_them_gio_hang',['keyword'=>$chest->ten_bau_vat, 'type'=>'bau_vat'])}}';">
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