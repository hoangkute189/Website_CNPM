$(function(){
    
    checkInputLogin()
})

// Kiểm tra input người dùng nhập có rỗng
function checkInputLogin(){

    $('button').click(function(e){

        var username = $('#username').val()
        var password = $('#password').val()

        if(username == ""){
            e.preventDefault()
            error.innerHTML = "Vui lòng điền tên đăng nhập"
            return
             
        }

        if(password == "") {
            error.innerHTML = "Vui lòng điền mật khẩu"
            e.preventDefault()
            return 
        }
    })
}

