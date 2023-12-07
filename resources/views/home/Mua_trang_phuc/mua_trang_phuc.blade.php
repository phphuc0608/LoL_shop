<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/module/head')
    <link rel="stylesheet" href={{asset('css/home/mua_trang_phuc.css')}}>
    <title>Mua trang phục tướng</title>
</head>
{{-- <style>
#content_bottom {
  margin-top: 50px;
}
.row {
  display: flex;
  justify-content: center;
}
.skin_container {
  position: relative;
  overflow: hidden;
}
.skin_container:hover .skin_img {
  transform: scale(1.1);
}
.skin_container .skin_img {
  width: 100%;
  height: auto;
  transition: transform 0.25s ease-in-out;
  background-size: cover;
  background-repeat: no-repeat;
}
.skin_info {
  width: 100%;
  background-color: rgb(37, 36, 36);
  border-top: 1px solid #927345;
}
.skin_name,
.skin_price {
  text-decoration: none;
  font-weight: 500;
}
.skin_name{
  color: #937341 !important;
}
.skin_price {
  color: #c4b998 !important;
}
.button_container{
  border-top: 1px solid #937341;
  color: #937341;
}
.buy_button{
  color: #937341;
  display: inline; 
  font-size: 20px ;
  font-weight: 700 ;
  grid-area: auto; 
  letter-spacing: 3.3px; 
  line-height: 54px; 
  text-align: center; 
  text-transform: uppercase;
  border: none;
  background-color: transparent;
}

</style> --}}
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
            <div class="row">
                <a href="#" class="col-md-4 p-0 my-1 mx-3 skin_container">
                    <img src="{{asset('img/test.webp')}}" alt="" class="skin_img text-center">
                    <div class="item_name d-flex align-items-center">
                        <div class="skin_info ">
                            <div class="skin_name text-center pt-3">
                                <h5>Winterblessed Camille</h5>
                            </div>
                            <div class="skin_price text-center pb-3 pr-3">
                                <h5>370.000</h5>
                            </div>
                            <div class="button_container py-2 d-flex justify-content-center align-items-center">
                                <button class="buy_button mr-3">Mua</button>
                                <i class="bi bi-bag"></i> 
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @include('home/module/footer')
</body>
</html>