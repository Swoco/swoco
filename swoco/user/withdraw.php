<?php
error_reporting(0);
include('../inc/dbase.php');

if(!isset($_SESSION))
{
	session_start();
}

if($_SESSION['user_id'] == '')
{
    header('location:login.php');
}
$get_contact_number_id = $_SESSION['user_id'];
$get_contact_number_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `id`='".$get_contact_number_id."'");
$get_contact_number_result = mysqli_fetch_array($get_contact_number_qry);
$randm_idss2 = md5(uniqid(rand(), true));
$total_coin_qry2 = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE `status`='1'");
$total_coin_result2 = mysqli_fetch_array($total_coin_qry2);
$for_inc_percent = $total_coin_result2['unit_coin_prc'];
$phase_i=$total_coin_result2['id'];

$level=mysqli_query($con,"SELECT sum(percent_amt_qty)as levelincome FROM `milkyway_level__income` where user_id='".$_SESSION['ref_idsignup']."'and pay_status='success'");
$level_income=mysqli_fetch_array($level);
$re=mysqli_query($con,"SELECT sum(total_token)as re FROM `reinvestment_token` where user_id='".$_SESSION['user_id']."'");
$re_in=mysqli_fetch_array($re);
$withdraw=mysqli_query($con,"SELECT sum(amount)as withdraw FROM `withdraw` where user_id='".$_SESSION['user_id']."'");
$withdraw_amount=mysqli_fetch_array($withdraw);
$purchase_amount=$level_income['levelincome']-$re_in['re']-$withdraw_amount['withdraw'];
$user = $_SESSION['ref_idsignup'];
$urs_id = $_SESSION['user_id'];

$user_detail_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='".$_SESSION['user_id']."'");
$user_detail_result = mysqli_fetch_array($user_detail_qry);

