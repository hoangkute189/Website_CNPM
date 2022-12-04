$(function(){

    checkInputSignUp()
})

// Kiểm tra các input người dùng nhập
function checkInputSignUp(){

    $('button').click(function(e){
        
        var name = $('#name').val()
        var email = $('#email').val()
        var gender = $('input[name=choose_gender]:checked', '#form-signup').val()
        var phone = $('#phone').val()
        var username = $('#username').val()
        var password = $('#password').val()
        var re_password = $('#re_password').val()

        // Kiểm tra có lỗi nhập từ người dùng
        var error_message = showMessageError(name, email, gender, phone, username, password, re_password)

        // Hiện thông báo lỗi cho người dùng
        if(error_message != ""){
            e.preventDefault()
            error.innerHTML = error_message
        }
        
    })
}

// Kiểm tra đúng kiểu email
function isEmail(email){

    return /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(email);
}

function showMessageError(name, email, gender, phone, username, password, re_password){

    var error_message = ""

    // Kiểm tra re-password
    if(re_password != password){
        error_message = "Xác thực mật khẩu không đúng"
    }

    // Kiểm tra password
    if(password == ""){
        error_message = "Vui lòng nhập mật khẩu"
    } else if(password.length < 5){
        error_message = "Mật khẩu của bạn không được ít hơn 5 kí tự"
    }

    // Kiểm tra username
    if(username == ""){
        error_message = "Vui lòng nhập tên đăng nhập"
    }

    // Kiểm tra phone
    if(phone == ""){
        error_message = "Vui lòng nhập số điện thoại"
    }

    // Kiểm tra chọn giới tính
    if(gender == null){
        error_message = "Vui lòng chọn giới tính"
    }

    // Kiểm tra email
    if(!isEmail(email)) {
        error_message = "Email bạn nhập không phù hợp"
    }

    // Kiểm tra tên
    if(name == "") {
        error_message = "Vui lòng nhập tên"
    }
    
    return error_message
}
