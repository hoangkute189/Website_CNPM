<?php

    // Kiểm tra admin có đang đăng nhập
    session_start();
    if(!isset($_SESSION['account'])){
        header("location: login.php");
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

    <link href="./css/style_add_account.css" rel="stylesheet">
</head>
<body>

    <!-- Menu, banner-->
    <div class="menu">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">

                </ul>

                <ul class="navbar-nav mr-1">
                    <li class="nav-item">
                        <i class="fas fa-user"></i> <?php echo $_SESSION['account'][1]?>
                        
                        <a class="btn btn-danger" href="..\controller\logout_controller.php" role="submit">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container mt-4 shadow-lg">
            <div class="form-area p-4">
                <h2 class="bg-warning p-2"><i class="fas fa-user-plus"></i> Thêm tài khoản mới</h2>

                <form method = "post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Tên tài khoản</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" id="name">
                                
                        </div>
                        <div class="form-group col-md-3">
                            <label for="gender">Giới tính</label>
                            <select id="gender" class="form-control">
                                <option>Nam</option>
                                <option>Nữ</option>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone">
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="permission">
                        <label class="form-check-label" for="permission">
                            Quyền Admin
                        </label>
                    </div>

                    <p id="error" style="color: red"></p>
                    <p id="success" style="color: green"></p>
                    <button type="submit" class="add_account btn btn-danger">Thêm tài khoản</button>
                </form>

            </div>
        
        </div>
    </div>

    <!-- Add Confirm Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm tài khoản</h4>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn là muốn thêm tài khoản?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" id="add-button" 
                        onclick="addAccount()">Thêm</button>
                </div>

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

    $('.add_account').click(function(e){

        var username = $('#username').val()
        var password = $('#password').val()
        var name = $('#name').val()
        var email = $('#email').val()
        var gender = $('#gender').val()
        var phone = $('#phone').val()
        
        // Kiểm tra có lỗi nhập từ người dùng
        var error_message = showMessageError(username, password, name, email, gender, phone)

        // Hiện thông báo lỗi cho người dùng
        if(error_message != ""){
            e.preventDefault()
            error.innerHTML = error_message
            return
        }
        
        // Hiện bảng thông báo xác nhận thêm tài khoản
        e.preventDefault()
        confirmAdd()
        
    })
}


// Kiểm tra đúng kiểu email
function isEmail(email){

    return /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(email);
}

// Kiểm tra các input do người dùng nhập
function showMessageError(username, password, name, email, gender, phone){

    var error_message = ""

    // Kiểm tra phone
    if(phone == ""){
        error_message = "Vui lòng nhập số điện thoại"
    }

    // Kiểm tra chọn giới tính
    if(gender == null){
        error_message = "Vui lòng chọn giới tính"
    }

    // Kiểm tra email
    if(!isEmail(email)) {
        error_message = "Email bạn nhập không phù hợp"
    }

    // Kiểm tra tên
    if(name == "") {
        error_message = "Vui lòng nhập tên"
    }

    // Kiểm tra password
    if(password == ""){
        error_message = "Vui lòng nhập mật khẩu"
    } else if(password.length < 5){
        error_message = "Mật khẩu của bạn không được ít hơn 5 kí tự"
    }

    // Kiểm tra username
    if(username == ""){
        error_message = "Vui lòng nhập tên đăng nhập"
    }
    
    return error_message
}

function confirmAdd(){

    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
}

// Gửi request để thêm tài khoản
function addAccount(){

    var username = $('#username').val()
    var password = $('#password').val()
    var name = $('#name').val()
    var email = $('#email').val()
    var gender = $('#gender').val()
    var phone = $('#phone').val()
    var address = $('#address').val()
    var permission = 0

    if($('#permission').is(":checked")){
        var permission = 1
    } 

    $.post("../controller/admin_addAccount_controller.php", {
        "username": username,
        "password": password,
        "name": name,
        "email": email,
        "gender": gender,
        "address": address,
        "phone": phone,
        "permission": permission
    }, function(data, status) {

        // Thêm thành công thì thông báo và yêu cầu về trang chính admin
        if(status){
            if(data == "Thêm tài khoản thành công"){
                $('#error').hide();
                $('#myModal').modal('hide')
                $('#success').html(data + '<a href="admin.php" style = "color:orange"> Quay về trang Admin</a>')
            } else {
                $('#error').hide();
                $('#myModal').modal('hide')
                $('#success').html(data + '<a href="admin.php" style = "color:orange"> Quay về trang Admin</a>')
            }
        }
    })
}


</script>

<!-- .....................................................End Script....................................................... -->