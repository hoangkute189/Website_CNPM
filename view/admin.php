<?php

    // Kiểm tra tài khoản admin có đang đăng nhập
    session_start();
    if(!isset($_SESSION['account'])){
        header("location: login.php");
    }
    
    // Lấy các dữ liệu để hiển thị
    require('../model/accountlist.php');
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

<body>

    <div class="menu">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <!-- <a class="navbar-brand" href="#">LOGO</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">

                </ul>

                <ul class="navbar-nav mr-1">
                    <li class="nav-item">
                        <i class="fas fa-user"></i> <?php echo $_SESSION['account'][1];?>
                        
                        <a class="btn btn-danger" href="..\controller\logout_controller.php" role="submit">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid">
        
        <!-- Body of page -->
        <div class="row">

            <div class="col-2">
                <div class="list-group" id="list-tab" role="tablist">
                    <div class="adminator"><i class="far fa-user-circle"></i> Adminator</div>
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                        <i class="fas fa-users-cog"></i> Quản lý tài khoản
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                        <i class="fas fa-project-diagram"></i> Quản lý dự án
                    </a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">
                        <i class="fas fa-dollar-sign"></i> Quản lý đơn đặt
                    </a>
                </div>
            </div>

            <div class="col-10 py-2">
                <div class="tab-content" id="nav-tabContent">

                    <!-- Quản lí tài khoản user -->
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="panel panel-default panel-table"> 
                            <div class="panel-heading"> 
                                <div class="row"> 
                                    <div class="col col-xs-6"> 
                                        <h3 class="panel-title">Danh sách các tài khoản</h3> 
                                    </div> 
                                    <div class="col col-xs-6 text-right"> 
                                        <button type="button" class="btn btn-sm btn-warning btn-create">
                                            <a href="form_add_account.php" style="color:black">Thêm tài khoản</a></button> 
                                    </div> 
                                </div> 
                            </div> 
                        
                            <div class="panel-body"> 
                                <table class="table table-striped table-list"> 
                                    <thead> 
                                        <tr> 
                                            <th style="text-align:center"><em class="fa fa-cog"></em>
                                            </th> 
                                            <th>ID</th> 
                                            <th>Tên tài khoản</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Admin</th>
                                        </tr> 
                                    </thead> 
                                    <tbody>

                                        <?php

                                            foreach($account_list as $account){

                                                $is_admin = "";

                                                if($account['Permission'] == 1){
                                                    $is_admin = 'checked';
                                                }

                                                echo '<tr> 
                                                        <td class="align-middle">
                                                            <a href="form_update_account.php?id='.$account['User_id'].'" class="btn btn-default"><i class="far fa-edit"></i></a> 
                                                            <a onclick="deleteAccount(`'.$account['User_id'].'`)" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                                                        </td> 
                                                        <td class="align-middle">'.$account['User_id'].'</td> 
                                                        <td class="align-middle">'.$account['Username'].'</td> 
                                                        <td class="align-middle">'.$account['Name'].'</td>
                                                        <td class="align-middle">'.$account['Email'].'</td>
                                                        <td class="align-middle">'.$account['Phone'].'</td>
                                                        <td class="align-middle"><input type="checkBox" '.$is_admin.' disabled></td>  
                                                    </tr>';
                                            } 
                                        ?>
                                        
                                    </tbody>
                                </table> 
                            </div>
                        
                        </div> 
                    </div>

                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

                        <!-- Quản lý các dự án -->
                        <div class="panel panel-default panel-table"> 
                            <div class="panel-heading"> 
                                <div class="row"> 
                                    <div class="col col-xs-6"> 
                                        <h3 class="panel-title">Danh sách các dự án</h3> 
                                    </div> 
                                    <div class="col col-xs-6 text-right"> 
                                        <button type="button" class="btn btn-sm btn-warning btn-create">
                                            <a href="form_add_project.php" style="color:black">Thêm dự án</a></button>
                                    </div> 
                                </div> 
                            </div> 
                        
                            <div class="panel-body"> 
                                <table class="table table-striped table-list"> 
                                    <thead> 
                                        <tr> 
                                            <th style="text-align:center"><em class="fa fa-cog"></em>
                                            </th> 
                                            <th class="hidden-xs">ID</th> 
                                            <th>Tên dự án</th> 
                                            <th>Chủ đầu tư</th>
                                            <th>Hình thức mua</th>
                                            <th>Giá tiền</th>
                                            <th>Trạng thái</th>
                                        </tr> 
                                    </thead> 
                                    <!-- Khu vực tải tất cả project từ csdl lên -->
                                    <tbody class = "all_project">      
                         
                                    </tbody>
                                </table> 
                            </div>
                        
                        </div>

                    </div>

                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">

                        <!-- Quản lý đơn đặt -->
                        <div class="panel panel-default panel-table"> 
                            <div class="panel-heading"> 
                                <div class="row"> 

                                    <div class="col col-md-10"> 
                                        <h3 class="panel-title">Danh sách các đơn đặt</h3> 
                                    </div>

                                    <div class="col col-md-2 text-right"> 
                                        <div class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle bg-warning text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                In danh sách đơn đặt
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a onclick="printCSV()" class="dropdown-item" href="../controller/print_csv_controller.php">Export as CSV</a>
                                                <a class="dropdown-item" href="print_order.php">Print</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div> 
                            </div> 
                        
                            <div class="panel-body"> 
                                <table class="table table-striped table-list"> 
                                    <thead> 
                                        <tr> 
                                            <th><em class="fa fa-cog"></em>
                                            </th> 
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
                                                    $view_cog = '<a onclick="refuseOrder(`'.$item['Project_id'].'`)"
                                                                 class="btn btn-danger"><i class="fas fa-times"></i></a>
                                                                <a onclick="acceptOrder(`'.$item['Project_id'].'`)" 
                                                                class="btn btn-success"><i class="fas fa-check"></i></a>';

                                                    $view_state = '<td class="align-middle" style="color:red">Chưa duyệt</td>';
                                                } else{
                                                    $view_cog = '<a onclick="deleteOrder(`'.$item['Project_id'].'`)" class="btn btn-danger"><em class="fa fa-trash"></em></a>';

                                                    $view_state = '<td class="align-middle" style="color:green">Đã duyệt</td>';         
                                                }

                                                echo '<tr> 
                                                            <td class="align-middle">'.
                                                                $view_cog.
                                                            '</td> 
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
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Delete account Confirm Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Xóa tài khoản</h4>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn là muốn xóa tài khoản?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Đóng</button>
                    <button type="button" class="btn btn-danger" id="delete_account_button" 
                        >xóa</button>
                </div>

            </div>

        </div>
    </div>

    <!-- Delete project Confirm Modal -->
    <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Xóa dự án</h4>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn là muốn xóa dự án này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Đóng</button>
                    <button type="button" class="btn btn-danger" id="delete_project_button" 
                        >xóa</button>
                </div>

            </div>

        </div>
    </div>

