<?php

    // ............................ Lấy dữ liệu từ form forget password và xử lý .................................................
    
    // Import sử dụng tính năng phpMailer
    include "PHPMailer/src/PHPMailer.php";
    include "PHPMailer/src/Exception.php";
    include "PHPMailer/src/OAuth.php";
    include "PHPMailer/src/POP3.php";
    include "PHPMailer/src/SMTP.php";
     
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    // Lấy các thông tin người dùng nhập
    $username_input = $information['username'];
    $email_input = $information['email'];

    // Kiểm tra tài khoản có tồn tại?
    $check_account = checkExistAccount($username_input, $email_input);

    if(!$check_account[0]){

        // Thông báo cho người dùng biết tài khoản không tồn tại
        $error = "Tên đăng nhập hoặc email bạn đăng ký không đúng";
    } else {

        if(!sendEmail($email_input,$check_account[1],$check_account[2])){
            $error = "Có lỗi trong quá trình gửi mail";
        }

        $error = "Gửi mail thành công, vui lòng kiểm tra và quay về trang đăng nhập";
    }

    // ..................................... Các hàm con ....................................................    

    // Kiểm tra tài khoản tồn tại
    function checkExistAccount($username_input, $email_input){

        require_once('../model/accountlist.php');

        foreach($account_list as $account){
            if($account['Username'] == $username_input and $account['Email'] == $email_input){
                return [true, $account['Name'],$account['Password']];
            }
        }

        return [false,null,null];
    }

    // Hàm gửi mail
    function sendEmail($email_account,$name_account,$password_account){

        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        //Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->CharSet  = "utf-8";
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;   // Enable SMTP authentication
        $mail->Username = 'levannam1892002@gmail.com';  // SMTP username
        $mail->Password = 'jedgvqxkkirluest'; // SMTP password
        $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
    
        //Recipients
        $mail->setFrom('levannam1892002@gmail.com', 'Bất động sản 24h');

        $mail->addAddress($email_account, $name_account);   // Add a recipient
    
        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = '[Lấy lại mật khẩu] Bất động sản 24h';
        $mail->Body    = 'Xin chào <b>'.$name_account.'</b>, <br><br>
                            Bạn đã yêu cầu chúng tôi giúp bạn "Lấy lại mật khẩu" từ tài khoản Bất động sản 24h <br><br>
                            Đây là mật khẩu của bạn: <b>'.$password_account.'</b> <br><br>
                            Trân trọng,';
        
        if(!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

?>