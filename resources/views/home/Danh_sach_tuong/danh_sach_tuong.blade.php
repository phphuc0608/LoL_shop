<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <title>Danh sách tướng</title>
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
                @foreach($tuongs as $tuong)
                <a href="#" class="col-md-2 p-0 my-1 mx-3 content_container">
                    <img src="{{asset('danh_sach_tuong/'.$tuong->hinh_anh)}}" alt="" class="img_item text-center">
                    <div class="item_name d-flex align-items-center">
                        <h2>{{$tuong->ten_tuong}}</h2>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <div id="gif_container" class="container-fluid p-0 d-flex justify-content-center align-items-center">
        <img src="{{asset("/img/footer_gif.gif")}}" alt="">
    </div>
    <div id="footer">
        <div id="footer_top" class="py-4 d-flex justify-content-center align-items-center">
            <a href="https://www.leagueoflegends.com/en-us/how-to-play/" class="footer_top_item p-2">ABOUT LEAGUE OF LEGENDS</a>
            <a href="http://leagueoflegends.na-surveyen2.sgizmo.com/s3/" class="footer_top_item p-2">HELP US IMPROVE</a>
            <a href="https://status.riotgames.com/?locale=en_US&region=na" class="footer_top_item p-2">SERVER STATUS</a>
            <a href="https://support.riotgames.com/hc/en-us" class="footer_top_item p-2">SUPPORT</a>
            <a href="https://lolesports.com/schedule" class="footer_top_item p-2">ESPORTS PRO SITE</a>
            <a href="https://play.google.com/store/apps/details?id=com.riotgames.mobile.leagueconnect" class="footer_top_item p-2">DOWNLOAD RIOT MOBILE COMPANION APP</a>
        </div>
        <div id="footer_bottom">
            <div id="social_container" class="d-flex justify-content-center align-items-center pt-4">
                <a href="https://www.facebook.com/leagueoflegends" class="social_item py-1 mx-2 px-2"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/leagueoflegends" class="social_item py-1 mx-2 px-2"><i class="bi bi-twitter"></i></a>
                <a href="https://www.youtube.com/user/riotgamesinc" class="social_item py-1 mx-2 px-2"><i class="bi bi-youtube"></i></a>
                <a href="https://www.instagram.com/leagueoflegends/" class="social_item py-1 mx-2 px-2"><i class="bi bi-instagram"></i></a>
                <a href="https://www.reddit.com/r/leagueoflegends/" class="social_item py-1 mx-2 px-2"><i class="bi bi-reddit"></i></a>
            </div>
            <div class="col-md-12 d-flex justify-content-center align-items-center py-4">
                <img src="{{asset('img/logoRiot.png')}}" id="logo_footer">
            </div>
            <div class="col-md-12 d-flex justify-content-center align-items-center pb-3" style="color: white">
                <span>Bài tập lớn môn phát triển ứng dụng trên nền web của Phạm Quang Phúc và Đỗ Đức Mạnh</span>
            </div>
            <div class="class-md-12 d-flex justify-content-center align-items-center py-2">
                <img src="{{asset('img/12.png')}}" id="logo_footer_bottom">
            </div>
        </div>
    </div>
</body>
</html>