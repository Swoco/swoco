<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  


if(isset($_POST['notification_update_btn']))
{
 $notification_id = $_POST['notification_id'];
 $notification_content = mysqli_real_escape_string($con, trim($_POST['notification_content']));
$date=date('Y-m-d h:i:s');
 $update_qry = mysqli_query($con, "UPDATE `milkyway_usernotification` SET `content`= '".$notification_content."',add_date='".$date."' WHERE id='".$notification_id."'");
 if(mysqli_affected_rows($con))
 {
 $noti_msg = '<div class="alert alert-success" role="alert" style="text-align:center;">Notification Updated Successfully.</div>';
 }
 else
 {
$noti_msg = '<div class="alert alert-danger" role="alert" style="text-align:center;">Unable to Update Please Try Again !!</div>';
 }
 $query = mysqli_query($con, "SELECT * FROM `milkyway_usernotification` where id='1'");
$query_result = mysqli_fetch_array($query);
}

else
{
 $query = mysqli_query($con, "SELECT * FROM `milkyway_usernotification` where id='1'");
$query_result = mysqli_fetch_array($query);
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
										<p class="text-center">Notification Form</p>
									</div>
									
									
									<div class="clearfix"></div>
								</div>
								
								
								
								
								
								
								
								
								
								<div class="panel-wrapper">
									<div class="panel-body">
									    <?php if(!empty($noti_msg)) { echo $noti_msg; } ?>
																				<div class="row">
											<form class="full_width_all" method="post" action="">
										
										
										
											<div class="col-sm-12">
												<div class="form-wrap">
												 <input type="hidden" name="notification_id" value="<?php echo $query_result['id']; ?>">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Your Message</label>
															<div class="input-group">
															
																<textarea rows="12" cols="6" id="editor1" placeholder="Please Enter Notification Updates" name="notification_content" required="required"><?php echo $query_result['content']; ?></textarea>
																
															</div>															
														</div>


														
												    <input type="submit" value="Submit" name="notification_update_btn" class="btn btn-success mr-10">	
													<!-- <button type="submit" class="btn btn-success mr-10">Submit</button> -->
													
														<!-- <button type="submit" class="btn btn-default">Cancel</button> -->
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
        <!-- Candlestick Multi Level Control Chart -->
        
      </div>
	  
	  
	  
	  
	  
    </div>
	
	
	
  </div>
 <?php include('inc/footer.php');?>
 
 	<script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
          <script type="text/javascript">
                CKEDITOR.replace( 'editor1' );
              </script>