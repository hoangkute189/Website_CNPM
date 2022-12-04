<?php

    require_once ('connection.php');

    // Lấy các giá trị từ form gửi lên
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $permission = $_POST['permission'];

    // Thay đổi lại cấu trúc id
    if ($user_id <10){
        $user_id = "000{$user_id}";
    } else if ($user_id <100){
        $user_id = "00{$user_id}";
    } else if ($user_id <1000){
        $user_id = "0{$user_id}";
    } else{
        $user_id = "{$user_id}";
    }

    $sql1 = "UPDATE `account` SET `Name` = '$name', `Email` = '$email',
         `Gender` = '$gender', `Address` = '$address', `Phone` = '$phone' WHERE `account`.`Account_id` = '$user_id';";

    $sql2 = "UPDATE `User` SET `Permission` = '$permission' WHERE `User_id` = '$user_id';";

    if($conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE){
        echo "Cập nhật thành công";
    } else {
        echo "Cập nhật thất bại";
    }

    $conn -> close();
?>