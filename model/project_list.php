<?php

    require_once ('connection.php');

    // Lấy thông tin từ bảng project
    $sql = "SELECT * FROM `Project` INNER JOIN `Region` ON Project.Region_id = Region.Region_id";
    $result = $conn->query($sql);

    $project_list = array();
    if ($result->num_rows > 0) {
        
        // Lấy dữ liệu từ mỗi dòng
        while($row = $result->fetch_assoc()) {
            $project_list[] = ["Project_id"=>$row["Project_id"],"Name"=>$row["Name"],
                "Investor"=>$row["Investor"],"Location"=>$row["Location"], "Area"=>$row["Area"], "Description"=>$row["Description"],
                "Image"=>$row["Image"],"Kind_purchase"=>$row["Kind_purchase"],"Classify"=>$row["Classify"],
                "Price"=>$row["Price"],"Unit"=>$row["Unit"],"State"=>$row["State"],"Type"=>$row["Type"],"Name_region"=>$row["Name_region"],
                "Region_id"=>$row["Region_id"]];
        }
    }

    // Kết quả lưu vào $project_list
    $json_response = json_encode($project_list);
    echo $json_response;
    $conn -> close();
    
?>