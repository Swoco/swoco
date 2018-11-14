<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
date_default_timezone_set('Asia/Kolkata');
$login_date_time = date('d-m-Y h:i:s');

 if(isset($_SESSION['adm_email']) != '') {
        header("location:index.php");
    }  

if(isset($_POST['lg_submit'])){
    $pass= mysqli_real_escape_string($con, trim(md5($_POST['password'])));
    $email= mysqli_real_escape_string($con, trim($_POST['username']));
    $query=mysqli_query($con, "select * from `milkyway_adminlogin` where `pswd`='".$pass."' and `email`='".$email."' and `status`='1' and type='admin'");
    $countRow=mysqli_num_rows($query);
    $fetch=mysqli_fetch_array($query);
    if($countRow>0){
      $_SESSION['last_lg_time']= $fetch['last_login_dtime'];
       $ck_email2 = $fetch['email'];
        $modify_login_qry = mysqli_query($con, "UPDATE `milkyway_adminlogin` SET `last_login_dtime`='$login_date_time' WHERE `email`='$ck_email2'");
    
        // $_SESSION['nId']= $fetch['email'];
        $_SESSION['adm_email']= $fetch['email'];
        $_SESSION['auth']= $fetch['type'];
        $_SESSION['idt'] = $fetch['id'];
        $_SESSION['u_name'] = $fetch['name'];
        header('location:index.php');
   
    }
    else{
        $msg = '<div class="alert alert-danger" role="alert">Wrong Email or Password.</div>';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Swoco</title>

         <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="app-assets/css/bootstrap3.min.css">
       
      
        <link rel="stylesheet" type="text/css" href="app-assets/css/user_style_login_signup_form.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="app-assets/images/favicon.png">
     
    </head>

    <body style="background-image: url(./././app-assets/images/bg_side_2.png);">

        <!-- Top content -->
        <div class="top-content">
		
		
	
		
		
        	
            <div class="inner-bg">
                <div class="container">
                	
                   <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h1><strong class="te_wh">Log in  </strong> </h1>
                            
                        </div>
                    
                    <div class="row">
					
					 
				
									<!-- <div class="alert alert-warning" role="alert"> <strong>Warning!</strong> Better check yourself, you're not looking too good. </div> -->
								
						 
						 
						 
						 
						 
                        <div class="col-sm-4 col-sm-offset-4  pad-0-add">
                        		<?php if(!empty($msg)) { echo $msg; } ?>
							
						 
                        	<div class="form-box log_in_style">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to our site</h3>
	                            		<p>Enter username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Username</label>
				                        	<input type="text" name="username" placeholder="Email id..." class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit" class=" btn btn-success  btn-rounded btn-outline" name="lg_submit">Sign in</button>
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

    </body>

</html>