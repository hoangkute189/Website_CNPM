<?php

    require ('connection.php');

    // Xóa project có trong cart mà user này yêu cầu
    $user_id = $_POST['user_id'];
    $project_id = $_POST['project_id'];

    $sql = "DELETE FROM `Cart` WHERE User_id = $user_id AND Project_id = $project_id";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công";
    } else {
        echo "Xóa thất bại";
    }
    $conn -> close();

?>