<?php include('../inc/header.php');?>
<?php
error_reporting(0);
include('../inc/dbase.php');

if($_SESSION['user_id'] == '')
{
    header('location:log_in.php');
}

 $un_email_id=$_SESSION['email'];
    $user_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `email` = '".$un_email_id."'");
    $user_fetch_record = mysqli_fetch_array($user_rec_qry);

        if(isset($_POST['update_pass']))
            {
            $old_pass=mysqli_real_escape_string($con, trim(md5($_POST['old_pass'])));
            $old_pass_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `rnd_pass`='".$old_pass."' AND `id`='".$_SESSION['user_id']."'");

            if(mysqli_num_rows($old_pass_qry) > 0)
            {
                $new_pass = mysqli_real_escape_string($con, trim(md5($_POST['new_pass'])));
                $newconf_pass = mysqli_real_escape_string($con, trim(md5($_POST['conf_pass'])));
              if($new_pass==$newconf_pass)
            {
                $update_pswd_qry = mysqli_query($con, "UPDATE `milkyway_usersignup` SET `rnd_pass`='".$new_pass."' WHERE `id`='".$_SESSION['user_id']."'");

               if(mysqli_affected_rows($con) > 0)
               {
                $ch_pass_msg = '<div class="alert alert-success" role="alert">New Password Updated Successfully</div>';
               }
               else
               {
                 $ch_pass_msg = '<div class="alert alert-danger" role="alert">Oops Unable to Updated Please try Again !!!!</div>';
               }
            }
            else
            {
               $ch_pass_msg = '<div class="alert alert-danger" role="alert">New & Confirm passowrd incorrect !!!</div>';  
            }
            }
            else
            {
                $ch_pass_msg = '<div class="alert alert-danger" role="alert">Old Password incorrect Please try Again !!!</div>';
            }
        }
?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
       <div class="row">
						<div class="col-md-6 offset-md-3">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<p class="text-center">Change Password</p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper">
									<div class="panel-body">
									     <?php if(!empty($ch_pass_msg)) { echo $ch_pass_msg; } ?>
									    											<div class="row">
										     
											<div class="col-sm-12 col-xs-6">
											    <form action="" id="purc-coin-form" method="post">
                   
												<div class="form-wrap">
													     <input type="hidden" name="verify-phn-num" value="123456789">
                        <input type="hidden" name="crypto_pay_mod" value="">

														<div class="form-group">
														<!--	<label class="control-label mb-10" for="exampleInputuname_1">Your Current Password</label>-->
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
																<input type="password" class="form-control" placeholder="Your Current Password"  autocomplete="off" name="old_pass" required="" pattern=".*[^ ].*">
															</div>															
														</div>
														
														
													
										</div>
											</div>
											<div class="col-sm-12 col-xs-6">
												<div class="form-wrap">
													
														<div class="form-group">
															<!--<label class="control-label mb-10" for="exampleInputuname_1">Your New Password</label>-->
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
																<!-- <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Enter Amount Here.."> -->
																<input class="form-control" type="password" placeholder="Your New Password" name="new_pass"  required pattern=".*[^ ].*">

																<input type="hidden" name="coin_price">

															</div>															
														</div>
														
														
													
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
														<!--	<label class="control-label mb-10" for="exampleInputuname_1">Your Confirm Password</label>  -->
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
																	<input type="password" class="form-control"  placeholder="Your Confirm Password" name="conf_pass"  required pattern=".*[^ ].*"> 

															</div>															
														</div>
														
														
													<input type="submit" class="btn btn-success mr-10" value="Reset Password" name="update_pass">
														
												</div>
											</div>
											</form>	
													
										</div>
									</div>
								</div>
							</div>
						</div>

					
									
			
			<!-- Footer -->
			
			<!-- /Footer -->
			
		</div>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.min.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>


</html>