<?php

    // Biến hiển thị thông báo lỗi
    $error = "";
    
    if (isset($_POST["btnConfirm"])){

        // Lấy input username và email người dùng nhập
        $information = [
            'email' => $_POST['email'],
            'username' => $_POST['username']
        ];

        // Gọi controller thực hiện 
        require_once('../controller/send_mail_controller.php');
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
            
            <!-- Form forget password -->
            <form id="form-signup" method = "post">
                <h2 class="form-heading"><i class="fas fa-unlock"></i> Lấy lại mật khẩu</h2>
        
                <fieldset>
                    <legend id="field-info">Thông tin tài khoản đã đăng ký</legend>
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
                                <label for="email">Email:</label>
                            </td>
                            <td class="col2">
                                <input type="email" style="color:white" class="form-in" id="email" name="email" placeholder="Email" >
                            </td>
                        </tr>
                        
                       
                    </table>
                </fieldset>
        
        
                <p id="error" style="color: red"><?php echo $error;?></p>
        
                <button type="submit" class="signup-submit" name = "btnConfirm">Xác nhận</button>
        
                <div class="return-login">
                    <a href="login.php">Quay về đăng nhập</a>
                </div>
        
            </form>
                
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
            
            var username = $('#username').val()
            var email = $('#email').val()

            // Kiểm tra có lỗi nhập từ người dùng
            var error_message = showMessageError(username, email)

            // Hiện thông báo lỗi cho người dùng
            if(error_message != ""){
                e.preventDefault()
                error.innerHTML = error_message
            }
            
        })
    }

    // Kiểm tra đúng kiểu email
    function isEmail(email){

        return /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(email);
    }

    function showMessageError(username, email){

        var error_message = ""

        // Kiểm tra email
        if(!isEmail(email)) {
            error_message = "Email bạn nhập không phù hợp"
        }

        // Kiểm tra username
        if(username == ""){
            error_message = "Vui lòng nhập tên đăng nhập"
        }
        
        return error_message
    }


</script>

<!-- .....................................................End Script....................................................... -->