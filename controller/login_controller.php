<?php

    session_start();

    $error = "";
    if (isset($_POST["btnLogin"])){

        // Lấy input username và password người dùng nhập
        $username_input = $_POST['username'];
        $password_input = $_POST['password'];
        
        // Gọi API lấy danh sách các User -> $user_list
        require_once ('../model/get_userlist.php');
        $check_login = checkUser($user_list, $username_input, $password_input);

        // Nếu tài khoản không tồn tại, hiển thị thông báo
        $error = messageLogin($check_login[0]);

        // Nếu tài khoản tồn tại, truy cập vào trang admin/ trang chủ khách hàng (tùy vào quyền truy cập của tài khoản)
        $info_user = $check_login[1];
        accessWebsite($info_user);
    }

    // ..................................... Các hàm con ....................................................

    // Kiểm tra trong cơ sở dữ liệu có username với password mà người dùng nhập không
    // Nếu có thì trả về thông tin của user đấy
    function checkUser($user_list, $username_input, $password_input) {

        foreach ($user_list as $column){
            if($column['Username'] == $username_input and $column['Password'] == $password_input){
                return [true,$column];
            }
        }
        return [false,null];
    }

    function messageLogin($check_login){

        if($check_login){
            return ;
        } 

        return "Tên đăng nhập hoặc mật khẩu không đúng";
    }

    // Đăng nhập vào trang admin nếu có quyền truy cập admin, còn không thì vào trang chủ
    function accessWebsite($info_user){

        if($info_user != null and !isset($_SESSION['account'])){
            $_SESSION['account'] = [$info_user["User_id"],$info_user["Username"], $info_user["Password"]];
        }

        if($info_user != null and $info_user["Permission"] == 1){
            header("location: admin.php");
        }

        if($info_user != null and $info_user["Permission"] == 0){
            header("location: customer.php");
        }
    }

?>