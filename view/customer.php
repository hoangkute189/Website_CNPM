<?php

    // Kiểm tra có đang đăng nhập
    session_start();
    if(!isset($_SESSION['account'])){
        header("location: index.html");
    }

    $name = $_SESSION['account'][1];
    
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

    <link href="./css/style.css" rel="stylesheet">
</head>

<!-- ...........................................................Script........................................................... -->

<script>

    // Lấy dự án từ model
    function getProject(){

        $.get("../model/project_list.php", function(data, status) {
            if (status) {
                showDataHotProject(data)
                showDataNewProject(data)
            }
        }, "json");
    }

    // Hiện các dự án nổi bật lên màn hình
    function showDataHotProject(data){    

        var tbody = $('#project_hot')
        var total = data.length

        for (var i = 0; i < total; i++) {
            
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

            if(classify == "HOT"){
                var div= `<div class="col-md-6 col-lg-4 my-2">
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

    // Hiện dự án mới nhất
    function showDataNewProject(data){    

        var total = data.length
        var count = 0;

        // Hiện các dự án mới lên màn hình
        for (var i = 0; i < total; i++) {
            
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

            if(classify == "NEW"){
                var div = `<div class="col-md-4 my-2">
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
                
                // Chỉ hiện 9 dự án mới nhất
                if(count < 9){
                    num_rows = Math.ceil(i/3)
                    $(`#row_${num_rows}`).append(div)
                }

            }

        }
    }

    $(function(){

        getProject()
    })

</script>

<!-- .............................................................End Script..................................................... -->

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
                <ul class="navbar-nav mr-auto ">

                    <li class="nav-item active">
                        <a class="nav-link" href="">Trang chủ <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="introduce.php">Giới thiệu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="contact.php">Liên hệ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tài Khoản
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="cart.php">Giỏ hàng của bạn</a>
                            <a class="dropdown-item" href="history_order.php">Lịch sử đặt mua</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="information_user.php">Thông tin tài khoản</a>
                        </div>
                    </li>

                </ul>

                <ul class="navbar-nav mr-1">
                    <li class="nav-item">
                        <i class="fas fa-user" style="color:white"></i><span style="color:white"> <?php echo $name;?> </span>
                        <a class="btn btn-danger" href="..\controller\logout_controller.php" role="button">Đăng Xuất</a>
                    </li>
                </ul>
            </div>

        </nav>

        <div class="content-menu">
            <h1 class="title-name">BẤT ĐỘNG SẢN 24h</h1>
            <h3>Giao dịch bất động sản nhanh hơn cách người yêu lật mặt</h3>
            <button type="button" class="btn btn-outline-light btn-lg">
                <a href="#du_an_noi_bat" style="color:#ff7200">Dự án nổi bật</a>
            </button>
            <button type="button" class="btn btn-warning btn-lg">
                <a href="#du_an_moi_nhat" style="color:black">Dự án mới nhất</a>
            </button>
        </div>

    </div>

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


    <!-- body 1-->
    <div class="container">

        <!-- Dự án nổi bật -->
        <div class="row">
            <div class="col-12">
                <div class="description">
                    <a name="du_an_noi_bat"></a>
                    <p><i class="fas fa-fighter-jet"></i></p>
                    <h2>Dự án BĐS nổi bật</h2>
                    <p>Tổng hợp các dự án bất động sản tại Hà Nội, Đà Nẵng, TP Hồ Chí Minh...và cách tỉnh thành khác hot nhất thời điểm hiện tại</p>
                </div>
            </div>
        </div>

        <!-- Nơi hiện các card project HOT -->
        <div class="row" id = "project_hot">

        </div>

    </div>
   
    <!-- Banner Why -->
    <div class="why">
        <div class="container-fluid padding">	
            <div class="row text-left">
                <div class="col-12 why-title">
                    <h2>Tại sao lại chọn bất động sản 24h?</h2>
                    <p>Chúng tôi cung cấp đầy đủ và chính xác nhất thông tin các dự án bất động sản trên toàn quốc song hành với dịch vụ tư vấn nhanh chóng và hiệu quả</p>
                </div>
                <div class="col-md-4 why-cell">
                    <i class="fas fa-cog"></i>
                    <div class="explain">
                        <h5>Chất lượng tốt nhất</h5>
                        <p>Nghiên cứu, thiết kế và đầu tư xây dựng với hệ thống dịch vụ chất lượng tốt</p>
                    </div>
                </div>
                <div class="col-md-4 why-cell">
                    <i class="fas fa-search"></i>
                    <div class="explain">
                        <h5>Tìm kiếm thông tin dễ dàng</h5>
                        <p>Tìm kiếm bất động sản bạn mong muốn theo danh mục một cách dễ dàng </p>
                    </div>
                </div>
                <div class="col-md-4 why-cell">
                    <i class="fas fa-project-diagram"></i>
                    <div class="explain">
                        <h5>Kết nối với chủ đầu tư</h5>
                        <p>Hỗ trợ bạn tiếp cận đến những sản phẩm và giúp bạn có trải nghiệm dịch vụ tốt nhất</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Body 2 -->
    <div class="container">

        <!-- Bất động sản mới nhất -->
        <div class="row">
            <div class="new-item">
                <a name="du_an_moi_nhat"></a>
                <h3><i class="fas fa-newspaper"></i> Bất động sản mới nhất</h3>
            </div>
        </div>

        <!-- Swiper -->
        <div class="row">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="row" id="row_1">
                            
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="row" id="row_2">

                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="row" id="row_3">

                        </div>
                    </div>
                    
                </div>
                <!-- End swiper wrapper -->

                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
            </div>
            <!-- End swiper container -->
            
        </div>
        <!-- End Swiper -->
    </div>
<!-- End Body 2 -->

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

<!-- script swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
     navigation: {
       nextEl: '.swiper-button-next',
       prevEl: '.swiper-button-prev',
     },
   });
</script>
