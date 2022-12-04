<?php

    session_start();
    if(!isset($_SESSION['account'])){
        header("location: index.html");
    }

    require('../model/get_history_order.php');
    $history_order = $order;

?>

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

    <link href="./css/style_history_order.css" rel="stylesheet">
</head>
<body>

    <!-- Menu, banner-->
    <div class="menu">
        
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="logo"><img src="images/logo.png" alt=""></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">

                    <li class="nav-item">
                        <a class="nav-link" href="customer.php">Trang chủ <span class="sr-only">(current)</span></a>
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
                            <a class="dropdown-item" href="#">Lịch sử đặt mua</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="information_user.php">Thông tin tài khoản</a>
                        </div>
                    </li>

                </ul>

                <ul class="navbar-nav mr-1">
                    <li class="nav-item">
                        <i class="fas fa-user" style="color:white"></i><span style="color:white"> <?php echo $_SESSION['account'][1];?> </span>
                        <a class="btn btn-danger" href="..\controller\logout_controller.php" role="button">Đăng Xuất</a>
                    </li>
                </ul>
            </div>

        </nav>

        <!-- Bảng danh sách các dự án đã order -->
        <div class="container mt-4 shadow-lg">
            <div class="form-area p-4">

                <h2 class="bg-warning p-2"><i class="fas fa-history"></i> Lịch sử đặt mua</h2>
                
                <!-- Khu vực hiển thị bảng -->
                <div class="panel-body"> 
                    
                    <?php

                        echo '<div>Số lượng dự án đã đặt: '.count($history_order).'</div>';
                    ?>
                    <table class="table table-striped table-list"> 
                        <tbody>
                            <?php

                                // Hiển thị toàn bộ các project đã order
                                foreach($history_order as $item){

                                    // Hiện thị dựa theo trạng thái order
                                    if($item['State_order'] == 1){

                                        $state = '<td style="color:green">Đặt thành công</td>';
                                    } else {
                                        $state = '<td style="color:red">Chưa duyệt</td>';
                                    }

                                    echo '<tr> 
                                            <td class="project_image">
                                                <img src="'.$item['Image'].'" alt="">
                                            </td> 
                                            <td>'.$item['Name'].'</td> 
                                            <td>'.$item['Kind_purchase'].'</td> 
                                            <td>'.$item['Price'].' '.$item['Unit'].'</td>'.
                                            $state.
                                        '</tr> ';
                                }
                            ?>

                        </tbody>
                    </table> 

                </div>

            </div>
        
        </div>
        <!-- End danh sách  -->

    </div>

</body>
</html>

