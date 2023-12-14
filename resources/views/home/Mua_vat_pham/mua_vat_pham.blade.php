<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <link rel="stylesheet" href={{asset('css/home/mua_trang_phuc.css')}}>
    <title>Mua vật phẩm</title>
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
        <form action="{{url('tim_kiem_vat_pham')}}" method="post" id="content_center" class="container mt-3">
            @csrf
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <input class="p-2" type="text" placeholder="Tìm kiếm" name="keyword" id="keyword" {{$search != '0'?" value=$keyword":""}}>
                <button type="submit">Search</button>
            </div>
            <div class="col-md-12 text-right mt-3">
                <input type="checkbox" class="mx-2" name="mau_mat" id="mau_mat" value="1" @if($search==1&&isset($mau_mat)) checked @endif> Mẫu mắt
                <input type="checkbox" class="mx-2" name="emote" id="emote" value="2" @if($search==1&&isset($emote)) checked @endif> Emote
            </div>
        </form>
        <div id="content_bottom" class="container-fluid d-flex align-items-center justify-content-center">
            <div class="row col-md-12">
                @foreach($items as $item)
                <a href="#" class="col-md-3 p-0 my-1 mx-3 skin_container" style="text-decoration: none;">
                    <img src="{{asset('item/'.$item->hinh_anh)}}" alt="" class="skin_img text-center" style="width: 100%; height: 83%; background-color: #0D1720;">
                    <div class="item_name d-flex align-items-center">
                        <div class="skin_info ">
                            <div class="skin_name text-center pt-3">
                                <h5>{{$item->ten_vat_pham}}</h5>
                            </div>
                            <div class="skin_price text-center pb-3 pr-3">
                                <h5>{{$item->loai_vat_pham->gia}}<span style="font-size: 25px">₫</span></h5>
                            </div>
                        </div>
                    </div>
                
                    <div class="d-flex align-items-center justify-content-center m-0">
                        <div class="buy_button" onclick="location.href='{{route('xu_ly_them_gio_hang',['keyword'=>$item->ten_vat_pham, 'type'=>'vat_pham'])}}';">
                            Mua <i class="bi bi-bag"></i> 
                        </div>
                    </div>
                </a>
                @endforeach
                </div>
            </div>
    </div>
    @include('home/module/footer')
</body>
</html>