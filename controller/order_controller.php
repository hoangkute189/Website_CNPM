<?php

    require ('connection.php');

    
    $user_id = $_POST['user_id'];
    $project_id = $_POST['project_id'];

    // Thêm project vào giỏ hàng
    $sql1 = "INSERT INTO `Order project` (`User_id`, `Project_id`, `State_order`) VALUES ('$user_id', '$project_id', 0)";
    
    // Set lại project này đã có người đặt
    $sql2 = "UPDATE `Project` SET `State` = 0 WHERE `Project`.`Project_id` = '$project_id'";

    if ($conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE) {
        echo "Đặt mua thành công";
    } else {
        echo "Đặt mua thất bại";
    }

    // Nếu project có trong cart của người dùng này thì xóa
    $sql3 = "DELETE FROM `Cart` WHERE User_id = '$user_id' AND Project_id = '$project_id'";
    $conn->query($sql3);
    
    $conn -> close();

?>