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

    <link href="./css/style_contact.css" rel="stylesheet">
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

                                '<li class="nav-item">'.
                                    '<a class="nav-link" href="introduce.php">Giới thiệu</a>'.
                                '</li>'.

                                '<li class="nav-item active">'.
                                    '<a class="nav-link disabled" href="">Liên hệ</a>'.
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

                                '<li class="nav-item">'.
                                    '<a class="nav-link" href="introduce.php">Giới thiệu</a>'.
                                '</li>'.

                                '<li class="nav-item active">'.
                                    '<a class="nav-link disabled" href="">Liên hệ</a>'.
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
            <h1 class="title-name">Liên hệ</h1>
            <?php
                if($name == ""){
                    echo '<a href="index.html" style="color:white">Trang chủ</a> /' .
                        '<span style="color:#ff7200">Liên hệ</span>';
                } else {
                    echo '<a href="customer.php" style="color:white">Trang chủ</a> /' .
                        '<span style="color:#ff7200">Liên hệ</span>';
                }
            ?>
        </div>

    </div>


    <!--Content body -->
    <div class="container content">
        <div class="row">

            <div class="col-md-6">
                <h3>Công ty cổ phần đầu tư bất động sản 24h</h3>
                <p>
					Được thành lập vào ngày 20/08/2008 với niềm đam mê và khát vọng thành công
                    trong lĩnh vực bất động sản. Nhờ chiến lược rõ ràng và hướng đi đúng, Bất động sản 24h đã
                    nhanh chóng phát triển và đạt được những thành công nhất định.
                </p>

                <div>
                    <p>Địa chỉ: Tầng 8 Ladeco, 266 Đội Cấn, Hà Nội, Vietnam</p>
                    <p>Hotline: 1900 6750</p>
                    <p>Email: Dongsan24h@gmail.com</p>
                </div>

            </div>
            
            <div class="col-md-6">
                <h3>GỬI LIÊN HỆ CHO CHÚNG TÔI</h3>
                <form href="#">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Họ và tên">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Số điện thoại">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control rounded-0" placeholder="Nội dung" rows="3"></textarea>
                    </div>

                    <button type="submit" class="update btn btn-danger">Gửi liên hệ</button>
                </form> 
            </div>

        </div>       
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
