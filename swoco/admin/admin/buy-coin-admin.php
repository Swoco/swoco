<?php
session_start();
include('inc/dbase.php');
date_default_timezone_set('Asia/Calcutta');
require("../../PHPMailer/class.phpmailer.php");
$add_date = date('Y-m-d h:i:s');
 if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
$sess_id = session_id();
$inv_order_id = date('Ymd').rand('0','999999');
$add_pay_success_date = date('Y-m-d h:i:s');
if((isset($_GET['idt']) && $_GET['idt'] !='') && (isset($_GET['iem']) && $_GET['iem'] !=''))   
{
$buy_ur_id = $_GET['idt'];
$buy_uemail_id = $_GET['iem'];
$user_detail_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='".$buy_ur_id."' AND email='".$buy_uemail_id."'");
if(mysqli_num_rows($user_detail_qry) > 0)
{
    $ref_date = date('Y-m-d h:i:s');
$user_detail_result = mysqli_fetch_array($user_detail_qry);
$buy_ref_key =$user_detail_result['link_reference_id'];
$user=$user_detail_result['reference_id'];
$total_coin_qry2 = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE `status`='1'");
$total_coin_result2 = mysqli_fetch_array($total_coin_qry2);
$phasename=$total_coin_result2['phase'];
$for_inc_percent = $total_coin_result2['unit_coin_prc'];
$phase_i=$total_coin_result2['id'];
$randm_idss2 = md5(uniqid(rand(), true));
 $gt_inv_type = '';
  $gt_inv_type_amt = '';
  $gt_temp_date = date('Y-m-d h:i:s');
  $gt_add_date = date('Y-m-d h:i:s');
  $date=date('Y-m-d h:i:s');
if(isset($_POST['purc_coin_submit_admin']))
{
      $gt_se_id = session_id();
  
  $login_ck = 'user';
 
     $buyy_user_email=$user_detail_result['email'];
  $buyy_user_id = mysqli_real_escape_string($con, trim($_POST['buyy_user_id']));
 // $buyy_user_email = mysqli_real_escape_string($con, trim($_POST['buyy_user_email']));
  $randg_id = mysqli_real_escape_string($con, trim($_POST['randg_id']));
  $phase_mode_nm = mysqli_real_escape_string($con, trim($_POST['phs_mode']));
  $admin_inv_type = mysqli_real_escape_string($con, trim($_POST['pay_invtype_mod_admin']));
  $coin_qnty = mysqli_real_escape_string($con, trim($_POST['coin_qnty']));
  $coin_price = mysqli_real_escape_string($con, trim($_POST['coin_price']));
 // $total_price = $coin_qnty*$coin_price;
 $gt_total_prc = mysqli_real_escape_string($con, trim($_POST['buy_ttl_prc']));
   $commission = mysqli_real_escape_string($con, trim($_POST['admin_charge_fee']));
    $grand_total_price = mysqli_real_escape_string($con, trim($_POST['buy_ttl_prc_admin_charge']));
  $crypto_pay_mod = mysqli_real_escape_string($con, trim($_POST['crypto_pay_mod']));
  	$insert_pay_record_qry = mysqli_query($con, "INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`user_id`,`user_rf_id`,`mode`,`user_email`,`verify_number`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`inv_type_amt`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,remarks,`pay_via_panel`,`pay_datetime`) 
     	VALUES ('".$gt_se_id."','','".$buy_ur_id."','".$user."','".$login_ck."','".$buy_uemail_id."','','".$inv_order_id."','".$coin_qnty."','".$coin_price."','".$gt_total_prc."', '', '','".$phase_i."','".$gt_inv_type."','".$gt_inv_type_amt."','unpaid','','".$gt_temp_date."','".$gt_add_date."','pending','Pay By Admin','','$gt_add_date')");
	if($insert_pay_record_qry)
  			{
   $get_total_coin_qry = mysqli_query($con, "select * from `milkyway_adminassigncoin` where `status`='1'");
  $get_total_result = mysqli_fetch_array($get_total_coin_qry);
 $gt_total_coin = $get_total_result['totalcoin'];
  $rem_left_coin = $gt_total_coin - $coin_qnty;
   $upadate_pay_qry = mysqli_query($con, "UPDATE `milkway_userpay_list` SET `status` = 'success',`pay_datetime`='$add_pay_success_date' WHERE `ord_id` = '".$inv_order_id."'");

   $upadate_icocoin_qry = mysqli_query($con, "UPDATE `milkyway_adminassigncoin` SET `totalcoin` = '$rem_left_coin' where `status`='1'");
//	$msg = '<div class="alert alert-success" role="alert">Successfully Payment Done. !!!</div>';
//echo "<script>alert('Payment Successfully Done!');window.location='Transaction_History.php';</script>";
 //$upadate_pay_qry1 = mysqli_query($con, "UPDATE `milkyway_level__income` SET `pay_status`='success' WHERE `inc_transfer_status` = '".$inv_order_id."'");
 $get_order_deatils_qry = mysqli_query($con, "SELECT * FROM `milkway_userpay_list` WHERE ord_id='".$inv_order_id."' AND `status`='success'");
if(mysqli_num_rows($get_order_deatils_qry) > 0)
{
    
  $get_order_deatils_result = mysqli_fetch_array($get_order_deatils_qry);
  $total_qnty = $get_order_deatils_result['qnty'];
  $total_amt = $get_order_deatils_result['total_price'];
  $unit_qnty = $get_order_deatils_result['unit_price'];
  $gttt_email = $get_order_deatils_result['user_email'];
  $gttt_user_id = $get_order_deatils_result['user_id'];
  $set_order_id = $inv_order_id;
  $to = $gttt_email;
    $mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPSecure = "ssl";  
$mail->Host='smtp.gmail.com;smtp.mail.yahoo.com;smtp-mail.outlook.com';  
$mail->Port='465;587'; 
$mail->Username = "infoswoco@gmail.com";  // SMTP username
$mail->Password = "Swocotoken"; // SMTP password
$mail->SMTPKeepAlive = true;  
$mail->Mailer = "smtp"; 
$mail->IsSMTP(); // telling the class to use SMTP  
$mail->SMTPAuth   = true;                  // enable SMTP authentication  
$mail->CharSet = 'utf-8';  
$mail->SMTPDebug  = 0;   
$mail->Subject ='Payment Notification With Order Id:'.$set_order_id;
$mail->From = $to;
$mail->AddAddress($to, $user_detail_result['name']);
// set word wrap to 50 characters
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);
  
 $subject = 'Payment Notification With Order Id:'.$set_order_id;
 $message = '<div style="background-color:#f5f5f5;width:100%; position:relative;margin:0;padding:70px 0 70px 0">
      <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody>
          <tr>
            <td align="center" valign="top">
              <table border="0" cellpadding="0" cellspacing="0" width="600" id="" style="border-radius:6px!important;background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:6px!important">
                <tbody style="box-shadow: 4px 4px 6px #00000061; ">
                  <tr>
                    <td align="center" valign="top" style="    background: #fe9700;">
                      <img src="https://www.swoco.io/img/core-img/logo.png" style="height:100px" class="">
           
                    </td>
                  </tr>
                  <tr>
                    <td align="center" valign="top">
                      <div style="color:#000;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                        
                                        <div style="color: #ffffff;
    margin: 0;
    padding: 20px 20px 2px 20px;
    display: block;
    font-family: Arial;
    font-size: 26px;
    font-weight: bold;
    text-align: left;
    line-height: 124%;
    text-align: center;
    text-transform: uppercase;
    background: #5cb85cd9;">
                     <img src="http://solacegold.com/solacelogo-success.png" width="70px">
                     <h5>YOUR PAYMENT HAS BEEN SUCCESSFULLY RECEIVED!</h5></div>                                        
                     </div><table border="0" cellpadding="0" cellspacing="0" width="600" id="">
                <tbody>
                          
                        </tbody>
                      </table>
                    </td> </tr><tr>
          <td style="border-bottom: 12px solid #6d3c08;"> <p style="
    padding: 0px 30px;
    font-size: 20px;
    line-height: 30px;
">
    
    Congratulations! 
    <br>
Your Payment has been completed successfully.
  <br> Purchase details are followings:-
<br><br>
Pay User Email- '.$gttt_email.'<br>
Swoco Ico Price-($)'.$unit_qnty.'<br>
Purchased Swoco  Qty.-'.$total_qnty.'<br>
Total Paid Amount ($)- '.$total_amt.'<br>
<br><br>
In order to check any further details about or the status of your purchase please check in your Dashboard.
    </p></td>
     </tr>  
                </tbody>
              </table>
            </td>
          </tr>
          </tbody>
      </table>
      </div>';
    //   $headers .= "MIME-Version: 1.0\r\n";
    //   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    //   $headers .= "From: Solace Gold<info@swoco.io>" . "\r\n";
  //    $headers .= "Bcc: solacegoldservices@gmail.com" . "\r\n";
    //   mail($to,$subject,$message,$headers);
    $mail->Body    = $message;
$mail->AltBody = $message;
$mail->Send();
 }
// $admin_coin_msg=" INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`mode`,`user_id`,`user_email`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,`remarks`,`pay_via_panel`,`pay_datetime`) VALUES ('".$sess_id."', '".$randg_id."', 'admin', '".$buyy_user_id."', '".$buyy_user_email."', '".$inv_order_id."', '".$coin_qnty."', '".$coin_price."', '".$total_price."', '".$commission."', '".$grand_total_price."', '".$phase_mode_nm."', '".$admin_inv_type."', 'unpaid', '', '".$add_date."','".$add_date."','success','Pay By Admin','$crypto_pay_mod','".$add_date."')";
  			$admin_coin_msg ='<div class="alert alert-success" role="alert">Swoco Added Successfully</div>';
  			     }
  			     else
  			{
  				$admin_coin_msg ='<div class="alert alert-danger" role="alert">OOps Unable to Add Swoco Please Try Again !!!</div>';
  			}
  //	}
}			


}
else
{
  $admin_coin_msg ='<div class="alert alert-danger" role="alert">Sorry Swoco Not Available Please Try Again !!!</div>';
}
}




