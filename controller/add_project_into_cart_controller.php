<?php

    require ('connection.php');

    // Thêm project vào giỏ hàng
    $user_id = $_POST['user_id'];
    $project_id = $_POST['project_id'];
    
    $sql = "INSERT INTO `Cart` (`User_id`, `Project_id`) VALUES ('$user_id', '$project_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm vào giỏ hàng thành công";
    } else {
        echo "Thêm vào giỏ hàng thất bại";
    }
    $conn -> close();

?>