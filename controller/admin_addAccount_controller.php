<?php

    // ............................ Lấy dữ liệu từ form và xử lý .................................................

    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $permission = $_POST['permission'];

    // Kiểm tra tài khoản có tồn tại ?
    $check_signup = checkExistAccount($username);

    if(!$check_signup[0]){
        // Thông báo cho người dùng biết tài khoản tồn tại
        echo $check_signup[1];
    } else {
        // Thêm dữ liệu người dùng đăng ký vào cơ sở dữ liệu
        $newid = getNewID();
        $message = addAccount($newid, $username, $password, $name, $email, 
        $gender, $address, $phone, $permission);
        echo $message;
    }

    // ..................................... Các hàm con ....................................................

    // Kiểm tra tài khoản tồn tại
    function checkExistAccount($username_input){

        require_once('../model/get_userlist.php');

        foreach($user_list as $user){
            if($user['Username'] == $username_input){
                return [false,"Tài khoản này đã tồn tại"];
            }
        }

        return [true,null];
    }

    // Hàm lấy id mới cho account
    function getNewID(){

        require ('connection.php');

        // Lấy id dòng cuối trong bảng
        $sql = "SELECT * FROM User";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $lastid = $row['User_id'];
            }
        } else {
            $lastid = "0";
        }


        // Tạo id mới cho dữ liệu được thêm vào
        $lastid = (int) $lastid + 1;
        if ($lastid <10){
            $newid = "000{$lastid}";
        } else if ($lastid <100){
            $newid = "00{$lastid}";
        } else if ($lastid <1000){
            $newid = "0{$lastid}";
        } else{
            $newid = "{$lastid}";
        }
        $conn->close();

        return $newid;
    }

    function addAccount($newid, $username_input, $password_input, $name_input, $email_input, $gender_input, $address_input, $phone_input, $permission){

        require ('connection.php');
        $message = "";

        $sql1 = "INSERT INTO User(User_id,Username,Password,Permission) 
            VALUES('$newid','$username_input','$password_input','$permission')";

        $sql2 = "INSERT INTO Account(Account_id,User_id,Name,Address,Phone,Gender,Email) 
            VALUES('$newid','$newid','$name_input','$address_input','$phone_input','$gender_input','$email_input')";

        if ($conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE) {
            $message = "Thêm tài khoản thành công";
        } else {
            $message = "Thêm tài khoản thất bại";
        }
        $conn->close();

        return $message;
    }
?>