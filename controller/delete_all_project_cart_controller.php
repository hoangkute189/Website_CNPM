<?php

    require ('connection.php');

    // Xóa tất cả các project có trong cart của user này
    $user_id = $_POST['user_id'];
    
    $sql = "DELETE FROM `Cart` WHERE User_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công";
    } else {
        echo "Xóa thất bại";
    }
    $conn -> close();

?>