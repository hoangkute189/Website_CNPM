<?php

    // Lấy danh sách các order
    require '../model/get_all_order.php';
    $order_list = $order;

    $data = array();
    $count = 0;

    // Tạo header cho file
    $headers = array("STT", "Tên dự án", "Chủ đầu tư", "Người đặt", "Số tiền", "Đơn vị", "Trạng thái đặt");

    // Tạo body cho file
    foreach($order_list as $item){
        $count = $count + 1;
        $data[] = ["STT"=>$count, "Name"=>$item["Name"], "Investor"=>$item["Investor"], "Username"=>$item["Username"],
                    "Price"=>$item["Price"], "Unit"=>$item["Unit"], "State_order"=>$item["State_order"]];
    }

    $fh = fopen("../order_list.csv", "w"); // Mở file

    fputcsv($fh, $headers); // Đưa header vào file

    // Đưa body vào file
    foreach($data as $fields) {
        fputcsv($fh, $fields);
    }

    fclose($fh);

    header('Location: ../view/admin.php');
    
?>