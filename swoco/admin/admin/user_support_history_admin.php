<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');

$response_date = date('Y-m-d h:i:s');

if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  

if(isset($_GET['idrss']) && $_GET['idrss'] !='')
{

  $idsrr = $_GET['idrss'];
  $query = mysqli_query($con, trim("SELECT * FROM `milkyway_usersupport` Where `id`='".$idsrr."'"));
  if(mysqli_num_rows($query) > 0)
  {
  	$result = mysqli_fetch_array($query);
  	$re_id = $result['id'];
  	$re_userid = $result['user_id'];
  	$re_ticket = $result['ticket_no'];
  	$re_sub = $result['subject'];
  	$re_msg = $result['msg'];
  	$re_response_msg = $result['response_msg'];
  	$re_response_date = $result['response_adddate'];
  }
  else
  {
  	echo "<script>alert('Something Went Wrong Try Again !!!!'); window.location='index.php';</script>";
  }

if(isset($_POST['admin_support_submit']))
{
	$resp_date = date('Y-m-d h:i:s');
	$supp_id = mysqli_real_escape_string($con, trim($_POST['supp_id']));
	$admin_response_msg = mysqli_real_escape_string($con, trim($_POST['admin_response_msg']));
	$admin_change_status = mysqli_real_escape_string($con, trim($_POST['admin_change_status']));

	$response_qry = mysqli_query($con, "UPDATE `milkyway_usersupport` SET `response_msg`='".$admin_response_msg."', `support_status`='".$admin_change_status."', `response_adddate`='".$response_date."' WHERE `id`='".$supp_id."'");
	if(mysqli_affected_rows($con))
	{
		$support_admin_msg = '<div class="alert alert-success" role="alert">Ticket Updated Successfully</div>';
	}
	else
	{
		$support_admin_msg = '<div class="alert alert-danger" role="alert">Oops Unable to Update Please try Again !!!!</div>';
	}
	
}

?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Support Histroy</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item active">Support Histroy
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="buy_History-plus">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">File export</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                	<?php if(!empty($support_admin_msg)) { echo $support_admin_msg; } ?>
	     <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                  
                 <form method="post" action='' id="admin-support-form">
														<input type="hidden" name="supp_id" value="<?php echo $re_id;  ?>">

											<div class="col-sm-6 col-xs-6">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">User Id</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-book" aria-hidden="true"></i></div>
																<input type="text" class="form-control" value="<?php echo $re_userid; ?>" readonly="readonly">
															</div>															
														</div>
													
												</div>
											</div>
										
											
											<div class="col-sm-6 col-xs-6">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Token No</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></div>
																<input type="text" class="form-control" value="<?php echo $re_ticket; ?>" readonly="readonly">
															</div>															
														</div>
														
														
													
												</div>
											</div>

										
											<div class="col-sm-6">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Subject</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-book" aria-hidden="true"></i></div>
																<input type="text" class="form-control" value="<?php echo $re_sub; ?>" readonly="readonly">
															</div>															
														</div>
													
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Modify Status</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
																<select name="admin_change_status" class="form-control">
																	<option value="complete">complete</option>
																	<option value="close">close</option>

																	<!-- <option value="complete" <?php if($result['support_status'] == 'complete'){ echo "selected"; } ?>>complete</option>
																	<option value="pending" <?php if($result['support_status'] == 'close'){ echo "selected"; } ?>>close</option>
																	<option value="pending" <?php if($result['support_status'] == 'pending'){ echo "selected"; } ?>>pending</option> -->
																</select>
																
															</div>															
														</div>
											</div>
											
											
											<div class="col-sm-12">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Response Message</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
																<textarea class="form-control" cols="10" rows="10" name="admin_response_msg"></textarea>
																
															</div>															
														</div>

														
														
												 <input type="submit" value="Update Status" name="admin_support_submit" class="btn btn-success mr-10">	
													<!-- <button type="submit" class="btn btn-success mr-10">Submit</button> -->
													<a onclick="canUp();" class="btn btn-danger">Cancel</a>
														<!-- <button type="submit" class="btn btn-default">Cancel</button> -->
												</div>
											</div>
												
										</form>
                  </div>
                   <div class="card-body card-dashboard">
                 
                  <?php 

$find_user_nameqry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` where id='".$re_userid."'");
$find_user_result = mysqli_fetch_array($find_user_nameqry);

$supp_query = mysqli_query($con, trim("SELECT * FROM `milkyway_usersupport` Where `ticket_no`='".$re_ticket."' and status='1' order by id desc"));
while($supp_result = mysqli_fetch_array($supp_query))
{ 
?>	

<?php if(($supp_result['support_status'] == 'complete') || ($supp_result['support_status'] == 'close')) { ?>
			<div class="panel panel-default ">
  <div class="panel-heading">
  <div class="row">
  <div class="col-xs-6"><i class="fa fa-user"></i> Swoco</div>
  <div class="col-xs-6 text-right"><?php echo date('l, F d y h:i:s', strtotime($supp_result['response_adddate'])); ?></div>
  </div>
  </div>
  <div class="panel-body supportcnt">
   <p> 
   	<?php echo $supp_result['response_msg']; ?>
   		
   	</p>
	
	<address>Regards,<br>	Swoco Team | <b>Status</b>-<?php echo $supp_result['support_status']; ?></address>
	
  <div class="text-right starrating">
  <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
  </div>
  </div>
</div>			
	
	<?php } ?>						
<div class="panel panel-default ">
  <div class="panel-heading">
  <div class="row">
  <div class="col-xs-6"><i class="fa fa-user"></i>  <?php echo ucwords($find_user_result['name']); ?></div>
  <div class="col-xs-6 text-right"><?php echo date('l, F d y h:i:s', strtotime($supp_result['user_add_date'])); ?></div>
  </div>
  </div>
  <div class="panel-body supportcnt">
   <p>
   	<?php echo $supp_result['msg']; ?>
   	
   </p>
  </div>
</div>
			


<?php } ?></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- File export table -->
        
       
        
        
        <!--/ Language - Comma decimal place table -->
      </div>
    </div>
  </div>
 <?php include('inc/footer.php');?>
 <?php
} 
else { 
	header('location:index.php');
}
?>