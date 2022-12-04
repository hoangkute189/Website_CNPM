<?php

    require ('connection.php');

    // Xóa user yêu cầu
    $project_id = $_POST['project_id'];

    $sql1 = "DELETE FROM `Order project` WHERE Project_id = $project_id";

    $sql2 = "UPDATE `Project` SET `State` = '1' WHERE `Project_id` = '$project_id'";

    if ($conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE) {
        echo "Từ chối đơn đặt thành công";
    } else {
        echo "Từ chối đơn đặt thất bại";
    }
    $conn -> close();

?>