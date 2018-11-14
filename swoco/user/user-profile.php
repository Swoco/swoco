<?php
error_reporting(0);
include('../inc/dbase.php');
date_default_timezone_set('Asia/Calcutta');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}
 $date = date('Y-m-d h:i:s');
 if(isset($_POST['update_prof_submit']))
    {
        $email = mysqli_real_escape_string($con, trim($_POST['email']));
        $name = mysqli_real_escape_string($con, trim($_POST['name']));
        $mob = mysqli_real_escape_string($con, trim($_POST['mobile']));
        $bitcoin_wallet = mysqli_real_escape_string($con, trim($_POST['bitcoin1']));
        $country=mysqli_real_escape_string($con, trim($_POST['country']));
         $region=mysqli_real_escape_string($con, trim($_POST['region']));
         $swoco_wallet = mysqli_real_escape_string($con, trim($_POST['swoco1']));
        // if($region)
         if(strlen($bitcoin_wallet)=='34')
         {
             //if($country==''){
              if (preg_match('/^\+?\d+$/', $mob)){
             $update_pswd_qry = mysqli_query($con, "UPDATE `milkyway_usersignup` SET `contact`='".$mob."', `name`='".$name."',`bitcoin_wallet_address`='".$bitcoin_wallet."',`swoco_wallet_address`='".$swoco_wallet."',country='".$country."',region='".$region."',uni_time='".$date."' WHERE `email`='".$email."'");
            if($update_pswd_qry)
               {
                $u_email_id=$_SESSION['email'];
                $user_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `email` = '".$u_email_id."'");
                $user_fetch_record = mysqli_fetch_array($user_rec_qry);
                unset($_SESSION['name']);
                $_SESSION['name'] = $name;
                header('location:index.php');
              //  $ch_prof_msg = '<div class="alert alert-success" role="alert">Profile Record Updated Successfully</div>';
               }
               else
               {
                $u_email_id=$_SESSION['email'];
                $user_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `email` = '".$u_email_id."'");
                $user_fetch_record = mysqli_fetch_array($user_rec_qry);
                 $ch_prof_msg = '<div class="alert alert-danger" role="alert">Oops Unable to Updated Please try Again !!!!</div>';
               }
             }
          else
           {
            $ch_prof_msg = '<div class="alert alert-danger" role="alert">Mobile Number is Incorrect!</div>';
            $u_email_id=$_SESSION['email'];
    $user_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `email` = '".$u_email_id."'");
    $user_fetch_record = mysqli_fetch_array($user_rec_qry);  
         }
             
        }
         else
         {
             $ch_prof_msg = '<div class="alert alert-danger" role="alert">Bitcoin Address is Incorrect!</div>';
           //  echo '<script>alert("Bitcoin Address Should be alphanumeric & 34 characters");</script>';
               $u_email_id=$_SESSION['email'];
    $user_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `email` = '".$u_email_id."'");
    $user_fetch_record = mysqli_fetch_array($user_rec_qry);
         }
    }
    else
    {
    $u_email_id=$_SESSION['email'];
    $user_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `email` = '".$u_email_id."'");
    $user_fetch_record = mysqli_fetch_array($user_rec_qry);
    }
?>
<?php include('../inc/header.php');?>
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
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="Abc" name="name" value="<?php echo $user_fetch_record['name']; ?>" required pattern=".*[^ ].*">
																<span style="color:red;">*</span>
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
																<input type="email" class="form-control" id="exampleInputuname_1" placeholder="abc@gmail.com" name="email" value="<?php echo $user_fetch_record['email']; ?>" readonly="readonly">
																<span style="color:red;">*</span>
															</div>															
														</div>
													</div>
											</div>
												<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Bitcoin Address</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="SYauYwt2N23Z4PBAdKkxdkhhTQjbCuDg3G" name="bitcoin1" value="<?php echo $user_fetch_record['bitcoin_wallet_address']; ?>" pattern="[a-zA-Z0-9]+" maxlength="34" required>
															<span style="color:red;">*</span>
															</div>														
														</div>
													</div>
											</div>
												<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Swoco Address</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="SYauYwt2N23Z4PBAdKkxdkhhTQjbCuDg3G" name="swoco1" value="<?php echo $user_fetch_record['swoco_wallet_address']; ?>" pattern="[a-zA-Z0-9]+" maxlength="34">
															<span style="color:red;">*</span>
															</div>														
														</div>
													</div>
											</div>
												<div class="col-sm-12">
												<div class="form-wrap">
													<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Country</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></div>
	
        <select id="country" name="country" onchange='regionname()' class="form-control" required>
            	<option></option>
<?php 
$sql=mysqli_query($con,"select * from country");
while($row=mysqli_fetch_array($sql))
{
    ?>
    <option value='<?php echo $row['iso'];?>'  <?php if ($row['iso'] == $user_fetch_record['country']) echo ' selected="selected"'; ?>>
        
        <?php  echo $row['name'];?></option>
    <?php
}
?>
</select>
	<span style="color:red;">*</span>
</div>	
															</div>
													</div>
											</div>
												<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Region</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></div>
					<input type="text" class="form-control" id="region" placeholder="Asia" name="region"  value="<?php echo $user_fetch_record['region']; ?>" readonly required>
																<span style="color:red;">*</span>
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
					<input type="text" class="form-control" id="exampleInputuname_1" placeholder="+919999999999" name="mobile"  value="<?php echo $user_fetch_record['contact']; ?>"  oninput="this.value = this.value.replace((\+)/[^0-9.]/g, ''); this.value = this.value.replace((\+)/(\..*)\./g, '$1');" required>
															<span style="color:red;">*</span>
															</div>															
														</div>
													<input type="submit" class="btn btn-success" name="update_prof_submit" value="Update Profile">
														<!--<button type="submit" class="btn btn-default">Cancel</button>-->
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
 <?php include('../inc/footer.php');?>
  <script type="text/javascript">
     
        function IsAlphaNumeric(e) {
           
        }
    </script>
    <script>
    function regionname()
    {
       var a= $('#country').val();
     //  alert(a);
  $.ajax({
    url: "https://restcountries.eu/rest/v2/alpha?codes="+a,
    dataType: 'json',
    success: function(results){
        $.each(results, function(index, val) {
            $('#region').val(val.region);
           // alert(val.region);
        });
     }
});
}
</script>
 