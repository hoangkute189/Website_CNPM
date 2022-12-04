<?php

    // Lấy id hiện tại từ session
    $current_userID = $user_id;

    // Lấy dữ liệu các account trong cơ sở dữ liệu
    require_once ('../model/accountlist.php');
    $list = $account_list;

    // Kiểm tra tài khoản có trong cơ sở dữ liệu
    $information_account = array();
    foreach ($list as $element){
        if($element['User_id'] == $current_userID){
            $information_account = getInformationFromUserID($current_userID)[0];
        }
    }

    // ............................Hàm con .....................................................................

    // Lấy thông tin account thông qua User_id
    function getInformationFromUserID($user_id){
        
        require_once('connection.php');

        $sql = "SELECT *\n"
            ."FROM `User` INNER JOIN `Account`\n"
            ."ON User.User_id = Account.User_id\n"
            ."WHERE User.User_id = $user_id;";

        $result = $conn->query($sql);

        $information = array();
        if ($result->num_rows > 0) {
                
            // Lấy dữ liệu từ mỗi dòng
            while($row = $result->fetch_assoc()) {
                $information[] = ["Account_id"=>$row["Account_id"],"User_id"=>$row["User_id"],"Name"=>$row["Name"],
                    "Address"=>$row["Address"],"Phone"=>$row["Phone"], "Gender"=>$row["Gender"], "Email"=>$row["Email"],
                    "Username"=>$row["Username"],"Password"=>$row["Password"],"Permission"=>$row["Permission"]];
            }
        }
        $conn -> close();

        return $information;
    }
    
?>