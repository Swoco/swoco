$(function(){
    $('#admin-login-form').validate({
            rules: {
                admin_email : {
                    required : true,
                    email : true,
                },
                admin_password : {
                    required : true,
                    minlength: 8,
                },
            },
            messages: {
                 admin_email : {
                    required : "Please Enter Email Id !!",
                    email : "Please Enter Valid Email Id !!",
                },
                admin_password : {
                    required : "Please Enter Password !!",
                    minlength: "Password Must be 8 character long !!",
                },
            },
            submitHandler : function(form){
                form.submit();
            }
        });
   
    $('#admin-chng-pswd').validate({
            rules: {
                old_pass : {
                    required : true,
                    minlength : 8,
                },
                 new_pass : {
                    required : true,
                    minlength : 8,
                },
                 conf_pass : {
                    required : true,
                    equalTo : '#new_pass',
                },
            },
            messages: {
                 old_pass : {
                    required : "Please Enter Old Password",
                    minlength : "Password Must be atleast 8 Character",
                },
                 new_pass : {
                    required : "Please Enter New Password",
                    minlength : "New Password Must be atleast 8 Character",
                },
                 conf_pass : {
                    required : "Please Enter New Cofirm Password",
                    equalTo : "Password Mismatch !!!",
                },
            },
            submitHandler : function(form){
                form.submit();
            }
        });

    $('#pr-token-form').validate({
            rules: {
                token_prc : {
                    required : true,
                    number : true,
                },
            },
            messages: {
                 token_prc : {
                    required : "Please Enter Vorve token Price !!",
                    email : "Please Enter Number Only !!",
                },
                
            },
            submitHandler : function(form){
                form.submit();
            }
        });

     $('#user-reg-form').validate({
            rules: {
                name : "required",
                email : {
                    required : true,
                    email : true,
                },
                mob : {
                    required : true,
                    number : true,
                    minlength : 10,
                },
                pass : {
                    required : true,
                    minlength: 8,
                },
                conf_pass : {
                    required : true,
                    equalTo : "#pass",
                },
                remember : "required",
            },
            messages: {
                name : "Please Enter Your Name !!",
                 email : {
                    required : "Please Enter Email Id !!",
                    email : "Please Enter Valid Email Id !!",
                },
                mob : {
                    required : "Please Enter Your Contact Number",
                    number : "Please Enter Number Only",
                    minlength : "Contact Number Must be 10 digit",
                },
                pass: {
                    required : "Please Enter Password !!",
                    minlength: "Password Must be 8 character long !!",
                },
                 conf_pass : {
                    required : "Please Enter Confirm Password !!",
                    equalTo: "Password Mismatch !!!!",
                },
                remember : "",
            },
            submitHandler : function(form){
                form.submit();
            }
        });

         $('#forget_ps_form').validate({
                            rules : {
                                email : {
                                    required : true,
                                    email : true,
                                },
                            },
                            messages : {
                               email : {
                                    required : "Please Enter Email Id !!",
                                    email : "Please Enter Valid Email Id !!",
                                },      
                            },

                            submitHandler : function(form)
                            {
                                form.submit();
                            }
        });
		  $('#user-login-form').validate({
            rules: {
                user_email : {
                    required : true,
                    email : true,
                },
                user_password : {
                    required : true,
                    minlength: 8,
                },
            },
            messages: {
                 user_email : {
                    required : "Please Enter Email Id !!",
                    email : "Please Enter Valid Email Id !!",
                },
                user_password : {
                    required : "Please Enter Password !!",
                    minlength: "Password Must be 8 character long !!",
                },
            },
            submitHandler : function(form){
                form.submit();
            }
        });
    });
 