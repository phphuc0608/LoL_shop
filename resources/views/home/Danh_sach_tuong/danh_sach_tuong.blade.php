<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <title>Danh sách tướng</title>
</head>
<body>
    @include('home/module/navigation')
    <div id="content">
        <div id="content_top" class="container-fluid row row-cols-1 pt-4 pb-4">
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
        <div id="content_center" class="container d-flex justify-content-center align-items-center mt-3">
            <input type="text" placeholder="Tìm vị tướng bạn muốn">
            <button>Search</button>
        </div>
        <div id="content_bottom"></div>
    </div>
</body>
</html>