<?php

    // ............................ Lấy dữ liệu từ form đăng ký và xử lý .................................................

    $username_input = $information['username'];
    $password_input = $information['password'];
    $name_input = $information['name'];
    $email_input = $information['email'];
    $gender_input = $information['gender'];
    $address_input = $information['address'];
    $phone_input = $information['phone'];

    // Kiểm tra tài khoản đăng ký có tồn tại ?
    $check_signup = checkExistAccount($username_input);

    
    if(!$check_signup[0]){

        // Thông báo cho người dùng biết tài khoản tồn tại
        $error = $check_signup[1];
    } else {

        // Thêm dữ liệu người dùng đăng ký vào cơ sở dữ liệu
        $newid = getNewID();
        $error = addAccount($newid, $username_input, $password_input, $name_input, $email_input, 
        $gender_input, $address_input, $phone_input);
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

    function addAccount($newid, $username_input, $password_input, $name_input, $email_input, $gender_input, $address_input, $phone_input){

        require ('connection.php');

        $message = "";
        $sql1 = "INSERT INTO User(User_id,Username,Password,Permission) 
            VALUES('$newid','$username_input','$password_input','0')";

        $sql2 = "INSERT INTO Account(Account_id,User_id,Name,Address,Phone,Gender,Email) 
            VALUES('$newid','$newid','$name_input','$address_input','$phone_input','$gender_input','$email_input')";
        if ($conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE) {
            $message = "Đăng ký thành công";
        } else {
            $message = "Đăng ký thất bại";
        }
        $conn->close();

        return $message;
    }

?>