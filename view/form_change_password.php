<?php

    session_start();
    if(!isset($_SESSION['account'])){
        header("location: index.html");
    }

    $user_id = $_SESSION['account'][0];
    $password = $_SESSION['account'][2];
    
    // Biến hiển thị thông báo lỗi
    $error = "";
    
    if (isset($_POST["btnConfirm"])){

        // Lấy mật khẩu hiện tại và mật khẩu mới do người dùng nhập
        $information = [
            'old_password' => $_POST['old_password'],
            'password' => $_POST['password']
        ];

        if($information['old_password'] != $password){
            $error = "Mật khẩu hiện tại chưa đúng";
        } else {

            // Gọi controller thực hiện 
            require_once('../controller/change_password_controller.php');
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
                <h2 class="bg-warning p-2"><i class="fas fa-user-shield"></i> Đổi mật khẩu</h2>

                <form method = "post">

                    <div class="form-group col-6">
                        <label for="old_password">Nhập mật khẩu hiện tại</label>
                        <input type="text" class="form-control" id="old_password" name="old_password">
                    </div>

                    <div class="form-group col-6">
                        <label for="password">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="form-group col-6">
                        <label for="re_password">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="re_password" name="re_password">
                    </div>
                    
                    <p id="error" style="color: red"> <?php echo $error;?></p>
                    <button type="submit" class="update btn btn-danger" name = "btnConfirm">Đổi mật khẩu</button>
                </form>

            </div>
        
        </div>
    </div>

</body>
</html>

<!-- .....................................................Script........................................................... -->

<script>

    $(function(){

        checkInput()
    })

    function checkInput(){

        $('button').click(function(e){
            
            var old_password = $('#old_password').val()
            var password = $('#password').val()
            var re_password = $('#re_password').val()

            // Kiểm tra có lỗi nhập từ người dùng
            var error_message = showMessageError(old_password, password, re_password)

            // Hiện thông báo lỗi cho người dùng
            if(error_message != ""){
                e.preventDefault()
                error.innerHTML = error_message
            }
            
        })
    }

    function showMessageError(old_password, password, re_password){

        var error_message = ""

         // Kiểm tra re-password
        if(re_password != password){
            error_message = "Xác thực mật khẩu không đúng"
        }

        // Kiểm tra password
        if(password == ""){
            error_message = "Vui lòng nhập mật khẩu mới"
        } else if(password.length < 5){
            error_message = "Mật khẩu mới của bạn không được ít hơn 5 kí tự"
        }

        // Kiểm tra old-password
        if(old_password == ""){
            error_message = "Vui lòng nhập mật khẩu cũ"
        }
        
        return error_message
    }


</script>

<!-- .....................................................End Script....................................................... -->