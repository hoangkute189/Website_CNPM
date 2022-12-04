<?php

    // Kiểm tra admin có đang đăng nhập
    session_start();
    if(!isset($_SESSION['account'])){
        header("location: login.php");
    }

    $name = "";
    $investor = "";
    $location = "";
    $image = "";
    $description = "";
    $kind_purchase = "";
    $area = "";
    $type = "";
    $price = "";
    $unit = "";

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

    <link href="./css/style_update_project.css" rel="stylesheet">
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
                <a class="btn btn-danger my-2" href="admin.php">Quay về trước</a>
                <h2 style="text-align:center" class="bg-warning p-2"><i class="fas fa-users-cog"></i> Dự án</h2>

                <form method = "post">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name_project">Tên dự án</label>
                            <input type="text" class="form-control" id="name_project">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="investor">Chủ đầu tư</label>
                            <input type="text" class="form-control" id="investor">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label for="location">Vị trí</label>
                            <input type="text" class="form-control" id="location">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="place">Tỉnh/thành phố</label>
                            <select id="place" class="form-control">
                                <option value="0001">Hà Nội</option>
                                <option value="0002">TP Hồ Chí Minh</option>
                                <option value="0003">Đồng Tháp</option>
                                <option value="0004">TP Đà Nẵng</option>
                                <option value="0005">Ninh Thuận</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Ảnh dự án</label>
                        <input type="text" class="form-control" id="image">
                    </div>

                    <div class="form-group">
                        <input type="file" class="form-control-file" id="upload_file">
                    </div>

                    <div class="form-group">
                        <label for="description">Giới thiệu chi tiết dự án</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="kind_purchase">Loại hình mua bán</label>
                            <select id="kind_purchase" class="form-control">
                                <option value="Cho thuê">Cho thuê</option>
                                <option value="Cho bán">Cho bán</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="area">Diện tích (m2)</label>
                            <input type="number" class="form-control" id="area">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="type">Loại bất động sản</label>
                            <select id="type" class="form-control">
                                <option value="Căn hộ">Căn hộ</option>
                                <option value="Mặt bằng">Mặt bằng</option>
                                <option value="Chung cư">Chung cư</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label for="price">Giá tiền</label>
                            <input type="number" class="form-control" id="price">
                                
                        </div>
                        <div class="form-group col-md-2">
                            <label for="unit">Đơn vị tính</label>
                            <input type="text" class="form-control" id="unit">
                        </div>
                    </div>

                    <p id="error" style="color: red"></p>
                    <p id="success" style="color: green"></p>
                    <button type="submit" class="update btn btn-danger">Cập nhật</button>
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