<?php

    require_once ('connection.php');

    $id = $user_id;
    $password = $information['password'];

    // Cập nhật mật khẩu
    $sql = "UPDATE `User` SET `Password` = '$password' WHERE `User_id` = '$id';";

    if($conn->query($sql) === TRUE){
        $error = "Cập nhật mật khẩu thành công";
    }
    $conn -> close();
    
?>