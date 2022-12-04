<?php

    require ('../controller/login_controller.php');

?>

<!-- ............................................................HTML........................................................... -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="main">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="logo"><img src="images/logo.png" alt=""></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Trang chủ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="introduce.php">Giới thiệu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="contact.php">Liên hệ</a>
                    </li>

                </ul>
                
            </div>
        </nav>

        <!-- content -->
        <div class="content">
            <h1>Welcome to <br><span>Bất động sản 24h</span> <br>Website</h1>
            <p class="par">Giúp bạn dễ dàng nhanh chóng tiếp cận với toàn bộ mặt bằng, nhà đất trên toàn quốc
                <br> Với hàng trăm khu nhà thuê, đất bán đa dạng phong phú
                <br> Kèm theo đó là giá cả cực kì phải chăng
                <br> Còn chần chừ gì nữa mà không chọn ngay cho mình một nơi lí tưởng?</p>

            
            <!-- Form login -->
            <div class="form">
                <h2>Đăng nhập</h2>
                <form method="post">
                    <i class="fas fa-user"></i>  
                    <input type="text" id="username" name="username" placeholder="Tên đăng nhập"><br> 
                    <i class="fas fa-key"></i>
                    <input type="password" id="password" name="password" placeholder="Mật khẩu">
                    <button type="submit" class="btnn" name="btnLogin">Đăng nhập</button>
                </form>
                
                <a href="forget_password.php" style="padding-top:10px;padding-bottom:10px">Quên mật khẩu?</a>
                <p id="error" style="color:red"><?php echo $error; ?></p>
                <p class="link">Bạn chưa có tài khoản?<br>
                <a href="signup.php">Đăng kí ngay</a></p>


            </div>
                
        </div>
    </div>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="../controller/login.js"></script>
    
</body>
</html>
