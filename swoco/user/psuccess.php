<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
date_default_timezone_set('Asia/Calcutta');
$set_order_id='201807134143';
//$set_order_id = $_SESSION['sess_od_id'];
$add_pay_success_date = date('Y-m-d h:i:s');
 $date=date('Y-m-d h:i:s');
$rqfile = implode(',',$_REQUEST);
$pathpge_url = $_SERVER['REQUEST_URI']; 
//echo '<script></script>';
mysqli_query($con, "INSERT INTO `milkyway_request_chk` (`pageurl`,`requestfile`,`date`) values ('".$pathpge_url."','".$rqfile."','".$add_pay_success_date."')");
if($_SESSION['sess_od_id'] == '')
{
  header('location:index.php');
}
$order_rec_qry = mysqli_query($con, "SELECT * FROM `milkway_userpay_list` WHERE `ord_id`='".$set_order_id."' and status='pending'");
if(mysqli_num_rows($order_rec_qry) > 0)
{
   $order_rec_result = mysqli_fetch_array($order_rec_qry);
  $purchase_coin_qty = $order_rec_result['qnty'];
 $purchase_coin= $order_rec_result['total_price'];
 $id=$order_rec_result['user_id'];

	function convert_btc($cr)
{
$url = "https://api.cryptonator.com/api/ticker/usd-btc";
$stats = json_decode(file_get_contents($url), true);
$btcValue = number_format((float)$stats['ticker']['price'], 8, '.', ''); 
return $btcValue*$cr;
}
function convert_btcsell($cr)
{
$fee='0.5';
$a = $cr-$fee;
$url = "https://api.cryptonator.com/api/ticker/usd-btc";
$stats = json_decode(file_get_contents($url), true);
$btcValue = number_format((float)$stats['ticker']['price'], 8, '.', ''); 
return $btcValue*$a;
}
  $get_total_coin_qry = mysqli_query($con, "select * from `milkyway_adminassigncoin` where `status`='1'");
  $get_total_result = mysqli_fetch_array($get_total_coin_qry);
 $gt_total_coin = $get_total_result['totalcoin'];
  $rem_left_coin = $gt_total_coin - $purchase_coin_qty;
 $sql=mysqli_query($con,"select * from payment_token where user_id='".$id."'");
if(mysqli_num_rows($sql)>0){
 $get_total_coin_qry = mysqli_query($con, "select * from `milkyway_icocoin` where `status`='1'");
  $get_total_result = mysqli_fetch_array($get_total_coin_qry);
  $percent = $get_total_result['unit_coin_prc'];
 echo "UPDATE `milkway_userpay_list` SET `status` = 'success',inv_type_amt='". convert_btc($purchase_coin)."',`pay_datetime`='$add_pay_success_date' WHERE `ord_id` = '".$set_order_id."'";
echo "UPDATE `milkyway_level__income` SET `pay_status` = 'success' WHERE `inc_transfer_status` = '".$set_order_id."'";
//   $upadate_pay_qry = mysqli_query($con, "UPDATE `milkway_userpay_list` SET `status` = 'success',inv_type_amt='". convert_btc($purchase_coin)."',`pay_datetime`='$add_pay_success_date' WHERE `ord_id` = '".$set_order_id."'");
//  $upadate_pay_qry1 = mysqli_query($con, "UPDATE `milkyway_level__income` SET `pay_status` = 'success' WHERE `inc_transfer_status` = '".$set_order_id."'");
//$newrecord=mysqli_query($con,"INSERT INTO `payment_token`(`user_id`,`date`)VALUES ('".$id."','".$date."')");
echo "UPDATE `milkyway_adminassigncoin` SET `totalcoin` = '$rem_left_coin' where `status`='1'";
    // $upadate_icocoin_qry = mysqli_query($con, "UPDATE `milkyway_adminassigncoin` SET `totalcoin` = '$rem_left_coin' where `status`='1'");
        $total=$purchase_coin_qty*50/100;
      $sql=mysqli_query($con,"select * from sell_token order by sell_date asc");
  while($rows=mysqli_fetch_assoc($sql))
  { 
      $a[]=$rows;
  }
 foreach($a as $key => $value)
 {
    // echo '<script>alert("'.$value['sell_token'].'");</script>';
 $sell=$value['sell_token'];
  $sellv=$value['sell_token'];
  if($total!=0)
  {
        
     if($sell>=$total)
      {
      $sell=$sell-$total;
      $sell1=$sellv-$total;
      $data=$sellv-$sell1;
      $d=$data*$percent;
         echo 'update sell_token set sell_token="'.$sell.'" where id="'.$value['id'].'"';
         echo "INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,`btc_amount`, `date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$data."','".$d."','". convert_btcsell($d)."','".$date."')";
        //   $query=mysqli_query($con,'update sell_token set sell_token="'.$sell.'" where id="'.$value['id'].'"');
        //   $data=mysqli_query($con,"INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,`btc_amount`, `date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$data."','".$d."','". convert_btcsell($d)."','".$date."')");
  $total=0;
         //echo 'ok';
        }
      else
      {
          // $total=0;
    $total=$total-$sell;
     $s=$sell*$percent;
     echo 'update sell_token set sell_token=0,status="Sold" where id="'.$value['id'].'"';
     echo "INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,btc_amount,`date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$sell."','".$s."','".convert_btcsell($s)."','".$date."')";
//  $query=mysqli_query($con,'update sell_token set sell_token=0,status="Sold" where id="'.$value['id'].'"');
            //  $data=mysqli_query($con,"INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,btc_amount,`date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$sell."','".$s."','".convert_btcsell($s)."','".$date."')");
  
    $get_order_deatils_qry = mysqli_query($con, "SELECT * FROM `milkway_userpay_list` WHERE ord_id='".$set_order_id."' AND `status`='success'");
  $get_order_deatils_result = mysqli_fetch_array($get_order_deatils_qry);
  $total_qnty = $get_order_deatils_result['qnty'];
  $total_amt = $get_order_deatils_result['total_price'];
  $unit_qnty = $get_order_deatils_result['unit_price'];
  $gttt_email = $get_order_deatils_result['user_email'];
  $gttt_user_id = $get_order_deatils_result['user_id'];
  mysqli_query($con, "INSERT INTO `milkyway_adminassigncoin_logfile` (`order_no`,`mode`,`user_id`,`user_email`,`totalcoin`,`amt`,`add_date`) VALUES ('".$set_order_id."','online','".$gttt_user_id."', '".$gttt_email."', '".$total_qnty."','".$total_amt."', '".$add_pay_success_date."')");
 }
  }
  else
    {
    break;
    }
 }
 $pay_msg = '<p class="sucess_content">Thank You For Your Payment With Order Id :'. $set_order_id;
}
else
{
    $get_total_coin_qry = mysqli_query($con, "select * from `milkyway_icocoin` where `status`='1'");
  $get_total_result = mysqli_fetch_array($get_total_coin_qry);
  echo "UPDATE `milkway_userpay_list` SET `status` = 'success',inv_type_amt='". convert_btc($purchase_coin)."',`pay_datetime`='$add_pay_success_date' WHERE `ord_id` = '".$set_order_id."'";
//   $upadate_pay_qry = mysqli_query($con, "UPDATE `milkway_userpay_list` SET `status` = 'success',inv_type_amt='". convert_btc($purchase_coin)."',`pay_datetime`='$add_pay_success_date' WHERE `ord_id` = '".$set_order_id."'");
//   $upadate_pay_qry1 = mysqli_query($con, "UPDATE `milkyway_level__income` SET `pay_status` = 'success' WHERE `inc_transfer_status` = '".$set_order_id."' ");
  echo  "UPDATE `milkyway_level__income` SET `pay_status` = 'success' WHERE `inc_transfer_status` = '".$set_order_id."' ";
  echo  "INSERT INTO `payment_token`(`user_id`,`date`)VALUES ('".$id."','".$date."')";
    //  $newrecord=mysqli_query($con, "INSERT INTO `payment_token`(`user_id`,`date`)VALUES ('".$id."','".$date."')");
    echo "UPDATE `milkyway_adminassigncoin` SET `totalcoin` = '$rem_left_coin' where `status`='1'";
    // $upadate_icocoin_qry = mysqli_query($con, "UPDATE `milkyway_adminassigncoin` SET `totalcoin` = '$rem_left_coin' where `status`='1'");
        $total=$purchase_coin_qty*10/100;
      $sql=mysqli_query($con,"select * from sell_token order by sell_date asc");
  while($rows=mysqli_fetch_assoc($sql))
  { 
      $a[]=$rows;
  }
 foreach($a as $key => $value)
 {
    // echo '<script>alert("'.$value['sell_token'].'");</script>';
 $sell=$value['sell_token'];
  $sellv=$value['sell_token'];
  if($total!=0)
  {
        
     if($sell>=$total)
      {
      $sell=$sell-$total;
      $sell1=$sellv-$total;
      $data=$sellv-$sell1;
       $d=$data*$percent;
         echo 'update sell_token set sell_token="'.$sell.'" where id="'.$value['id'].'"';
         echo "INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,btc_amount, `date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$data."','".$d."','".convert_btcsell($d)."','".$date."')";
        //   $query=mysqli_query($con,'update sell_token set sell_token="'.$sell.'" where id="'.$value['id'].'"');
        //   $data=mysqli_query($con,"INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,btc_amount, `date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$data."','".$d."','".convert_btcsell($d)."','".$date."')");
  
         $total=0;
         //echo 'ok';
        }
      else
      {
          // $total=0;
    $total=$total-$sell;
     $s=$sell*$percent;
     echo 'update sell_token set sell_token=0,status="Sold" where id="'.$value['id'].'"';
     echo "INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,btc_amount, `date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$sell."','".$s."','".convert_btcsell($s)."','".$date."')";
//  $query=mysqli_query($con,'update sell_token set sell_token=0,status="Sold" where id="'.$value['id'].'"');
            //  $data=mysqli_query($con,"INSERT INTO `upload_purchase_swoco`(`sell_user_id`,`buy_user_id`,`order_id`,`status`, `qty`,`income`,btc_amount, `date`) VALUES ('".$value['user_ref_id']."','".$_SESSION['ref_idsignup']."','".$set_order_id."','pending','".$sell."','".$s."','".convert_btcsell($s)."','".$date."')");
    $get_order_deatils_qry = mysqli_query($con, "SELECT * FROM `milkway_userpay_list` WHERE ord_id='".$set_order_id."' AND `status`='success'");
  $get_order_deatils_result = mysqli_fetch_array($get_order_deatils_qry);
  $total_qnty = $get_order_deatils_result['qnty'];
  $total_amt = $get_order_deatils_result['total_price'];
  $unit_qnty = $get_order_deatils_result['unit_price'];
  $gttt_email = $get_order_deatils_result['user_email'];
  $gttt_user_id = $get_order_deatils_result['user_id'];
//   mysqli_query($con, "INSERT INTO `milkyway_adminassigncoin_logfile` (`order_no`,`mode`,`user_id`,`user_email`,`totalcoin`,`amt`,`add_date`) VALUES ('".$set_order_id."','online','".$gttt_user_id."', '".$gttt_email."', '".$total_qnty."','".$total_amt."', '".$add_pay_success_date."')");

        }
  }
  else
    {
    break;
    }
 }
    $pay_msg = '<p class="sucess_content">Thank You For Your Payment With Order Id :'. $set_order_id;

}
}
else
{
$pay_msg = '<p class="sucess_content">OOps Record Not Update In Your Account With Order Id :'. $set_order_id . 'Contact to SWOCO Team !!!!!</p>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payment | <?php echo SITE_MAIN ?></title>

   <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/apple-icon-120.png">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
 
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.min.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
</head>
<body style="    background-image: url(app-assets/images/bg_side.png);" class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column" >
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content sucess_wrap">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 card_bg">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-right">
                      <form class="form-horizontal">
                     <button type="submit" class="btn btn-success text-white"><a href="http://www.swoco.io/swoco/user/index.php" class="text-white">Back to dashbord</a></button>
                    </form>
                   </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 ">
                   <img src="app-assets/images/logo/logo.png" alt="branding logo">
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body text-center">
                   <p class="sucess_title">Payment Confirm </b> </p>
<?php if(!empty($pay_msg)) { echo $pay_msg; } ?></div>
                </div>
              <!--  <div class="card-footer border-0">
                 
                  
                </div>-->
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  </body>

</html>
 