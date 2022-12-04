$(function(){

    checkInputUpdate()
})

// Kiểm tra input người dùng nhập
function checkInputUpdate(){

    $('.update').click(function(e){

        var name = $('#name').val().replace(/_/g, " ");
        var email = $('#email').val()
        var gender = $('#gender').val()
        var phone = $('#phone').val()
        
        // Kiểm tra có lỗi nhập từ người dùng
        var error_message = showMessageError(name, email, gender, phone)

        // Hiện thông báo lỗi cho người dùng
        if(error_message != ""){
            e.preventDefault()
            error.innerHTML = error_message
            return
        }
        
        // Hiện bảng thông báo xác nhận cập nhật
        e.preventDefault()
        confirmUpdate()
        
    })
}


// Kiểm tra đúng kiểu email
function isEmail(email){

    return /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(email);
}

// Kiểm tra các input do người dùng nhập
function showMessageError(name, email, gender, phone){

    var error_message = ""

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

function confirmUpdate(){

    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
}

// Gửi request để cập nhật thông tin
function updateInformation(id){

    var name = $('#name').val().replace(/_/g, " ");
    var email = $('#email').val()
    var gender = $('#gender').val()
    var address = $('#address').val().replace(/_/g, " ");
    var phone = $('#phone').val()

    $.post("../controller/update_account.php", {
        "user_id": id.toString(),
        "name": name,
        "email": email,
        "gender": gender,
        "address": address,
        "phone": phone,
        "permission": 0
    }, function(data, status) {
        
        // Cập nhật xong thì reload lại trang
        if(status){
            alert(data)
            location.reload()
        }
    })
}