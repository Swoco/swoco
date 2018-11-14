<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
 

 if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    } 
  if(isset($_POST['update_prof_submit']))
    {
        $email = mysqli_real_escape_string($con, trim($_POST['email']));
        $name = mysqli_real_escape_string($con, trim($_POST['name']));
        $mob = mysqli_real_escape_string($con, trim($_POST['mobile']));
 if(strlen($mob)=='10'){
         $update_pswd_qry = mysqli_query($con, "UPDATE `milkyway_adminlogin` SET `contact`='".$mob."', `name`='".$name."' WHERE `email`='".$email."'");

               if(mysqli_affected_rows($con) > 0)
               {
                 $adm_email_id=$_SESSION['adm_email'];
                $admin_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_adminlogin` WHERE `email` = '".$adm_email_id."'");
                $admin_fetch_record = mysqli_fetch_array($admin_rec_qry);

                unset($_SESSION['u_name']);
                $_SESSION['u_name'] = $name;
                $ch_prof_msg = '<div class="alert alert-success" role="alert">Profile Record Updated Successfully</div>';
               }
               else
               {
                 $adm_email_id=$_SESSION['adm_email'];
                $admin_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_adminlogin` WHERE `email` = '".$adm_email_id."'");
                $admin_fetch_record = mysqli_fetch_array($admin_rec_qry);
                 $ch_prof_msg = '<div class="alert alert-danger" role="alert">Oops Unable to Updated Data !!!!</div>';
               }
 }
 else
 {
   $ch_prof_msg = '<div class="alert alert-danger" role="alert">Mobile Number should be 10 digit !!!!</div>'; 
    $adm_email_id=$_SESSION['adm_email'];
    $admin_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_adminlogin` WHERE `email` = '".$adm_email_id."'");
    $admin_fetch_record = mysqli_fetch_array($admin_rec_qry);
 }
    }
    else
    {
    $adm_email_id=$_SESSION['adm_email'];
    $admin_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_adminlogin` WHERE `email` = '".$adm_email_id."'");
    $admin_fetch_record = mysqli_fetch_array($admin_rec_qry);

    }
?>
<?php include('inc/header.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
     <div class="col-md-6 offset-md-3">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<p class=" txt-light text-center texte"><b>Profile Information</b></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper ">
									<div class="panel-body">
									     <?php if(!empty($ch_prof_msg)) { echo $ch_prof_msg; }  ?>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-wrap">
													<form method="post" action="">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Full Name</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Abc" name="name" value="<?php echo $admin_fetch_record['name']; ?>" required  pattern=".*[^ ].*">
															</div>															
														</div>
														
														
													
											</div>
											</div>
											<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Email Address</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
																<input type="email" class="form-control" id="exampleInputuname_1" placeholder="abc@gmail.com" name="email" value="<?php echo $admin_fetch_record['email']; ?>" readonly="readonly">
															</div>															
														</div>
														
														
													
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Phone Number</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="+91-9999999999" name="mobile"  value="<?php echo $admin_fetch_record['contact']; ?>" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
															</div>															
														</div>
														
														
													<input type="submit" class="btn btn-success" name="update_prof_submit" value="Update Profile">
														<button type="submit" class="btn btn-default"  onclick="canUp();">Cancel</button>
												</div>
											</div>
												</form>	
													
										</div>
									</div>
								</div>
							</div>
						</div>
    </div>
  </div>
   <!--<script>-->
   <!--     function canUp() {-->
   <!--         x = confirm("Are You Sure You Won't Update Profile ?");-->
   <!--         if(x)-->
   <!--         {-->
   <!--             window.location = 'index.php';-->
   <!--         }-->
   <!--     }-->
   <!-- </script>-->
 <?php include('inc/footer.php');?>