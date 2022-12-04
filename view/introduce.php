<?php

    // Kiểm tra có tài khoản đang đăng nhập
    session_start();
    $name = "";
    if(isset($_SESSION['account'])){
        $name = $_SESSION['account'][1];
    }

?>

<!-- ............................................................HTML........................................................... -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bất động sản 24h</title>
	<!-- Import Boostrap css, js, font awesome here -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- Import swiper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.min.js"></script>

    <link href="./css/style_introduce.css" rel="stylesheet">
</head>
<body>

    <!-- Menu, banner-->
    <div class="menu">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="logo"><img src="images/logo.png" alt=""></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Hiện menu phù hợp với trạng thái đăng nhập -->
                <?php
                
                    if($name == ""){
                        echo '<ul class="navbar-nav mr-auto ">'.

                                '<li class="nav-item">'.
                                    '<a class="nav-link" href="index.html">Trang chủ <span class="sr-only">(current)</span></a>'.
                                '</li>'.

                                '<li class="nav-item active">'.
                                    '<a class="nav-link" href="">Giới thiệu</a>'.
                                '</li>'.

                                '<li class="nav-item">'.
                                    '<a class="nav-link disabled" href="contact.php">Liên hệ</a>'.
                                '</li>'.

                            '</ul>'.

                            '<ul class="navbar-nav mr-1">'.
                                '<li class="nav-item">'.
                                    '<a class="btn btn-danger" href="login.php" role="button">Đăng Nhập</a>'.
                                '</li>'.
                            '</ul>';
                    } else {
                        echo '<ul class="navbar-nav mr-auto ">'.

                                '<li class="nav-item">'.
                                    '<a class="nav-link" href="customer.php">Trang chủ <span class="sr-only">(current)</span></a>'.
                                '</li>'.

                                '<li class="nav-item active">'.
                                    '<a class="nav-link" href="">Giới thiệu</a>'.
                                '</li>'.

                                '<li class="nav-item">'.
                                    '<a class="nav-link disabled" href="contact.php">Liên hệ</a>'.
                                '</li>'.

                                '<li class="nav-item dropdown">'.
                                    '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.
                                        'Tài Khoản'.
                                    '</a>'.
                                    '<div class="dropdown-menu" aria-labelledby="navbarDropdown">'.
                                        '<a class="dropdown-item" href="cart.php">Giỏ hàng của bạn</a>'.
                                        '<a class="dropdown-item" href="history_order.php">Lịch sử đặt mua</a>'.
                                        '<div class="dropdown-divider"></div>'.
                                        '<a class="dropdown-item" href="information_user.php">Thông tin tài khoản</a>'.
                                    '</div>'.
                                '</li>'.

                            '</ul>'.

                            '<ul class="navbar-nav mr-1">'.
                                '<li class="nav-item">'.
                                    '<i class="fas fa-user" style="color:white"></i><span style="color:white"> '.$name.' </span>'.
                                    '<a class="btn btn-danger" href="..\controller\logout_controller.php" role="button">Đăng Xuất</a>'.
                                '</li>'.
                            '</ul>';

                    }
                    
                ?>
                 
            </div>

        </nav>
        
        <!-- Title -->
        <div class="content-menu">
            <h1 class="title-name">Giới thiệu</h1>
            <?php
                if($name == ""){
                    echo '<a href="index.html" style="color:white">Trang chủ</a> /' .
                        '<span style="color:#ff7200">Giới thiệu</span>';
                } else {
                    echo '<a href="customer.php" style="color:white">Trang chủ</a> /' .
                        '<span style="color:#ff7200">Giới thiệu</span>';
                }
            ?>
        </div>

    </div>


    <!--Content body -->
    <div class="container content">
        <h4>Giới thiệu</h4>
        <p>Tòa nhà cao nhất Việt Nam The Sky Land 90 của Công ty cổ phần công nghệ Sapo 
            chính thức cho khách hàng đặt giữ chỗ chọn mua đợt đầu vào ngày Event <span>1/7/2016</span>. 
            Sự kiện diễn ra lúc 18h tại nhà mẫu Sapohomes Central Park, số 208 đường Nguyễn Chí Thanh, TP Hà Nội . 
            Đợt đầu đặt chỗ tầng 36 và 37 chỉ dành cho người nước ngoài. Các tầng còn lại tất cả các khách hàng chọn căn đặt cọc 
            từ ngày <span>19/7/2016</span>.</p>
        
        <p><b>MỞ BÁN</b></p>
        <p>+ Ngày công bố giá bán và cho khách đặt cọc từ: <span>19/7/2016</span></p>
        <p>+ Ngày tổ chức event mở bán: <span>25/7/2016</span></p>
        <p>– Tòa nhà The Sky Land  90 tầng sở hữu những căn hộ đẳng cấp bậc nhất Việt Nam. 
            Được nhiều các nhà đầu tư trong và ngoài nước đặc biệt quan tâm. 
            Khi mở bán kỳ vọng sẽ trở thành hiện tượng của thị trường bất động sản trong nhiều năm trở lại đây.</p>

        <p><b>1. Tổng quan:</b></p>
        <p>– Tổng chiều cao thiết kế: 512 m</p>
        <p>– Số tầng: 90 tầng nổi và 4 tầng hầm</p>
        <p>– Tổng diện tích sàn (không gồm hầm): 198.200 m2</p>

        <p><b>2. Diện tích căn hộ Tòa SkyLand 90:</b></p>
        <p>– Thiết kế từ: 1-2-3-4 phòng ngủ và Sky villa</p>
        <p>– Loại 1 phòng ngủ: 54-55-66 m2</p>
        <p>– Loại 2 phòng ngủ: 78-87-90-94 m2</p>
        <p>– Loại 3 phòng ngủ: 106-109-133-145 m2</p>
        <p>– Loại 4 phòng ngủ: 144-171-172-173-186-192-249-258-269-407-420-431 m2</p>

        <p><b>3. Loại hình phát triển The Sky Land  90:</b></p>
        <p>– Trung tâm thương mại, rạp chiếu phim, sân trượt băng trong nhà, gym (tầng B1,1, 2, 3)</p>
        <p>– Khu club house dành cho cư dân gồm hệ thống hồ bơi, gym, spa, bar và lounge ngoài trời (tầng 4).</p>
        <p>– Sảnh lounge tiêu chuẩn 5 sao và nhà sinh hoạt cộng đồng dành cho cư dân, nhà hàng cao cấp (tầng 5).</p>
        <p>– Khu căn hộ hiện đại (tầng 6 – 40) với căn hộ 1 – 4 phòng ngủ, sky villa.</p>
        <p>– Khách sạn SapoPearl 5 sao (tầng 42 – 76).</p>
        <p>– Đài quan sát (tầng 79 – 90).</p>

        <p><b>4. Thông tin kỹ thuật:</b></p>
        <p>Số lượng căn hộ/sàn: 10 – 20 căn.</p>
        <p>Số lượng thang máy: 26 thang máy.</p>
        <p>Số lượng thang thoát hiểm: 2 thang.</p>
        <p>Chiều rộng hành lang: 1,8m.</p>
        <p>Tầng hầm để xe (tầng B2, B3).</p>

        <p><b>Thông tin khác:</b></p>
        <p>–&nbsp;<b>Đơn vị thiết kế:</b>&nbsp;Tập đoàn Atkins (Anh Quốc)</p>
        <p>–&nbsp;<b>Năm khởi công:</b>&nbsp;2016</p>
        <p>–&nbsp;<b>Năm hoàn thành:</b>&nbsp;Dự kiến 2019</p>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-fluid padding">	
            <div class="row text-center">
                <div class="col-12">
                    <div><img style="height: 200px;" src="images/logo.png" alt=""></div>
                    <p>Với hơn 10 năm kinh nghiệm, BĐS 24h tự hào là sàn mua bán, giao dịch và quảng cáo bất động sản hàng đầu tại Việt Nam</p>
                </div>
                <div class="col-md-4">
                    <p><i class="far fa-map"></i></p>
                    <p>Trụ sở chính</p>
                    <h5>Tầng 8 Ladeco, 266 Đội Cấn, Hà Nội, Vietnam</h5>
                </div>
                <div class="col-md-4">
                    <p><i class="fas fa-phone"></i></p>				
                    <p>Hotline</p>
                    <h5>1900 6750</h5>
                </div>
                <div class="col-md-4">
                    <p><i class="fas fa-envelope"></i></p>				
                    <p>Email</p>
                    <h5>Dongsan24h@gmail.com</h5>
                </div>

                <div class="col-12">
                    <hr class="light-100">
                </div>

                <div class="col-md-3 text-left my-2">
                    <h5>Thông tin công ty</h5>
                    <a href="">Trang chủ</a><br>
                    <a href="">Giới thiệu</a><br>
                    <a href="">Dự án bất động sản</a><br>
                    <a href="">Liên hệ</a><br>
                    <a href="">Hỗ trợ</a><br>
                </div>
                <div class="col-md-3 text-left my-2">
                    <h5>Hỗ trợ khách hàng</h5>
                    <a href="">Trang chủ</a><br>
                    <a href="">Giới thiệu</a><br>
                    <a href="">Dự án bất động sản</a><br>
                    <a href="">Liên hệ</a><br>
                    <a href="">Hỗ trợ</a><br>
                </div>
                <div class="col-md-3 text-left my-2">
                    <h5>Chính sách hoạt động</h5>
                    <a href="">Trang chủ</a><br>
                    <a href="">Giới thiệu</a><br>
                    <a href="">Dự án bất động sản</a><br>
                    <a href="">Liên hệ</a><br>
                    <a href="">Hỗ trợ</a><br>
                </div>
                <div class="col-md-3 text-left my-2">
                    <h5>Kết nối với chúng tôi</h5>
                    <a href="">Trang chủ</a><br>
                    <a href="">Giới thiệu</a><br>
                    <a href="">Dự án bất động sản</a><br>
                    <a href="">Liên hệ</a><br>
                    <a href="">Hỗ trợ</a><br>
                </div>

                <div class="col-12">
                    <hr class="light-100">
                    <h5>&copy; Bản quyền thuộc về team <span class="author"> Hoàng-Chí </span></h5>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    
</body>
</html>


