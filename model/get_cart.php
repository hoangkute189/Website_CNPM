<?php

    require ('connection.php');

    // Lấy thông tin từ các project mà user_id này thêm vào giỏ hàng
    $user_id = $_SESSION['account'][0];
    
    $sql = "SELECT * FROM `Cart` INNER JOIN `Project` ON Cart.Project_id = Project.Project_id WHERE User_id = $user_id;";
    $result = $conn->query($sql);

    $cart = array();
    if ($result->num_rows > 0) {
        
        // Lấy dữ liệu từ mỗi dòng
        while($row = $result->fetch_assoc()) {
            $cart[] = ["User_id"=>$row["User_id"],"Project_id"=>$row["Project_id"],
                "Name"=>$row["Name"],"Image"=>$row["Image"], "Kind_purchase"=>$row["Kind_purchase"], "Price"=>$row["Price"],
                "Unit"=>$row["Unit"],"State"=>$row["State"]];
        }
    }

    // Kết quả lưu vào $account_list
    $conn -> close();

?>