</body>
</html>

<!-- .....................................................Script........................................................... -->

<script>

    // Tải tất cả dự án lên màn hình
    $(function(){

        getProject()
    })

    // Lấy dự án từ model
    function getProject(){

        $.get("../model/project_list.php", function(data, status) {
            if (status) {
                showAllProject(data)
            }
        }, "json");
    }

    // Hiện tất cả các dự án lên màn hình
    function showAllProject(data){    

        var tbody = $('.all_project')
        var total = data.length

        for (var i = 0; i < total; i++) {
            
            var project_id = data[i].Project_id
            var name = data[i].Name
            var investor = data[i].Investor
            var kind_purchase = data[i].Kind_purchase 
            var price = data[i].Price
            var unit = data[i].Unit
            var state = data[i].State
            var state_writer = `<td class="align-middle" style="color:red">Chưa đặt</td>`

            if(state == 0){
                state_writer = `<td class="align-middle" style="color:green">Đã đặt</td>`
            }

            var div = `<tr> 
                            <td class="align-middle">
                                <a onclick="deleteProject('${project_id}')" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                            </td> 
                            <td class="align-middle">${project_id}</td> 
                            <td class="align-middle">${name}</td> 
                            <td class="align-middle">${investor}</td>
                            <td class="align-middle">${kind_purchase}</td>
                            <td class="align-middle">${price} ${unit}</td>` +
                            state_writer + 
                        `</tr>`
            tbody.append(div)                

        }
    }

    // Hàm xử lí click vào account để xóa
    function deleteAccount(id){

        confirmDeleteAccount(id)
    }

    // Xác nhận xóa account
    function confirmDeleteAccount(id){

        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        })

        $('#delete_project_button').click(function(){
            $.post("../controller/admin_deleteAccount_controller.php", {
                "user_id": id
            }, function(data, status) {

                // Delete xong thì reload lại trang
                if(status){
                    alert(data)
                    location.reload()
                }
            })
        });
    }

    // Hàm xử lí click vào project để xóa
    function deleteProject(id){

        confirmDeleteProject(id)
    }

    // Xác nhận xóa project
    function confirmDeleteProject(id){

        $('#myModal1').modal({
            backdrop: 'static',
            keyboard: false
        })

        // Gửi yêu cầu để xóa project
        $('#delete_project_button').click(function(){
            $.post("../controller/admin_delete_project_controller.php", {
                "project_id": id
            }, function(data, status) {

                // Delete xong thì reload lại trang
                if(status){
                    alert(data)
                    location.reload()
                }
            })
        });
    }

    // Xóa các đơn đã duyệt
    function deleteOrder(id){

        // Gửi yêu cầu để xóa order
        $.post("../controller/admin_delete_order_controller.php", {
            "project_id": id
        }, function(data, status) {

            // Delete xong thì reload lại trang
            if(status){
                alert(data)
                location.reload()
            }
        })
    }

    // Duyệt order
    function acceptOrder(id){

        // Gửi yêu cầu để chấp nhận order
        $.post("../controller/admin_accept_order_controller.php", {
            "project_id": id
        }, function(data, status) {

            // Duyệt xong thì reload lại trang
            if(status){
                alert(data)
                location.reload()
            }
        })
    }

    // Từ chối order
    function refuseOrder(id){

        // Gửi yêu cầu để từ chối order
        $.post("../controller/admin_refuse_order_controller.php", {
            "project_id": id
        }, function(data, status) {

            // Duyệt xong thì reload lại trang
            if(status){
                alert(data)
                location.reload()
            }
        })
    }

    // Thông báo in danh sách
    function printCSV(){
        alert("Đã in danh sách hóa đơn thành công => order_list.csv")
    }

</script>

<!-- .....................................................End Script....................................................... -->