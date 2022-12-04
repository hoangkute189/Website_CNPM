<?php

    // Kiểm tra tài khoản admin có đang đăng nhập
    session_start();
    if(!isset($_SESSION['account'])){
        header("location: login.php");
    }
    
    require('../model/get_all_order.php');
    $order_list = $order;

?>

<!-- ............................................................HTML........................................................... -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"> 
    <link href="./css/style_admin.css" rel="stylesheet">
    <title>Admin</title>
</head>

<body style="background:white">
    <div class="container">
        <h1>Danh sách các đơn đặt</h1>
        <button onclick="window.print()" class="btn btn-primary my-2">In ngay</button>
        <table class="table table-striped table-bordered table-list"> 
            <thead> 
                <tr> 
                    <th class="hidden-xs">Tên tài khoản</th> 
                    <th>Tên dự án</th>
                    <th>Chủ đầu tư</th>
                    <th>Giá tiền</th>
                    <th>Trạng thái</th>
                </tr> 
            </thead> 
            <tbody>
                                            
                <!-- Hiển thị các order -->
                <?php
                    foreach($order_list as $item){

                        if($item['State_order'] == 0){

                            $view_state = '<td class="align-middle" style="color:red">Chưa duyệt</td>';
                        } else{
        
                            $view_state = '<td class="align-middle" style="color:green">Đã duyệt</td>';         
                        }

                        echo '<tr> 
                                <td class="align-middle">'.$item['Username'].'</td> 
                                <td class="align-middle">'.$item['Name'].'</td> 
                                <td class="align-middle">'.$item['Investor'].'</td>
                                <td class="align-middle">'.$item['Price'].' '.$item['Unit'].'</td>'.
                                $view_state.
                            '</tr>';
                    } 
                ?>
                                            
            </tbody>
        </table>

    </div>
     

</body>