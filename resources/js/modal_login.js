 // MOBILE LOADER
 function mobile_loader(toggle) {// true/false
    console.log('sss')
    if (toggle) {
        return  $('#mobile_loader').show();
    }
    return  $('#mobile_loader').hide();
}


$('#mobile_login_form').submit(function (e) {
    e.preventDefault();
    let email = $(this).find('#mobile_login_email').val();
    let password = $(this).find('#mobile_login_password').val();

    mobile_loader(true);//show loader
    $('#mobile_login_error_msg').hide();
    $.ajax({
        url: "/login",
        type: "POST",
        data: {
            email:email,
            password:password,
        },
        error: (res)=>{
            $('#mobile_login_error_msg').show();
            mobile_loader(false);//hide loader
        },
        success: (res)=>{
            $('#mobile_login_error_msg').hide();// hide error message
            $('#mobile_login').hide();
            mobile_loader(false);//hide loader
            M.toast({html: 'Login successful!'});
        }
    })

    console.log(email);
    console.log(password);
});

