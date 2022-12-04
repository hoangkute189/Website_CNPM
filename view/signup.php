<?php

    // Biến hiển thị thông báo lỗi
    $error = "";
    
    if (isset($_POST["btnSignUp"])){

        // Lấy input username và password người dùng nhập
        $information = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'gender' => $_POST['choose_gender'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        // Gọi các controller thực hiện 
        require_once('../controller/signup_controller.php');
    }

?>

<!-- ............................................................HTML........................................................... -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng ký</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style_signup.css">
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
                        <a class="nav-link" href="index.html">Trang chủ <span class="sr-only">(current)</span></a>
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
            
            <!-- Form sign up -->
            <form id="form-signup" method = "post">
                <h2 class="form-heading"><i class="fas fa-user-plus"></i> Đăng kí tài khoản</h2>
                <fieldset>
                    <legend id="field-info">Thông tin cá nhân</legend>
                    <table>
                        <tr>
                            <td class="col1">
                                <label for="name">Họ tên:</label>
                            </td>
                            <td class="col2">
                                <input type="text" style="color:white" class="form-in" id="name" name="name" placeholder="Họ tên">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label for="email">Email:</label>
                            </td>
                            <td class="col2">
                                <input type="email" style="color:white" class="form-in" id="email" name="email" placeholder="Email" >
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label for="gender">Giới tính:</label>
                            </td>
                            <td class="col2">
                                <input type="radio" id="nam" name="choose_gender" value="nam">
                                <label for="nam">Nam</label>
                                <input type="radio" id="nu" name="choose_gender" value="nu">
                                <label for="nu">Nữ</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label for="address">Địa chỉ:</label>
                            </td>
                            <td class="col2">
                                <input type="text" style="color:white" class="form-in" id="address" name="address" placeholder="Địa chỉ" >
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label for="phone">Số điện thoại:</label>
                            </td>
                            <td class="col2">
                                <input type="tel" style="color:white" class="form-in" id="phone" name="phone" placeholder="Số điện thoại" pattern="[0-9]{10}" required>
                            </td>
                        </tr>
                    </table>
                </fieldset>
        
                <fieldset>
                    <legend id="field-info">Tài khoản</legend>
                    <table>
                        <tr>
                            <td class="col1">
                                <label for="username">Tên đăng nhập:</label>
                            </td>
                            <td class="col2">
                                <input type="text" style="color:white" class="form-in" id="username" name="username" placeholder="Tên đăng nhập">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label for="password">Mật khẩu:</label>
                            </td>
                            <td class="col2">
                                <input type="password" style="color:white" class="form-in" id="password" name="password" placeholder="Mật khẩu">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label for="re_password">Xác thực mật khẩu:</label>
                            </td>
                            <td class="col2">
                                <input type="password" style="color:white" class="form-in" id="re_password" name="re_password" placeholder="Xác thực mật khẩu" >
                            </td>
                        </tr>
                       
                    </table>
                </fieldset>
        
        
                <p id="error" style="color: red"><?php echo $error;?></p>
        
                <button type="submit" class="signup-submit" name = "btnSignUp">Đăng kí</button>
        
                <div class="return-login">
                    <a href="login.php">Quay về đăng nhập</a>
                </div>
        
            </form>
                
        </div>
    </div>

    <script src="../controller/signup.js"></script>
    
</body>
</html>