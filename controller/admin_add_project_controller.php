<?php

    // ............................ Lấy dữ liệu từ form và xử lý .................................................

    $name = $_POST['name_project'];
    $investor = $_POST['investor'];
    $location = $_POST['location'];
    $place = $_POST['place'];
    $description = $_POST['description'];
    $kind_purchase = $_POST['kind_purchase'];
    $area = $_POST['area'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $image = $_POST['image'];

    // Thêm dữ liệu người dùng đăng ký vào cơ sở dữ liệu
    $newid = getNewID();
    $message = addProject($newid, $name, $investor, $location, $place, 
        $description, $kind_purchase, $area, $type, $price, $unit, $image);

    echo $message;
    
    // ..................................... Các hàm con ....................................................

    // Hàm lấy id mới cho project
    function getNewID(){

        require ('connection.php');

        // Lấy id dòng cuối trong bảng
        $sql = "SELECT * FROM Project";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $lastid = $row['Project_id'];
            }
        } else {
            $lastid = "0";
        }


        // Tạo id mới cho dữ liệu được thêm vào
        $lastid = (int) $lastid + 1;
        if ($lastid <10){
            $newid = "000{$lastid}";
        } else if ($lastid <100){
            $newid = "00{$lastid}";
        } else if ($lastid <1000){
            $newid = "0{$lastid}";
        } else{
            $newid = "{$lastid}";
        }
        $conn->close();

        return $newid;
    }

    // Hàm thêm dự án mới
    function addProject($newid, $name, $investor, $location, $place, $description, $kind_purchase, $area, $type, $price, $unit, $image){

        require ('connection.php');
        $message = "";

        $sql = "INSERT INTO `Project` (`Project_id`, `Name`, `Investor`, `Location`, `Area`, `Description`, `Image`, 
            `Kind_purchase`, `Price`, `Unit`, `State`, `Type`, `Region_id`) 
            VALUES ('$newid', '$name', '$investor', '$location', '$area', 
            '$description', '$image', '$kind_purchase', '$price', '$unit', '1', '$type', '$place')";

        if ($conn->query($sql) === TRUE) {
            $message = "Thêm dự án thành công";
        } else {
            $message = "Thêm dự án thất bại";
        }
        $conn->close();
        
        return $message;
    }
?>