<?php

    require ('connection.php');

    // Xóa project yêu cầu
    $project_id = $_POST['project_id'];

    $sql = "DELETE FROM `Order project` WHERE Project_id = $project_id";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công";
    } else {
        echo "Xóa thất bại";
    }
    $conn -> close();

?>