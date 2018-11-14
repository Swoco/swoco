<?php
error_reporting(0);
include('inc/dbase.php');
require("../PHPMailer/class.phpmailer.php");
 if(isset($_POST['login'])) 
    {
        $flag = 0;
        $fg_email = mysqli_real_escape_string($con, trim($_POST['email']));
        $fg_qry = mysqli_query($con, "select * from `milkyway_usersignup` where email='$fg_email' and status='1'");
        $fg_fetch_recod = mysqli_fetch_array($fg_qry);
        if(mysqli_num_rows($fg_qry)>0) {
          $icode = $fg_fetch_recod['email'];
          $reset_urli ='https://www.swoco.io/swoco/reset_password.php?udcode='.md5($icode);
            // mail varification function
            $to      = $icode; // Send email to our user
           // $subject = 'Reset Your Password | '.$conf_comp_name; // Give the email a subject 

	  $mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPSecure = "ssl";  
$mail->Host='smtp.gmail.com';  
$mail->Port='465'; 
$mail->Username = "infoswoco@gmail.com";  // SMTP username
$mail->Password = "Swocotoken"; // SMTP password
$mail->SMTPKeepAlive = true;  
$mail->Mailer = "smtp"; 
$mail->IsSMTP(); // telling the class to use SMTP  
$mail->SMTPAuth   = true;                  // enable SMTP authentication  
$mail->CharSet = 'utf-8';  
$mail->SMTPDebug  = 0;   
$mail->Subject = 'Reset Your Password | '.$conf_comp_name;
$mail->From = $fg_email;
$mail->AddAddress($fg_email,'khushbu');
// set word wrap to 50 characters
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);
            $message = '<body style="font-family: Arial; font-size: 12px;">
                        <div>
                            <p>
                                You have requested a password reset, please follow the link below to reset your password.
                            </p>
                            <p>
                                Please ignore this email if you did not request a password change.
                            </p>

                            <p>
                                <a href='.$reset_urli.'>
                                    Follow this link to reset your password.
                                </a>
                            </p>
                        </div>
                        </body>
            ';
 $mail->Body    = $message;
$mail->AltBody = $message;

                //  $headers  = 'MIME-Version: 1.0' . "\r\n";
                //  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                //  $headers .= 'From: Solace Gold <enquiry@solacegold.com>' . "\r\n";  
                 if($mail->Send())
              //  if(mail($to, $subject, $message, $headers))
                {
                  $fg_msg ='<div class="alert alert-success" role="alert">Reset link has been send to your registered email Id.</div>';
                }
                else
                {
                  $fg_msg ='<div class="alert alert-danger" role="alert">Something Went Wrong Please try Again !!!</div>';
                }
      
        }else
        {
            $fg_msg ='<div class="alert alert-danger" role="alert">Your email is not registered with us...please signup first</div>';
        }

    }


?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Swoco Login</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="app-assets/css/bootstrap3.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/user_style_login_signup_form.css">
        <link rel="shortcut icon" href="app-assets/images/ico/apple-icon-120.png">
        <style>
            .heig_add_im{}
            
        </style>
     
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
		
		
		<div class="header_sign_up">
			  <div class="inner-bg">
			 <div class="container">
                	
                  <div class="row">
                       
                        
                        
					   
					   
					    <div class="col-sm-5  col-sm-offset-7   text-right"><span class="inline-block ">Already a member?</span>
						<!--<a class="te_wh" href="<?php echo $root_path_user; ?>sign_up.php"><button type="button" class=" btn btn-success  btn-rounded btn-outline"> Sign up</button></a>-->
							<a class="te_wh" href="<?php echo $root_path_user; ?>log_in.php"><button type="button" class=" btn btn-success  btn-rounded btn-outline"> Login</button></a>
					   </div>
					   
					   
                    </div>
                    
                </div>	
					</div>		
					</div>
		
		
        	
            <div class="inner-bg">
                <div class="container">
                	
                   <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1><strong class="te_wh">Forgot password  </strong> </h1>
                            
                        </div>
                    
                    <div class="row">
					
					 <div class="col-sm-4 col-sm-offset-4  pad-0-add">
                        	
                        	<div class="form-box log_in_style">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			
	                            		<p>Enter your recovery email
</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
	                                 <?php if(!empty($fg_msg)) { echo $fg_msg; } ?>
                                        				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Email</label>
				                        	<input type="email" name="email" placeholder="Email ID" class="form-username form-control" id="form-useremail" required="required" pattern=".*[^ ].*">
				                        </div>
				                       
				                       
				                        <button type="submit" class=" btn btn-success  btn-rounded btn-outline he_se" name="login">Reset</button>  
				                    </form>
			                    </div>
		                    </div>
		                
		                	
	                        
                        </div>
                        
                       
                        	
                        
                    </div>
                    
                </div>
            </div>
            
        </div>

       

         <!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
       <script src="app-assets/vendors/js/jquery.backstretch.min.js" type="text/javascript"></script>
	     <script src="app-assets/vendors/js/login_signin_scripts.js" type="text/javascript"></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
	
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
        
        
        
        
        <!-- <script>
$(document).ready(function(){
  $('.yes_Sponser_id').click(function(){
 $('.Sponser_id_show_off').show()
   var divHeight = $('.equal_heig').height(); 
        $('.equal_he').css('height', divHeight+'px');
})

})
</script>-->
        
        
     <!-- <script>
$(document).ready(function(){ 
  $('.he_se').click(function(){
  var divHeightplus = $('.log_in_style').height();
  $('.equal_di').height(divHeightplus);
  
})
})
</script>  -->
        
      <script>    
   $(document).ready(function(){ 
  $('.log_in_style .alert-danger').fadeOut(3000)
})     
        </script>       
        
        

    </body>

</html>