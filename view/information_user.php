<?php

    $username = "";
    $password = "";
    $name = "";
    $email = "";
    $address = "";
    $gender = "";
    $phone = "";

    session_start();
    if(!isset($_SESSION['account'])){
        header("location: index.html");
    }

    $user_id = $_SESSION['account'][0];

    require_once('../controller/information_user_controller.php');
    if (count($information_account) != 0){
        $username = $information_account['Username'];
        $password = $information_account['Password'];
        $name = $information_account['Name'];
        $email = $information_account['Email'];
        $address = $information_account['Address'];
        $gender = $information_account['Gender'];
        $phone = $information_account['Phone'];

        // Do form:input không hiển thị dấu khoảng trắng từ php
        // Cần dùng dấu "_" để thay thế khoảng trắng
        $name_replace = str_replace(" ", "_", $name);
        $address_replace = str_replace(" ", "_", $address);
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

    <link href="./css/style_information_user.css" rel="stylesheet">
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
                            <a class="dropdown-item" href="history_order.php">Lịch sử đặt mua</a>
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

        <div class="container mt-4 shadow-lg">
            <div class="form-area p-4">
                <h2 class="bg-warning p-2"><i class="fas fa-users-cog"></i> Thông tin tài khoản</h2>

                <form method = "post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Tên tài khoản</label>
                            <input type="text" class="form-control" id="username" value=<?php echo $username;?> readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" value=<?php echo $password;?> readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <p></p><br>
                            <a class="bg-danger p-2 text-white" href="form_change_password.php" role="button">Đổi mật khẩu</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" value=<?php echo $address_replace;?>>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" value=<?php echo $email;?>>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" id="name" value=<?php echo $name_replace;?>>
                                
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Giới tính: <span style="color:red"><?php echo $gender;?></span></label>
                            <select id="gender" class="form-control">
                                <option>Nam</option>
                                <option>Nữ</option>

                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" value=<?php echo $phone;?>>
                        </div>
                    </div>

                    <p id="error" style="color: red"></p>
                    <button type="submit" class="update btn btn-danger">Cập nhật</button>
                </form>

            </div>
        
        </div>
    </div>

    <!-- Update Confirm Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cập nhật tài khoản</h4>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn là muốn cập nhật thông tin?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete-button" 
                        onclick="updateInformation(<?php echo $_SESSION['account'][0]?>)">Cập nhật ngay</button>
                </div>

            </div>

        </div>
    </div>

</body>
</html>

<script src="../controller/update_information_user.js"></script>