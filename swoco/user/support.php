<?php include('../inc/header.php');?>
<?php
error_reporting(0);
include('../inc/dbase.php');

if($_SESSION['user_id'] == '')
{
    header('location:login.php');
}

$user_date = date('Y-m-d h:i:s');

if(isset($_POST['user_support_submit']))
{
 $userr_id = $_SESSION['user_id'];
 $token = date('Ymd').rand();	
 $user_sub = mysqli_real_escape_string($con, trim($_POST['user_sub']));
 $user_msg = mysqli_real_escape_string($con, trim($_POST['user_msg']));

 $support_insert_qry = mysqli_query($con, "INSERT INTO `milkyway_usersupport` (`user_id`,`ticket_no`,`subject`,`msg`,`support_status`,`status`,`user_add_date`) VALUES ('".$userr_id."','".$token."', '".$user_sub."', '".$user_msg."', 'pending', '1', '".$user_date."')");
 if($support_insert_qry) 
 {
 	$support_msg = '<div class="alert alert-success" role="alert">Ticket Id: <span style="color:#000000; font-weight:bold;">'.$token.'</span> Generated Successfully</div>';
 }
 else
 {
 	$support_msg = '<div class="alert alert-danger" role="alert">Oops Unable to Generate Ticket Please try Again !!!!</div>';
 }

}
?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="row">
						<div class="col-md-6 offset-md-3">
							<div class="panel panel-default card-view">
								
								
								<div class="panel-heading">
									<div class="pull-left">
										<p class="text-center">Support Form</p>
									</div>
									<div class="pull-right">
									<p class="text-muted txt-light text-center texte" style="font-size: 15px; text-decoration: underline;"><a href="user_support_history.php" target="_blank" style="color:#ffffff;">View Support History</a></p>
									</div>
									
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper">
									<div class="panel-body">
									    <?php if(!empty($support_msg)) { echo $support_msg; } ?>
																				<div class="row">
										<form id='user-support-form' method='post' action='' style="height:auto;width: 100%;">
										
										
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Subject</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-book" aria-hidden="true"></i></div>
																<input type="text" class="form-control" name="user_sub" placeholder="Enter Subject *" >
															</div>															
														</div>
													
												</div>
											</div>
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Your Message</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
																<textarea class="form-control" name="user_msg" cols="10" rows="10" placeholder="Enter Message here *" ></textarea>
																
															</div>															
														</div>
 <input type="submit" value="Submit" name="user_support_submit" class="btn btn-success mr-10">	
													<!-- <button type="submit" class="btn btn-success mr-10">Submit</button> -->
													<!--<a onclick="canUp();" class="btn btn-default">Cancel</a>-->
														<!-- <button type="submit" class="btn btn-default">Cancel</button> -->
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
 <?php include('../inc/footer.php');?>
  
 <script>
 $(function(){
    $('#user-support-form').validate({
            rules: {
                user_sub : "required",
                user_msg : "required"
            },
            messages: {
                 user_sub : "Please Enter Subject !!!",
                 user_msg : "Please Enter Message !!!",
            },
            submitHandler : function(form){
                form.submit();
            }
        });
});
       </script>