<?php

    // Kiểm tra admin có đang đăng nhập
    session_start();
    if(!isset($_SESSION['account'])){
        header("location: login.php");
    }

    $name = "";
    $email = "";
    $address = "";
    $gender = "";
    $phone = "";
    $permission = "";
    $user_id = $_GET['id'];
    $user_name = "";

    require_once('../controller/information_user_controller.php');
    if (count($information_account) != 0){
        $user_name = $information_account['Username'];
        $name = $information_account['Name'];
        $email = $information_account['Email'];
        $address = $information_account['Address'];
        $gender = $information_account['Gender'];
        $phone = $information_account['Phone'];
        if($information_account['Permission'] == 1) {
            $permission = "checked";
        }

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

    <link href="./css/style_update_account.css" rel="stylesheet">
</head>
<body>

    <!-- Menu, banner-->
    <div class="menu">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <!-- <a class="navbar-brand" href="#">LOGO</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">

                </ul>

                <ul class="navbar-nav mr-1">
                    <li class="nav-item">
                        <i class="fas fa-user"></i> <?php echo $_SESSION['account'][1];?>
                        
                        <a class="btn btn-danger" href="..\controller\logout_controller.php" role="submit">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container mt-4 shadow-lg">
            <div class="form-area p-4">
                <h2 class="bg-warning p-2"><i class="fas fa-users-cog"></i> Tài khoản: <?php echo $user_name;?></h2>

                <form method = "post">

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
                        <div class="form-group col-md-3">
                            <label for="gender">Giới tính: <span style="color:red"><?php echo $gender;?></span></label>
                            <select id="gender" class="form-control">
                                <option>Nam</option>
                                <option>Nữ</option>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" value=<?php echo $phone;?>>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="permission" <?php echo $permission;?>>
                        <label class="form-check-label" for="permission">
                            Quyền Admin
                        </label>
                    </div>

                    <p id="error" style="color: red"></p>
                    <p id="success" style="color: green"></p>
                    <button type="submit" class="update_account btn btn-danger">Cập nhật</button>
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
                        onclick="updateInformation(<?php echo $user_id?>)">Cập nhật ngay</button>
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

        $('.update_account').click(function(e){

            var name = $('#name').val()
            var email = $('#email').val()
            var gender = $('#gender').val()
            var phone = $('#phone').val()
            
            // Kiểm tra có lỗi nhập từ người dùng
            var error_message = showMessageError(name, email, gender, phone)

            // Hiện thông báo lỗi cho người dùng
            if(error_message != ""){
                e.preventDefault()
                error.innerHTML = error_message
                return
            }
            
            // Hiện bảng thông báo xác nhận cập nhật tài khoản
            e.preventDefault()
            confirmUpdate()
            
        })
    }


    // Kiểm tra đúng kiểu email
    function isEmail(email){

        return /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(email);
    }

    // Kiểm tra các input do người dùng nhập
    function showMessageError(name, email, gender, phone){

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
        
        return error_message
    }

    function confirmUpdate(){

        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    // Gửi request để cập nhật thông tin
    function updateInformation(id){

        var name = $('#name').val().replace(/_/g, " ");
        var email = $('#email').val()
        var gender = $('#gender').val()
        var address = $('#address').val().replace(/_/g, " ");
        var phone = $('#phone').val()
        var permission = 0

        if($('#permission').is(":checked")){
            var permission = 1
        } 

        $.post("../controller/update_account.php", {
            "user_id": id.toString(),
            "name": name,
            "email": email,
            "gender": gender,
            "address": address,
            "phone": phone,
            "permission": permission
        }, function(data, status) {
            // Cập nhật xong thì về trang admin
            if(status){
                alert(data)
                $(location ).attr("href", "admin.php");
            }
        })
    }

</script>

<!-- .....................................................End Script....................................................... -->