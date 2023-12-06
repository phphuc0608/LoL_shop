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
                <a href="#" class="col-md-2 p-0 my-1 mx-3 content_container">
                    <img src="{{asset('img/test.webp')}}" alt="" class="img_item text-center">
                    <div class="item_name d-flex align-items-center">
                        <h2>AATROX</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @include('home/module/footer')
</body>
</html>