?>
<?php include('inc/header.php');?>
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
										<p class="text-center">SWOCO TOKEN</p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper">
									<div class="panel-body">
									    	<?php if(!empty($admin_coin_msg)) { echo $admin_coin_msg; } ?>
										<div class="row">
										      <input class="hidden" type="text" name="buyy_user_id" value="<?php echo $user_detail_result['id']; ?>">
												<div class="col-sm-12 col-xs-12">

												<div class="form-wrap">

													

														<div class="form-group">

															<label class="control-label mb-10" for="exampleInputuname_1">User Email *</label>

															<div class="input-group">

																<div class="input-group-addon"><i class="fa fa-envelope-open" aria-hidden="true"></i></div>

																 <input class="form-control" type="text" name="buyy_user_email" placeholder="Enter Number of Solace Gold *"  autocomplete="off" value="<?php echo $user_detail_result['email']; ?>" readonly="readonly">

															</div>															

														</div>

														

														

													

												</div>

											</div>
											<div class="col-sm-6 col-xs-6">
											    <form action="" id="purc-coin-form" method="post">
                   
												<div class="form-wrap">
													  
                       <input class="hidden" type="text" name="buyy_user_id" value="<?php echo $user_detail_result['id']; ?>">
										

														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Enter Token Quantity *</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="coin_qnty" name="coin_qnty" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" autocomplete="off" id="coin_qnty" required>
															</div>															
														</div>
														
														
													
										</div>
											</div>
											<div class="col-sm-6 col-xs-6">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Token Price in ($)</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>
																	<input class="form-control" type="text" value="<?php echo $total_coin_result2['unit_coin_prc']; ?>" readonly="readonly">
                                                <input type="hidden" name="coin_price" value="<?php echo $total_coin_result2['unit_coin_prc']; ?>" id="coin_price">
																<!-- <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Enter Amount Here.."> -->
															
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
																	<input type="text" class="form-control" name="buy_ttl_prc" id="buy_total_prc" placeholder="Enter Total Price *" readonly="readonly"> 
															</div>															
														</div>
														<input type="hidden" name="buy_ref_key" value="<?php echo $user_detail_result['link_reference_id']; ?>" readonly="readonly"> 

											<input type="hidden" name="reff_idsignup" value="<?php echo $user_detail_result['reference_id']; ?>" readonly="readonly"> 			
														
								
                                    <input type="hidden" name="randg_id" value="<?php echo $randm_idss2; ?>">
                                    <input type="hidden" name="phs_mode" value="<?php echo $total_coin_result2['id']; ?>">
                                    
                                   
														
													<input type="submit" class="btn btn-success mr-10" value="Submit" name="purc_coin_submit_admin">
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
  
  <?php include('inc/footer.php');?>
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
  	function numericFilter(txb)
      {
        txb.value = txb.value.replace(/[^\0-9]/ig,'');
      }
  </script>