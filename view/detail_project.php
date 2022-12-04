<?php

    // Kiểm tra có tài khoản đang đăng nhập
    session_start();
    $name = "";
    if(isset($_SESSION['account'])){
        $name = $_SESSION['account'][1];
    }

    // Lấy thông tin chi tiết của dự án
    require ('../model/get_detail_project.php');
    $detail = $project_detail;

    // Lấy các dự án mà người dùng đã thêm vào giỏ hàng
    require ('../model/get_cart.php');
    $cart_list = $cart;

    // Kiểm tra dự án hiện tại có trong giỏ hàng của người dùng
    $check_exist = 0;
    foreach ($cart_list as $project){
        if($project['Project_id'] == $detail['Project_id']){
            $check_exist = 1;
        }
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

    <link href="./css/style_detail_project.css" rel="stylesheet">
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

                                '<li class="nav-item">'.
                                    '<a class="nav-link" href="introduce.php">Giới thiệu</a>'.
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
            <h1 class="title-name"><?php echo $detail['Name']; ?></h1>
            <?php
                if($name == ""){
                    echo '<a href="index.html" style="color:white">Trang chủ</a> /'.
                        '<span style="color:#ff7200">'.$detail['Name'].'</span>';
                } else {
                    echo '<a href="customer.php" style="color:white">Trang chủ</a> /'.
                        '<span style="color:#ff7200">'.$detail['Name'].'</span>';
                }
            ?>
        </div>

    </div>


    <!--Content body -->
    <div class="container content">
        <div class="row">
            <?php

                if($check_exist == 1){
                    $cart_button = '<span><a class="btn btn-warning disabled" href="#" role="button">
                                        <i class="fas fa-shopping-cart"></i> Đã có trong giỏ hàng</a></span>';                    
                } else {
                    $cart_button = '<span><a class="btn btn-warning" href="#" role="button" 
                                            onclick = "confirmAddCart(`'.$_SESSION['account'][0].'`,`'.$detail['Project_id'].'`)">
                                            <i class="fas fa-shopping-cart"></i> Đưa vào giỏ hàng của bạn</a></span>';
                }

                if($detail['State'] == 1){
                    $button_area = '<div class="button-area">
                                        <span><a class="btn btn-danger" href="#" role="button"
                                        onclick = "confirmOrder(`'.$_SESSION['account'][0].'`,`'.$detail['Project_id'].'`)">
                                        <i class="fas fa-money-bill-alt"></i> Đặt ngay</a></span>'.
                                        $cart_button.
                                    '</div>';
                } else {
                    $button_area = '<div class="button-area">
                                        <span><a class="btn btn-danger disabled" href="#" role="button"><i class="fas fa-ban"></i> Đã có người đặt</a></span>
                                    </div>';
                }

                // Tùy vào tài khoản có đang đăng nhập, ta thêm thông tin cho hợp lí
                if($name == ""){
                    echo '<div class="col-md-6">
                            <img src="'.$detail['Image'].'">
            
                        </div>
                        
                        <div class="col-md-6">
                            <h2 class="title-product" itemprop="name">'.$detail['Name'].'</h2>
                            <div>
                                <span><b>Diện tích: </b><span>'.$detail['Area'].' m2</span></span>
                                <span><b>Vị trí: </b><span>'.$detail['Location'].'</span></span>
                            </div>
                            <div class="price">'.$detail['Price'].' '.$detail['Unit'].'</div>
                            <b>Thông tin:</b>
                            <div class="description">
                                                    
                                <p>- Vị trí dự án: '.$detail['Location'].'.<br>
                                    - Chủ đầu tư: '.$detail['Investor'].'.<br>
                                    - Loại hình: '.$detail['Type'].'.<br>
                                    - Tổng diện tích đất: '.$detail['Area'].' m2.<br>
                                    - Hình thức: '.$detail['Kind_purchase'].'.<br>
                                </p>
                                                    
                            </div>'.

                            $button_area.
                              
                        '</div>';
                } else {

                    echo '<div class="col-md-6">
                            <img src="'.$detail['Image'].'">
            
                        </div>
                        
                        <div class="col-md-6">
                            <h2 class="title-product" itemprop="name">'.$detail['Name'].'</h2>
                            <div>
                                <span><b>Diện tích: </b><span>'.$detail['Area'].' m2</span></span>
                                <span><b>Vị trí: </b><span>'.$detail['Location'].'</span></span>
                            </div>
                            <div class="price">'.$detail['Price'].' '.$detail['Unit'].'</div>
                            <b>Thông tin:</b>
                            <div class="description">
                                                    
                                <p>- Vị trí dự án: '.$detail['Location'].'.<br>
                                    - Chủ đầu tư: '.$detail['Investor'].'.<br>
                                    - Loại hình: '.$detail['Type'].'.<br>
                                    - Tổng diện tích đất: '.$detail['Area'].' m2.<br>
                                    - Hình thức: '.$detail['Kind_purchase'].'.<br>
                                </p>
                                                    
                            </div>'.

                            $button_area.
                              
                        '</div>';
                }
            ?>
            

        </div>       
    </div>

    <!-- Add into cart Confirm Modal -->
    <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm dự án này vào giỏ hàng</h4>
                </div>
                <div class="modal-body">
                    Bạn có muốn thêm dự án này vào trong giỏ hàng của bạn?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" id="add-button" 
                        >Thêm vào giỏ hàng</button>
                </div>

            </div>

        </div>
    </div>

    <!-- Order Confirm Modal -->
    <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đặt mua dự án</h4>
                </div>
                <div class="modal-body">
                    Bạn muốn đặt mua dự án này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" id="order-button" 
                        >Đặt mua</button>
                </div>

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


<!-- .................................................Script....................................................... -->

<script>

    // Xác nhận thêm project vào giỏ hàng
    function confirmAddCart(id,project_id){

        $('#myModal1').modal({
            backdrop: 'static',
            keyboard: false
        });

        addCart(id,project_id)

    }

    // Gửi request yêu cầu thêm project vào giỏ hàng mà người dùng chọn
    function addCart(id,project_id){

        $('#add-button').click(function(e){

            $.post("../controller/add_project_into_cart_controller.php", {
                "user_id": id.toString(),
                "project_id": project_id.toString(),
            }, function(data, status) {

                // Thêm xong thì reload lại trang
                if(status){
                    alert(data)
                    location.reload()
                }
            })

        })
    }

    // Xác nhận đặt mua project
    function confirmOrder(id,project_id){

        $('#myModal2').modal({
            backdrop: 'static',
            keyboard: false
        })

        orderProject(id,project_id)

    }

    // Gửi request yêu cầu thêm project vào lịch sử đặt mua
    function orderProject(id,project_id){

        $('#order-button').click(function(e){

            $.post("../controller/order_controller.php", {
                "user_id": id.toString(),
                "project_id": project_id.toString(),
            }, function(data, status) {

                // Thêm xong thì reload lại trang
                if(status){
                    alert(data)
                    location.reload()
                }
            })

        })
    }
</script>

<!-- ...........................................................End Script........................................... -->