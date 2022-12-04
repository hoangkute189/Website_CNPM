<?php

    // Kiểm tra có tài khoản đang đăng nhập
    session_start();
    $name = "";
    if(isset($_SESSION['account'])){
        $name = $_SESSION['account'][1];
    }

    // Lấy thông tin từ form người dùng đã chọn
    $place = $_POST['select_place'];
    $kind_purchase = $_POST['select_kind_purchase'];
    $type = $_POST['select_type'];

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

    <link href="./css/style_search.css" rel="stylesheet">
</head>

<!-- ..........................................................Script........................................................... -->

<script>

    // Lấy dự án từ model
    function getProject(){

        $.get("../model/project_list.php", function(data, status) {
            if (status) {
                showSearchResult(data)
            }
        }, "json");
    }

    // Hiện các dự án nổi bật lên màn hình
    function showSearchResult(data){    

        var tbody = $('#search_result')
        var total = data.length

        for (var i = 0; i < total; i++) {
            
            // Lấy các thông tin từ project
            var project_id = data[i].Project_id
            var name = data[i].Name
            var location = data[i].Location 
            var area = data[i].Area
            var description = data[i].Description 
            var image = data[i].Image 
            var kind_purchase = data[i].Kind_purchase 
            var classify = data[i].Classify
            var price = data[i].Price
            var unit = data[i].Unit
            var type = data[i].Type
            var name_region = data[i].Name_region

            // Lấy thông tin người dùng đang tìm kiếm
            var search_place = '<?php echo $place?>' == "0" ? name_region : '<?php echo $place?>'
            var search_kind_purchase = '<?php echo $kind_purchase?>' == '0' ? kind_purchase : '<?php echo $kind_purchase?>'
            var search_type = '<?php echo $type?>' == '0' ? type : '<?php echo $type?>'

            // Hiện các project ứng với các thông tin yêu cầu
            if(name_region == search_place && kind_purchase == search_kind_purchase && type == search_type){
                var div= `<div class="col-md-6 col-lg-3 my-2">
                            <div class="card border bg-white rounded">
                                <div class="card-image">
                                    <a href="detail_project.php?id=${project_id}"><img src="${image}" alt="" src="#"></a>
                                </div>
                                <div class="lable-left">${kind_purchase}</div>
                                <div class="lable-right">${classify}</div>
                                <div class="title">
                                    <a href="detail_project.php?id=${project_id}">${name}</a>
                                </div>
                                <div class="card-info">
                                    <p>${description}</p>
                                    <p><i class="fas fa-map-marker-alt"></i>${location}, ${name_region}</p>
                                    <p><i class="fas fa-building"></i> Loại BĐS: ${type}</p>
                                    <p><i class="fas fa-arrows-alt"></i> Diện tích: ${area}m vuông</p>
                                </div>
                                <div class="price">
                                    <div class="number-price">${price} ${unit}</div>
                                    <a href="detail_project.php?id=${project_id}" class="btnView">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>`
                tbody.append(div)                
            }
        }
    }

    $(function(){
        getProject()
    })

</script>

<!-- .............................................................End Script.................................................... -->

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
            <h1 class="title-name">Tìm kiếm nhanh</h1>
            <?php
                if($name == ""){
                    echo '<a href="index.html" style="color:white">Trang chủ</a> /' .
                        '<span style="color:#ff7200">Tìm kiếm nhanh</span>';
                } else {
                    echo '<a href="customer.php" style="color:white">Trang chủ</a> /' .
                        '<span style="color:#ff7200">Tìm kiếm nhanh</span>';
                }
            ?>
        </div>

    </div>
    
    <!-- Thanh tìm kiếm -->
    <div class="container-fluid">
        <form action="search.php" method="post">
            <div class="row search">
                <div class="col-lg-3 col-md-6">
                    Chọn tỉnh/thành phố<br>
                    <select name="select_place" id="select_tinh" class="form-control-sm form-control">
                        <option value="0">--Tỉnh/thành phố</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <option value="TP Hồ Chí Minh">TP Hồ Chí Minh</option>
                        <option value="Đồng Tháp">Đồng Tháp</option>
                        <option value="TP Đà Nẵng">TP Đà Nẵng</option>
                        <option value="Ninh Thuận">Ninh Thuận</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    Chọn thuê/mua luôn<br>
                    <select name="select_kind_purchase" id="select_kind_purchase" class="form-control-sm form-control">
                        <option value="0">--Thuê/mua luôn</option>
                        <option value="Cho thuê">Cho thuê</option>
                        <option value="Cho bán">Cho bán</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    Chọn loại bất động sản<br>
                    <select name="select_type" id="select_type" class="form-control-sm form-control">
                        <option value="0">--Loại bất động sản</option>
                        <option value="Căn hộ">Căn hộ</option>
                        <option value="Mặt bằng">Mặt bằng</option>
                        <option value="Chung cư">Chung cư</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <br>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-search"></i> Tìm kiếm nhanh</button>
                </div>
            </div>
        </form>
        
    </div>


    <!--Content body -->
    <div class="container-fluid content">
        <h3>Kết quả tìm kiếm</h3>

        <!-- Nơi hiện các kết quả tìm kiếm -->
        <div class="row" id = "search_result">

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


