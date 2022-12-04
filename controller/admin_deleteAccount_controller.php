<?php

    require ('connection.php');

    // Xóa user yêu cầu
    $user_id = $_POST['user_id'];

    $sql1 = "DELETE FROM `Account` WHERE User_id = $user_id";

    $sql2 = "DELETE FROM `User` WHERE User_id = $user_id";

    if ($conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE) {
        echo "Xóa thành công";
    } else {
        echo "Xóa thất bại";
    }
    $conn -> close();

?>