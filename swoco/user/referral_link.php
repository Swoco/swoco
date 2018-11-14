<?php
error_reporting(0);
include('../inc/dbase.php');

session_start();
date_default_timezone_set('Asia/Calcutta');
$ref_date = date('Y-m-d h:i:s');

$urs_id = $_SESSION['user_id'];

$user_detail_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='".$urs_id."'");
$user_detail_result = mysqli_fetch_array($user_detail_qry);




?>
<?php include('../inc/header.php');?>
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
										<p class="text-center">Referral Code Link</p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper">
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													
                      								<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Referral Link</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></div>
																<input type="text" class="form-control" name="buy_ref_key" placeholder="Enter Reference Key" autocomplete="off" value="<?php echo $user_detail_result['reference_url']; ?>" readonly="readonly" id="myInput1"> 
														</div>	
														
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Your Referral Id- <?php echo $_SESSION['ref_idsignup'];?></label>
																
														
														</div>
														<button class="btn btn-success mr-10 stuchnag pull-right" onclick="myFunction1()">Copy</button>	
														
											</div>
											</div>
										
										
										</div>
									</div>
								</div>
							</div>
						</div>
			</div>
      </div>
    </div>
  </div>
  <?php include('../inc/footer.php');?>
<script>
function myFunction1() {
  var copyText = document.getElementById("myInput1");
  copyText.select();
  document.execCommand("Copy");

}
$(function(){
   $(".stuchnag").on("click", function(){
    $(".stuchnag").html("Copy");
    $(this).html("Copied");
   })
});
</script>

