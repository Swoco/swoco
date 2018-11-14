<?php //include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
date_default_timezone_set('Asia/Calcutta');
require("../../PHPMailer/class.phpmailer.php");
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    } 

$get_contact_number_id = $_GET['userid'];
$id=$_GET['purcid'];
$total_amount=$_GET['qty'];
 $inv_order_id = $_GET['order_id'];
$limit_purchase = mysqli_query($con, "SELECT * FROM milkyway_swoco_list WHERE 1=1 ORDER BY `id` desc");
$limit_purchaseamount = mysqli_fetch_array($limit_purchase);
$get_contact_number_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `id`='".$get_contact_number_id."'");
$get_contact_number_result = mysqli_fetch_array($get_contact_number_qry);
$randm_idss2 = md5(uniqid(rand(), true));
$total_coin_qry2 = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE `status`='1'");
$total_coin_result2 = mysqli_fetch_array($total_coin_qry2);
$phasename=$total_coin_result2['phase'];
$for_inc_percent = $total_coin_result2['unit_coin_prc'];
$phase_i=$total_coin_result2['id'];
if(isset($_POST['submit']))
{
 
  //$user = $_SESSION['ref_idsignup'];
  $urs_id = $_GET['userid'];
$user_detail_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='".$urs_id."' ");
$user_detail_result = mysqli_fetch_array($user_detail_qry);
$buy_ref_key =$user_detail_result['link_reference_id'];
  $gt_se_id = session_id();
  $gt_user_id = $_GET['userid'];
  $login_ck = 'user';
  $gt_user_email = $user_detail_result['email'];
 
  $gt_qty = mysqli_real_escape_string($con, trim($_POST['coin_qnty']));
  $gt_prc = mysqli_real_escape_string($con, trim($_POST['coin_price'])); 
  $gt_total_prc = mysqli_real_escape_string($con, trim($_POST['buy_ttl_prc']));
  $gt_inv_type = '';
  $gt_inv_type_amt = '';
  $gt_temp_date = date('Y-m-d h:i:s');
  $gt_add_date = date('Y-m-d h:i:s');
  $date=date('Y-m-d h:i:s');
  $gt_pay_panel = mysqli_real_escape_string($con, trim($_POST['crypto_pay_mod']));
$ref_date = date('Y-m-d h:i:s');
	$insert_pay_record_qry = mysqli_query($con,  "UPDATE `milkway_userpay_list` SET qnty='".$gt_qty."',unit_price='".$gt_prc."',total_price='".$gt_total_prc."', phase_mode='".$phase_i."',status='success',remarks='Buy Token' WHERE ord_id = '".$inv_order_id."'");
    $upadate_pay_qry1 = mysqli_query($con, "UPDATE `milkyway_level__income` SET `pay_status` = 'success' WHERE `inc_transfer_status` = '".$inv_order_id."'");
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
$mail->Subject ='Payment Notification With Order Id:'.$inv_order_id;
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
  
  
   $get_total_coin_qry = mysqli_query($con, "select * from `milkyway_adminassigncoin` where `status`='1'");
  $get_total_result = mysqli_fetch_array($get_total_coin_qry);
 $gt_total_coin = $get_total_result['totalcoin'];
  $rem_left_coin = $gt_total_coin - $gt_qty;
   $upadate_icocoin_qry = mysqli_query($con, "UPDATE `milkyway_adminassigncoin` SET `totalcoin` = '$rem_left_coin' where `status`='1'");
//$msg = '<div class="alert alert-success" role="alert">Successfully Payment Done. !!!</div>';
echo "<script>alert('Payment Successfully Done!');window.location='Transaction_History.php';</script>";
//}

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
										<p class="text-center">SWOCO Payment </p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper">
									<div class="panel-body">
									    <div class="alert alert-danger" role="alert" style="display:none;" id="nophase">Oops! ICO is not started yet</div>
									    	<?php if(!empty($msg)) { echo $msg; } ?>
										<div class="row">
										     
											<div class="col-sm-6 col-xs-6">
											    <form action="" id="purc-coin-form" method="post">
                   
												<div class="form-wrap">
													     <input type="hidden" name="verify-phn-num" value="<?php echo $get_contact_number_result['contact']; ?>">
                        <input type="hidden" name="crypto_pay_mod" value="<?php echo $p_gateway_val; ?>">
	<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Enter Amount in ($)</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>
																	<input type="text" class="form-control" name="buy_ttl_prc" id="buy_total_prc" autocomplete="off"  value="<?php echo $total_amount?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly > 

															</div>															
														</div>
													
														
														
													
										</div>
											</div>
											<div class="col-sm-6 col-xs-6">
												<div class="form-wrap">
													
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Swoco Price in ($)</label>
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
															<label class="control-label mb-10" for="exampleInputuname_1">Total Swoco Quantity *</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="coin_qnty" name="coin_qnty" autocomplete="off" id="coin_qnty" readonly required>
															</div>															
														</div>
														<!--<div class="form-group">-->
														<!--	<label class="control-label mb-10" for="exampleInputuname_1">Total Amount in ($)</label>-->
														<!--	<div class="input-group">-->
														<!--		<div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>-->
														<!--			<input type="text" class="form-control" name="buy_ttl_prc" id="buy_total_prc" readonly="readonly"> -->

														<!--	</div>															-->
														<!--</div>-->
														
														<input type='hidden' name="phasename" id="phasename" value="<?php echo $phasename?>">
													<input type="submit" class="btn btn-success mr-10" value="Submit" name="submit" id="submit">
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
    var name=$("#phasename").val();
    if(name=='No Phase')
    {
       $('#submit').prop('disabled', true);
       $('#nophase').show(); 
    }
    else
    {
      $('#submit').show(); 
       $('#nophase').hide(); 
    }
    $("#buy_total_prc").keyup(function()
    {

        var rate, qty, total;
        rate = parseFloat($("#coin_price").val());
        qty = parseFloat($("#buy_total_prc").val());
        total = qty/rate;
        if(!isNaN(total))
        {
            //alert(total);
            //var totalbuy = total.toFixed(4);
            $("#coin_qnty").val(total);
            // var admin_fee_val = $('#admin_charge_fee').val();
            var fee_total = total + (total/100);
             $("#buy_ttl_prc_admin_charge").val(fee_total);
        }
        else
        {
            //alert(total);
            $("#coin_qnty").val("0");
             // $("#buy_ttl_prc_admin_charge").val("0");
        }
    });
});


 $(document).ready(function()
{
    var name=$("#phasename").val();
    if(name=='No Phase')
    {
       $('#submit').prop('disabled', true);
       $('#nophase').show(); 
    }
    else
    {
      $('#submit').show(); 
       $('#nophase').hide(); 
    }
   
        var rate, qty, total;
        rate = parseFloat($("#coin_price").val());
        qty = parseFloat($("#buy_total_prc").val());
        total = qty/rate;
        if(!isNaN(total))
        {
            //alert(total);
            //var totalbuy = total.toFixed(4);
            $("#coin_qnty").val(total);
            // var admin_fee_val = $('#admin_charge_fee').val();
            var fee_total = total + (total/100);
             $("#buy_ttl_prc_admin_charge").val(fee_total);
        }
        else
        {
            //alert(total);
            $("#coin_qnty").val("0");
             // $("#buy_ttl_prc_admin_charge").val("0");
        }

});
  	function numericFilter(txb)
      {
        txb.value = txb.value.replace(/[^\0-9]/ig,'');
      }
  </script>