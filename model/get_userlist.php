<?php

    require_once ('connection.php');

    // Lấy thông tin từ cả hai bảng User
    $sql = "SELECT * FROM User";
    $result = $conn->query($sql);

    $user_list = array();
    if ($result->num_rows > 0) {
        
        // Lấy dữ liệu từ mỗi dòng
        while($row = $result->fetch_assoc()) {
            $user_list[] = ["User_id"=>$row["User_id"],"Username"=>$row["Username"],"Password"=>$row["Password"],
                "Permission"=>$row["Permission"]];
        }
    }

    // Kết quả lưu vào $account_list
    $conn -> close();
?>