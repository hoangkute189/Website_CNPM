<?php

    require ('connection.php');

    // Lấy thông tin từ cả hai bảng User và Account
    $sql = "SELECT * FROM `User` INNER JOIN `account` ON User.User_id = Account.User_id;";
    $result = $conn->query($sql);

    $account_list = array();
    if ($result->num_rows > 0) {
        
        // Lấy dữ liệu từ mỗi dòng
        while($row = $result->fetch_assoc()) {
            $account_list[] = ["Account_id"=>$row["Account_id"],"User_id"=>$row["User_id"],"Name"=>$row["Name"],
                "Address"=>$row["Address"],"Phone"=>$row["Phone"], "Gender"=>$row["Gender"], "Email"=>$row["Email"],
                "Username"=>$row["Username"],"Password"=>$row["Password"],"Permission"=>$row["Permission"]];
        }
    }

    // Kết quả lưu vào $account_list
    $conn -> close();

?>