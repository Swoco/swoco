<?php
error_reporting(0);
include('../inc/dbase.php');
date_default_timezone_set('Asia/Calcutta');

if(isset($_GET['p']) && $_GET['p'] != '')
{
    $offer_path = '?p='.$_GET['p'].'&rnd_c='.$_GET['rnd_c'];
}
else
{
    $offer_path = '';
}

if($_SESSION['user_id'] != '')
{
    header('location:'. $root_path_user.$offer_path);
}
if(isset($_POST['login'])) 
          {
        $loginemail = mysqli_real_escape_string($con, trim($_POST['user_email']));
        $loginpassword = mysqli_real_escape_string($con, md5(trim($_POST['user_password'])));

        $login_chk_qry = mysqli_query($con, "select * from `milkyway_usersignup` where rnd_pass='".$loginpassword."' and email='".$loginemail."' and status='0'");
        if(mysqli_num_rows($login_chk_qry) > 0)
        {
            $login_msg = '<div class="alert alert-danger" role="alert">Your account has not been activated. Please verify your account.</div>';
        }
        else
        {
        $login_qry = mysqli_query($con, "select * from `milkyway_usersignup` where rnd_pass='".$loginpassword."' and email='".$loginemail."' and status='1' and verification='true'");

        $fetch = mysqli_fetch_array($login_qry);

        if(mysqli_num_rows($login_qry) > 0) 
        {
          if($fetch['uni_time'] != '')
          {
            $prev_time_detail = $fetch['uni_time'];
            $current_time_detail = strtotime(date('Y-m-d h:i:s'));
            $rem_lg_time_detail = $current_time_detail - $prev_time_detail;
          }
          else
          {
            $rem_lg_time_detail = '0';
          }

          if($rem_lg_time_detail > 600)
          {
              mysqli_query($con, "UPDATE `milkyway_usersignup` SET `uni_session_id`='',`uni_time`='',`login_status`='0' WHERE `id`='".$fetch['id']."'");
          }

          $login_one_qry = mysqli_query($con, "select * from `milkyway_usersignup` where rnd_pass='".$loginpassword."' and email='".$loginemail."' and status='1' and verification='true'");
           if(mysqli_num_rows($login_one_qry) > 0) 
        {
          // update one time login credentials
          $uni_sess_id = session_id();
          $uni_datetime = strtotime(date('Y-m-d h:i:s'));
          $update_onetime_lg_qry = mysqli_query($con, "UPDATE `milkyway_usersignup` SET `uni_session_id`='".$uni_sess_id."',`uni_time`='".$uni_datetime."',`login_status`='1' WHERE `id`='".$fetch['id']."'");
          if(mysqli_affected_rows($con))
          {
          // log file for login
          $log_u_id = $fetch['id'];
          $lg_server_add = $_SERVER['SERVER_ADDR'];
          $lg_remote_add = $_SERVER['REMOTE_ADDR'];
          $lg_add_dte = date('Y-m-d h:i:s');
          mysqli_query($con, "INSERT INTO `milkyway_userlogin_log`(`user_id`, `server_add`, `remote_add`, `add_date`) VALUES ('".$log_u_id."', '".$lg_server_add."', '".$lg_remote_add."', '".$lg_add_dte."')");
          

            $_SESSION['user_id'] = $fetch['id'];
            $_SESSION['contact'] = $fetch['contact'];
            $_SESSION['name'] = $fetch['name'];
            $_SESSION['email'] = $fetch['email'];
            $_SESSION['ref_idsignup'] = $fetch['reference_id'];


            $_SESSION['last_login_timestamp'] = time();

            header('location:index.php'.$offer_path);
          }
          else
          {
            $login_msg = '<div class="alert alert-danger" role="alert">Unable to Login Please Try Again !!!</div>';
          }
           } 
        else 
        {
            $login_msg = '<div class="alert alert-danger" role="alert">OOPS Already Login !!!</div>';
        }
    } 
        else 
        {
         $login_msg = '<div class="alert alert-danger" role="alert">Wrong Email Id or Password. !!!</div>';
               }
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
        
        <link rel="stylesheet" href="../app-assets/css/bootstrap3.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/user_style_login_signup_form.css">
        <link rel="shortcut icon" href="app-assets/images/ico/apple-icon-120.png">
        <style>
            .heig_add_im{}
            
        </style>
     
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
		
		
		<!--<div class="header_sign_up">-->
		<!--	  <div class="inner-bg">-->
		<!--	 <div class="container">-->
                	
  <!--                <div class="row">-->
                       
                        
                        
					   
					   
					 <!--   <div class="col-sm-5  col-sm-offset-7   text-right"><span class="inline-block ">Don't have an account?</span>-->
						<!--<a class="te_wh" href="sign_up.php"><button type="button" class=" btn btn-success  btn-rounded btn-outline"> Sign up</button></a>-->
					 <!--  </div>-->
					   
					   
  <!--                  </div>-->
                    
  <!--              </div>	-->
		<!--			</div>		-->
		<!--			</div>-->
		
		
        	
            <div class="inner-bg">
                <div class="container">
                	
                   <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1><strong class="te_wh">SIGN IN  </strong> </h1>
                            
                        </div>
                    
                    <div class="row">
					
					 
					 <div class="col-sm-4 col-sm-offset-2  pad-0-add">
						 <div class="form-box Sign_up_style">
						 <img style="height: 300px;" class="img-responsive equal_di" src="app-assets/images/bg_for_signup/sign_up.jpg"  >
						  </div>	
                         </div>	
						 
						 
						 
						 
						 
						 
						 
                        <div class="col-sm-4  pad-0-add">
                        	
                        	<div class="form-box log_in_style">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			
	                            		<p>Enter your Email ID and Password to login
</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
                                        <?php if(!empty($login_msg)) { echo $login_msg; } ?>
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Email</label>
				                        	<input type="email" name="user_email" placeholder="Email ID" class="form-username form-control" id="form-useremail" required="required">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="user_password" placeholder="Password..." class="form-password form-control" id="form-password" required="required">
				                        </div>
				                        <div class="form-group">
            <a class="forget_password_link" href="https://www.swoco.io/swoco/forgot_password.php">Forgot password?</a>
          </div>
				                        <button type="submit" class=" btn btn-success  btn-rounded btn-outline he_se" name="login">Sign In</button>  
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