<?php

    session_start();
    if(!isset($_SESSION['account'])){
        header("location: index.html");
    }

    // Lấy danh sách các dự án trong giỏ hàng của người dùng
    require('../model/get_cart.php');
    $cart_list = $cart;

?>

<!-- ............................................................HTML........................................................... -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bất động sản 24h</title>
	<!-- Import Boostrap css, js, font awesome here -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link href="./css/style_cart.css" rel="stylesheet">
</head>

<body>

    <!-- Menu, banner-->
    <div class="menu">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="logo"><img src="images/logo.png" alt=""></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">

                    <li class="nav-item">
                        <a class="nav-link" href="customer.php">Trang chủ <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="introduce.php">Giới thiệu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="contact.php">Liên hệ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tài Khoản
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Giỏ hàng của bạn</a>
                            <a class="dropdown-item" href="history_order.php">Lịch sử đặt mua</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="information_user.php">Thông tin tài khoản</a>
                        </div>
                    </li>

                </ul>

                <ul class="navbar-nav mr-1">
                    <li class="nav-item">
                        <i class="fas fa-user" style="color:white"></i><span style="color:white"> <?php echo $_SESSION['account'][1];?> </span>
                        <a class="btn btn-danger" href="..\controller\logout_controller.php" role="button">Đăng Xuất</a>
                    </li>
                </ul>
            </div>

        </nav>

        <!-- Bảng danh sách các dự án trong giỏ hàng -->
        <div class="container mt-4 shadow-lg">
            <div class="form-area p-4">

                <h2 class="bg-warning p-2"><i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn</h2>

                <!-- Xóa tất cả -->
                <div class="panel-heading"> 
                    <div class="row">  
                        <div class="col col-xs-6 py-2"> 
                            <a href="#" class="delete_all">Xóa tất cả</a> 
                        </div> 
                    </div> 
                </div> 
                
                <!-- Khu vực hiển thị bảng -->
                <div class="panel-body"> 
                    
                    <?php

                        echo '<div>Số lượng dự án đang có: '.count($cart_list).'</div>';
                    ?>
                    <table class="table table-striped table-list"> 
                        <tbody>
                            <?php

                                // Hiển thị toàn bộ các project trong giỏ hàng
                                foreach($cart_list as $item){

                                    // Hiện thị dựa theo trạng thái
                                    if($item['State'] == 1){

                                        $state = '<td style="color:green">Chưa có người đặt</td>';
                                        $button = '<td>
                                                    <a class="btn btn-success"'.
                                                    'onclick = "confirmOrder(`'.$_SESSION['account'][0].'`,`'.$item['Project_id'].'`)">'.
                                                    '<i class="fas fa-money-bill-alt"></i> Đặt ngay</a>
                                                    <a href="#" onclick="confirmDelete(`'.$_SESSION['account'][0].'`,`'.$item['Project_id'].'`)"'.
                                                    '" class="delete btn btn-danger"><em class="fa fa-trash"></em></a>
                                                </td> ';
                                    } else {
                                        $state = '<td style="color:red">Đã có người đặt</td>';
                                        $button = '<td>
                                                    <a class="btn btn-success disabled"><i class="fas fa-money-bill-alt"></i> Đặt ngay</a>
                                                    <a href="#" onclick="confirmDelete(`'.$_SESSION['account'][0].'`,`'.$item['Project_id'].'`)"'.
                                                    '" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                                                </td> ';
                                    }

                                    echo '<tr> 
                                            <td class="project_image">
                                                <img src="'.$item['Image'].'" alt="">
                                            </td> 
                                            <td>'.$item['Name'].'</td> 
                                            <td>'.$item['Kind_purchase'].'</td> 
                                            <td>'.$item['Price'].' '.$item['Unit'].'</td>'.
                                            $state.
                                            $button. 
                                        '</tr> ';
                                }
                            ?>

                        </tbody>
                    </table> 

                </div>

            </div>
        
        </div>
        <!-- End danh sách giỏ hàng -->

    </div>

    <!-- DeleteAll Confirm Modal -->
    <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Xóa tất cả dự án trong giỏ hàng</h4>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn là muốn xóa tất cả dự án?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete-button" 
                        onclick="deleteAll(<?php echo $_SESSION['account'][0]?>)">Xóa tất cả</button>
                </div>

            </div>

        </div>
    </div>

    <!-- DeleteOne project Confirm Modal -->
    <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Xóa dự án</h4>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn là muốn xóa dự án này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deleteProject-button" 
                        >Xóa</button>
                </div>

            </div>

        </div>
    </div>

    <!-- DeleteOne project Confirm Modal -->
    <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Xóa dự án</h4>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn là muốn xóa dự án này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deleteProject-button" 
                        >Xóa</button>
                </div>

            </div>

        </div>
    </div>

    <!-- Order Confirm Modal -->
    <div id="myModal3" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đặt mua dự án</h4>
                </div>
                <div class="modal-body">
                    Bạn muốn đặt mua dự án này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" id="order-button" 
                        >Đặt mua</button>
                </div>

            </div>

        </div>
    </div>

</body>
</html>

<!-- .................................................Script....................................................... -->

<script>

    $(function(){

        deleteProject()
    })

    function deleteProject(){

        $('.delete_all').click(function(e){
            
            // Hiện bảng thông báo xác nhận xóa tất cả
            e.preventDefault()
            confirmDeleteAll()
            
        })
    }

    function confirmDeleteAll(){

        $('#myModal1').modal({
            backdrop: 'static',
            keyboard: false
        })
    }

    // Gửi request để deleteAll
    function deleteAll(id){

        $.post("../controller/delete_all_project_cart_controller.php", {
            "user_id": id.toString(),
            
        }, function(data, status) {

            // Delete xong thì reload lại trang
            if(status){
                location.reload()
            }
        })
    }

    // Xác nhận xóa 1 project mà người dùng chọn
    function confirmDelete(id,project_id){

        $('#myModal2').modal({
            backdrop: 'static',
            keyboard: false
        });

        deleteChoseProject(id,project_id)

    }

    // Gửi request yêu cầu xóa project trong giỏ hàng mà người dùng chọn
    function deleteChoseProject(id,project_id){

        $('#deleteProject-button').click(function(e){

            $.post("../controller/delete_project_cart_controller.php", {
                "user_id": id.toString(),
                "project_id": project_id.toString(),
            }, function(data, status) {

                // Delete xong thì reload lại trang
                if(status){
                    location.reload()
                }
            })

        })
    }

    // Xác nhận đặt mua project
    function confirmOrder(id,project_id){

        $('#myModal3').modal({
            backdrop: 'static',
            keyboard: false
        })

        orderProject(id,project_id)

    }

    // Gửi request yêu cầu thêm project vào lịch sử đặt mua
    function orderProject(id,project_id){

        $('#order-button').click(function(e){

            $.post("../controller/order_controller.php", {
                "user_id": id.toString(),
                "project_id": project_id.toString(),
            }, function(data, status) {

                // Thêm xong thì reload lại trang
                if(status){
                    alert(data)
                    location.reload()
                }
            })

        })
    }

</script>

<!-- ...........................................................End Script.................................................. -->