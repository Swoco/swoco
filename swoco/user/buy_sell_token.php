<?php
error_reporting(0);
include('../inc/dbase.php');

if(!isset($_SESSION))
{
	session_start();
}

if($_SESSION['user_id'] == '')
{
    header('location:log_in.php');
}
$get_contact_number_id = $_SESSION['user_id'];
$get_contact_number_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `id`='".$get_contact_number_id."'");
$get_contact_number_result = mysqli_fetch_array($get_contact_number_qry);
$randm_idss2 = md5(uniqid(rand(), true));
$total_coin_qry2 = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE `status`='1'");
$total_coin_result2 = mysqli_fetch_array($total_coin_qry2);
$for_inc_percent = $total_coin_result2['unit_coin_prc'];
$phase_i=$total_coin_result2['id'];
if(isset($_POST['submit']))
{
 if($_SESSION['email'] == '')
  {
       header('location:log_in.php');
  }
  else
	{
  $user = $_SESSION['ref_idsignup'];
  $urs_id = $_SESSION['user_id'];
$user_detail_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='".$urs_id."'");
$user_detail_result = mysqli_fetch_array($user_detail_qry);
$buy_ref_key =$user_detail_result['link_reference_id'];
  $gt_se_id = session_id();
  $gt_user_id = $_SESSION['user_id'];
  $login_ck = 'user';
  $gt_user_email = $_SESSION['email'];
  $inv_order_id = date('Ymd').rand('0','9999');
  $gt_qty = $_GET['token'];
  $token=$_POST['coin_qnty'];
  $gt_prc = mysqli_real_escape_string($con, trim($_POST['coin_price'])); 
  $gt_total_prc = mysqli_real_escape_string($con, trim($_POST['buy_ttl_prc']));
  $gt_inv_type = '';
  $gt_inv_type_amt = '';
  $gt_temp_date = date('Y-m-d h:i:s');
  $gt_add_date = date('Y-m-d h:i:s');
  $gt_pay_panel = mysqli_real_escape_string($con, trim($_POST['crypto_pay_mod']));
$date = date('Y-m-d h:i:s');
   if($_POST['coin_qnty']<=$_GET['token'])
  {
      	$insert_pay_record_qry = mysqli_query($con, "INSERT INTO `buy_token`(`user_id`,`user_ref_id`, `sell_user_id`, `token_quantity`,`income`, `order_id`, `phase`, `status`, `buy_date`) VALUES ('".$_SESSION['user_id']."','".$_SESSION['ref_idsignup']."','".$_GET['id']."','".$token."','".$gt_total_prc."','".$_GET['orderid']."','".$_GET['phase']."','Pending','".$date."')");
   		if($insert_pay_record_qry)
	 	{
$insert_pay_record_qry = mysqli_query($con, "INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`user_id`,`user_rf_id`,`mode`,`user_email`,`verify_number`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`inv_type_amt`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,remarks,`pay_via_panel`,`pay_datetime`) 
     	VALUES ('".$gt_se_id."','','".$gt_user_id."','".$user."','".$login_ck."','".$gt_user_email."','','".$inv_order_id."','".$token."','".$for_inc_percent."','".$gt_total_prc."', '', '','".$_GET['phase']."','".$gt_inv_type."','".$gt_inv_type_amt."','unpaid','','".$gt_temp_date."','".$gt_add_date."','pending','Swoco Market','','$gt_add_date')");
	$_SESSION['sess_od_id'] = $inv_order_id;

	 header('location:pay_now_market.php');
//echo '<script>alert("Token Buy Success wait for payment gateway");window.location="sell_History.php";</script>';
	 	}
	 	else
	 	{
	 		header('location:buy-sell_token.php?r=1');
	 	}
    }
else
{
  $msg = '<div class="alert alert-danger" role="alert">Token Qty. should be equal to or less than $3000</div>';
}

}
}

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
										<p class="text-center">SWOCO COIN</p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper">
									<div class="panel-body">
									    	<?php if(!empty($msg)) { echo $msg; } ?>
										<div class="row">
										     
											<div class="col-sm-6 col-xs-6">
											    <form action="" id="purc-coin-form" method="post">
                   
												<div class="form-wrap">
													     <input type="hidden" name="verify-phn-num" value="<?php echo $get_contact_number_result['contact']; ?>">
                        <input type="hidden" name="crypto_pay_mod" value="<?php echo $p_gateway_val; ?>">

														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Enter Token Quantity *</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="coin_qnty" name="coin_qnty" onkeyup="numericFilter(this);" autocomplete="off" id="coin_qnty" value="<?php echo $_GET['token'];?>"  required>
															</div>															
														</div>
														
														
													
										</div>
											</div>
											<div class="col-sm-6 col-xs-6">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Coin Price in ($)</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>
																<!-- <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Enter Amount Here.."> -->
																<input class="form-control" type="text" value="<?php echo $total_coin_result2['unit_coin_prc']; ?>" readonly="readonly">

																<input type="hidden" name="coin_price" value="<?php echo $total_coin_result2['unit_coin_prc']; ?>" id="coin_price">

															</div>															
														</div>
														
														
													
												</div>
											</div>
											<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Total Amount in ($)</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>
																	<input type="text" class="form-control" name="buy_ttl_prc" id="buy_total_prc" readonly="readonly"> 

															</div>															
														</div>
														
														
													<input type="submit" class="btn btn-success mr-10" value="Submit" name="submit" >
														<!--<button type="submit" class="btn btn-default">Cancel</button>-->
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
 
  <?php include('../inc/footer.php');?>
  <script>
  	 $(document).ready(function()
{
    $("#coin_qnty").keyup(function()
    {

        var rate, qty, total;
        rate = parseFloat($("#coin_price").val());
        qty = parseFloat($("#coin_qnty").val());
        total = qty*rate;
        if(!isNaN(total))
        {
            //alert(total);
            //var totalbuy = total.toFixed(4);
            $("#buy_total_prc").val(total);
            // var admin_fee_val = $('#admin_charge_fee').val();
            var fee_total = total + (total/100);
             $("#buy_ttl_prc_admin_charge").val(fee_total);
        }
        else
        {
            //alert(total);
            $("#buy_total_prc").val("0");
             // $("#buy_ttl_prc_admin_charge").val("0");
        }
    });
});
 $(document).ready(function()
{
   

        var rate, qty, total;
        rate = parseFloat($("#coin_price").val());
        qty = parseFloat($("#coin_qnty").val());
        total = qty*rate;
        if(!isNaN(total))
        {
            //alert(total);
            //var totalbuy = total.toFixed(4);
            $("#buy_total_prc").val(total);
            // var admin_fee_val = $('#admin_charge_fee').val();
            var fee_total = total + (total/100);
             $("#buy_ttl_prc_admin_charge").val(fee_total);
        }
        else
        {
            //alert(total);
            $("#buy_total_prc").val("0");
             // $("#buy_ttl_prc_admin_charge").val("0");
        }
   
});
  	function numericFilter(txb)
      {
        txb.value = txb.value.replace(/[^\0-9]/ig,'');
      }
  </script>
 <script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>
  