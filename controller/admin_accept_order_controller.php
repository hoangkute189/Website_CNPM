<?php

    require ('connection.php');

    $project_id = $_POST['project_id'];

    $sql = "UPDATE `Order project` SET `State_order` = '1' WHERE `Project_id` = '$project_id';";

    if($conn->query($sql) === TRUE){
        echo "Đã duyệt đơn đặt thành công";
    } else {
        echo "Duyệt đơn thất bại";
    }
    $conn -> close();

?>