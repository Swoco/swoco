<?php
error_reporting(0);
include('inc/dbase.php');

$email=$_GET['udcode'];

if(isset($_POST['reset_pass'])){
    $new_pass = mysqli_real_escape_string($con, trim($_POST['password']));
    $cnf_pass2 = mysqli_real_escape_string($con, trim($_POST['cpassword']));
    $cnf_pass = md5($cnf_pass2);

    if($new_pass==$cnf_pass2)
     {
        $reset_qry = mysqli_query($con, "update milkyway_usersignup SET password='$cnf_pass2', rnd_pass='$cnf_pass' WHERE md5(email)='$email'");
        if(mysqli_affected_rows($con) > 0)
        {
         $reset_msg = "<div class='alert alert-success' role='alert'>Password has been reset Click <a href='".$root_path_user."log_in.php' target='_blank' style='font-weight:bold;'>Here </a> to Login</div>";
        }
        else
        {
        $reset_msg = '<div class="alert alert-danger" role="alert">Oops Unable to Reset Please try Again !!!</div>';
        }
   
    }
    else{
        $reset_msg= '<div class="alert alert-danger" role="alert">password do not matched !!!</div>';
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
					    	<a class="te_wh" href="<?php echo $root_path_user; ?>log_in.php"><button type="button" class=" btn btn-success  btn-rounded btn-outline"> Login</button></a>
						<!--<a class="te_wh" href="<?php echo $root_path_user; ?>sign_up.php"><button type="button" class=" btn btn-success  btn-rounded btn-outline"> Sign up</button></a>-->
					   </div>
					   
					   
                    </div>
                    
                </div>	
					</div>		
					</div>
		
		
        	
            <div class="inner-bg">
                <div class="container">
                	
                   <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1><strong class="te_wh">Reset password  </strong> </h1>
                            
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
	                                 <?php if(!empty($reset_msg)) {echo $reset_msg; } ?>
	                                                                         				                    <form role="form" action="" method="post" class="registration-form">
				                    
										
										
										
									
				                        										<div class="form-group">
				                    		<label class="sr-only" for="form-Contact-No">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-first-name form-control" id="form-password" required="required" pattern=".*[^ ].*">
				                        </div>
										<div class="form-group">
				                    		<label class="sr-only" for="form-Contact-No">Confirm Password</label>
				                        	<input type="password" name="cpassword" placeholder="Confirm Password..." class="form-first-name form-control" id="form-cpassword" required="required" pattern=".*[^ ].*">
				                        </div>
										<!-- <div class="form-group">
				                        	<label class="sr-only" for="form-about-yourself">About yourself</label>
				                        	<textarea name="form-about-yourself" placeholder="About yourself..." 
				                        				class="form-about-yourself form-control" id="form-about-yourself"></textarea>
				                        </div> -->
									
									
												
				                        <button type="submit" class=" btn btn-success  btn-rounded btn-outline" name="reset_pass"><a class="te_wh">Reset Password</a></button>
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