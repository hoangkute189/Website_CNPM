<?php

    require_once ('connection.php');

    // Lấy thông tin project
    $id = $_GET['id'];

    $sql = "SELECT * FROM `Project` INNER JOIN `Region` ON Project.Region_id = Region.Region_id WHERE Project_id = $id";
    $result = $conn->query($sql);

    $project_detail = array();
    if ($result->num_rows > 0) {
        
        // Lấy dữ liệu từ mỗi dòng
        while($row = $result->fetch_assoc()) {
            $project_detail = ["Project_id"=>$row["Project_id"],"Name"=>$row["Name"],
                "Investor"=>$row["Investor"],"Location"=>$row["Location"], "Area"=>$row["Area"], "Description"=>$row["Description"],
                "Image"=>$row["Image"],"Kind_purchase"=>$row["Kind_purchase"],"Classify"=>$row["Classify"],
                "Price"=>$row["Price"],"Unit"=>$row["Unit"],"State"=>$row["State"],"Type"=>$row["Type"],
                "Name_region"=>$row["Name_region"]];
        }
    }
    $conn -> close();

?>