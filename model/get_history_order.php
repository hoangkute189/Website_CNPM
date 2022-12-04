<?php

    require ('connection.php');

    // Lấy thông tin từ các project mà user_id này thêm vào giỏ hàng
    $user_id = $_SESSION['account'][0];

    $sql = "SELECT * FROM `Order project` INNER JOIN `Project` ON `Order project`.Project_id = Project.Project_id WHERE 
            User_id = $user_id;";
    $result = $conn->query($sql);

    $order = array();
    if ($result->num_rows > 0) {
        
        // Lấy dữ liệu từ mỗi dòng
        while($row = $result->fetch_assoc()) {
            $order[] = ["User_id"=>$row["User_id"],"Project_id"=>$row["Project_id"],
                "Name"=>$row["Name"],"Image"=>$row["Image"], "Kind_purchase"=>$row["Kind_purchase"], "Price"=>$row["Price"],
                "Unit"=>$row["Unit"],"State"=>$row["State"], "State_order"=>$row["State_order"]];
        }
    }
    $conn -> close();

?>