$buy_ref_key =$user_detail_result['link_reference_id'];
$bitcoinaddress =$user_detail_result['bitcoin_wallet_address'];
if(isset($_POST['submit']))
{
 if($_SESSION['email'] == '')
  {
       header('location:login.php');
  }
  else
	{
  $trnss_id = date('ymd').rand(0,999999);
  $gt_se_id = session_id();
  $gt_user_id = $_SESSION['user_id'];
  $login_ck = 'user';
  $gt_user_email = $_SESSION['email'];
  $inv_order_id = date('Ymd').rand('0','9999');
  $gt_qty = $level_income['levelincome']-$re_in['re'];
  $gt_total_prc=$_POST['coin_qnty'];
  //$gt_prc = mysqli_real_escape_string($con, trim($_POST['coin_price'])); 
  $message= mysqli_real_escape_string($con, trim($_POST['message']));
  $gt_inv_type = '';
  $gt_inv_type_amt = '';
  $gt_temp_date = date('Y-m-d h:i:s');
  $gt_add_date = date('Y-m-d h:i:s');
  $gt_pay_panel = mysqli_real_escape_string($con, trim($_POST['crypto_pay_mod']));
$date = date('Y-m-d h:i:s');
 
   if($_POST['coin_qnty']<=$gt_qty)
  {
      if($_POST['coin_qnty']>=100){
    //   if($buy_ref_key=='' && empty($buy_ref_key))
    //   {
//       function convert_btc($p)
// 	{

// //	$usdamount=$price;
// 	//$url ="https://api.blockchain.info/stats";
// 		$fee='0.5';
// 	$a=$p-$fee;
// 	$url ="https://apiv2.bitcoinaverage.com/convert/global?from=USD&to=BTC&amount=".$a;
// 	$ch = curl_init($url);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 	curl_setopt($ch, CURLOPT_POST, 0);
// 	curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	$output = curl_exec($ch);
// 	curl_close($ch);
// 	$amount = json_decode($output, true);
// 	//print_r($amount);
// 	$amt= number_format((float)$amount['price'], 8, '.', ''); 
// return  $amt;	

// 	}
function convert_btc($cr)
{
$fee='0.5';
$a = $cr-$fee;
$url = "https://api.cryptonator.com/api/ticker/usd-btc";
$stats = json_decode(file_get_contents($url), true);
$btcValue = number_format((float)$stats['ticker']['price'], 8, '.', ''); 
return $btcValue*$a;
}
    $insert_pay_record_qry=mysqli_query($con,"INSERT INTO `withdraw`(`trns_id`,`user_id`,`user_ref_id`, `amount`, `btc_amount`,`message`,`status`, `date`) VALUES ('".$trnss_id."','".$_SESSION['user_id']."','".$_SESSION['ref_idsignup']."','".$gt_total_prc."','". convert_btc($gt_total_prc)."','".$message."','pending','".$gt_add_date."')");
     	if($insert_pay_record_qry)
	 	{
	 	     $user = $_SESSION['ref_idsignup'];
	 	     $gt_se_id = session_id();
  $gt_user_id = $_SESSION['user_id'];
  $login_ck = 'user';
  $gt_user_email = $_SESSION['email'];
  $inv_order_id = date('Ymd').rand('0','9999');
	 	    
	 	     
	 	 //    	$insert_pay_record_qry = mysqli_query($con, "INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`user_id`,`user_rf_id`,`mode`,`user_email`,`verify_number`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`inv_type_amt`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,remarks,`pay_via_panel`,`pay_datetime`) 
    //  	VALUES ('".$gt_se_id."','','".$gt_user_id."','".$user."','".$login_ck."','".$gt_user_email."','','".$inv_order_id."','".$token."','".$gt_prc."','".$gt_total_prc."', '', '','".$phase_i."','".$gt_inv_type."','".$gt_inv_type_amt."','unpaid','','".$gt_temp_date."','".$gt_add_date."','pending','Withdraw','','$gt_add_date')");

	 	     	$_SESSION['sess_od_id'] = $inv_order_id;
	 	
echo '<script>alert("Withdraw Request Successfully Submited!");window.location="index.php";</script>';
	 		// header('location:pay_now.php');
	 	}
	 	else
	 	{
	 		header('location:index.php');
	 	}
    }

else
{
  $msg = '<div class="alert alert-danger" role="alert">Withdraw Minimun Amount atleast $100 </div>';
}
}
else
{
  $msg = '<div class="alert alert-danger" role="alert">Withdraw Amount  lessthan & equalto Level Income</div>';  
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
										<p class="text-center">WITHDRAW SWOCO AMOUNT</p>
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
													<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Level Amount in ($)</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>
																<input type="text" class="form-control"  value="<?php echo $purchase_amount;?>" name="levelamount" id="levelamount"  readonly  required>
															</div>															
														</div>
														
											</div>
											</div>
											<div class="col-sm-6 col-xs-6">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1"> Enter Withdraw Amount ($)</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>
																<!-- <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Enter Amount Here.."> -->
																<input class="form-control" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" autocomplete="off"   name="coin_qnty" id="coin_qnty" required>
	</div>															
														</div>
														
														
													
												</div>
											</div>
												<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Bitcoin Address</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa-address-card" aria-hidden="true"></i></div>
																<input type="text" class="form-control"  value="<?php echo $bitcoinaddress;?>" name="levelamount1"  readonly  required>
															</div>															
														</div>
														
											</div>
											</div>
											<div class="col-sm-12">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Message</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-envelope-open" aria-hidden="true"></i></div>
																<textarea name="message" class="form-control"></textarea>

															</div>															
														</div>
														
														
													<input type="submit" class="btn btn-success mr-10" value="Submit" name="submit" id="submit">
													
												</div>
											</div>
											</form>	
													
										</div>
									</div>
								
								</div>
								
							</div>
						</div>
						
						
						<div class="col-md-6 offset-md-3">	
						<p> <h3 style="color:green;">Note:</h3>You can submit USD amount for withdrawing and you will receive BTC of total withdraw amount</p>  </p>
						</div>
					

					
									
			
			<!-- Footer -->
			
			<!-- /Footer -->
			
		</div>
      </div>
    </div>
  </div>
  
  <?php include('../inc/footer.php');?>
  <script>
//   	 $(document).ready(function()
// {
//     $("#coin_qnty").keyup(function()
//     {

//         var rate, qty, total;
//         rate = parseFloat($("#coin_price").val());
//         qty = parseFloat($("#coin_qnty").val());
//         total =Math.round(qty/rate);
//         if(!isNaN(total))
//         {
//               $("#buy_total_prc").val(total);
//                 }
//         else
//         {
//              $("#buy_total_prc").val("0");
//                  }
//     });
// });
 $(document).ready(function()
{
   

    //     var rate, qty, total;
    //     // rate = parseFloat($("#coin_price").val());
        qty = parseFloat($("#levelamount").val());
       
       
    if(isNaN(qty))
    {
        $('#submit').attr('disabled','disabled');
         $('#coin_qnty').attr('disabled','disabled');
    }
    else
    {
        $('#submit').attr('enabled','enabled');
         $('#coin_qnty').attr('enabled','enabled');
    }
     if(qty=='0')
    {
        $('#submit').attr('disabled','disabled');
         $('#coin_qnty').attr('disabled','disabled');
    }
    else
    {
        $('#submit').attr('enabled','enabled');
         $('#coin_qnty').attr('enabled','enabled');
    }
   
});
  	function numericFilter(txb)
      {
        txb.value = txb.value.replace(/[^\0-9]/ig,'');
      }
  </script>