<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
date_default_timezone_set('Asia/Calcutta');
$set_order_id = $_SESSION['sess_od_id'];
$date = date('Y-m-d h:i:s');
if($_SESSION['sess_od_id'] == '')
{
	header('location:index.php');
}
$order_id='Order Id:'.' '.$_SESSION['sess_od_id'];
$order_rec_qry = mysqli_query($con, "SELECT * FROM `milkway_userpay_list` WHERE `ord_id`='".$set_order_id."' AND `status`='pending'");
if(mysqli_num_rows($order_rec_qry) > 0)
{
$order_result = mysqli_fetch_array($order_rec_qry);
$order_idd = $order_result['ord_id'];
$order_currency_pay = $order_result['inv_type'];
if($order_currency_pay == '')
{
	$order_currency_pay_amnt = 'usd';
	$order_amt = $order_result['total_price'];
}
$crypto_action = "https://api.cryptonator.com/api/merchant/v1/startpayment";
$merch_id = "9308931d1a41c515431e15a4db185391";
$inv_item_name = 'Swoco Payment';
$inv_currency = $order_currency_pay_amnt;
$inv_amount = $order_amt;
$inv_lang = 'en';

$inv_order_id = $order_idd;
$inv_success_url = $root_path_user.'pay_success.php';
$inv_failure_url = $root_path_user.'pay_failure.php';
}
else
{
	header('location:Buy_token.php?r=4');
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
<?php include('../inc/footer.php');?>
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
                  <!--<div class="card-title text-right">-->
                     
                  <!-- </div>-->
                 </div>
                <div class="card-content">
                  <div class="card-body text-center">
                      <form id="frm-paynow" method="GET" action="https://api.cryptonator.com/api/merchant/v1/startpayment">
<input type="hidden" name="merchant_id" value="9308931d1a41c515431e15a4db185391">
<input type="hidden" name="item_name" value="<?php echo $inv_item_name .' '. $date; ?>">
<input type="hidden" name="item_description" value="<?php echo $order_result['user_email']; ?>">
<input type="hidden" name="order_id"  value="<?php echo $order_id; ?>">
<input type="hidden" name="invoice_currency" value="<?php echo $inv_currency; ?>">
<input type="hidden" name="invoice_amount" value="<?php echo $inv_amount; ?>" data-type="number">
<input type="hidden" name="language" value="en">
<input type="hidden" name="success_url" value="<?php echo $root_path_main; ?>pay_success.php">
<input type="hidden" name="failed_url" value="<?php echo $root_path_main; ?>pay_failure.php">
<input type="submit" value="Pay with cryptocurrency"  class="btn btn-success text-white">
</form>
                 </div>
                </div>
                <div class="card-footer border-0">
                 <h3 style="color:red;">Note -</h3>Click on Pay with Cryptocurrency and After payment Please Do Not Close the Page. Page Automatically refresh and send you on your Dashboard.
                  
                </div>
              </div>
            </div>
          </div>  
  </section>
 </div>
    </div>
  </div>
</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
     <script>
     $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    // });
});
</script>
