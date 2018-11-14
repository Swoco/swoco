<?php
error_reporting(0);
include('../inc/dbase.php');

if(!isset($_SESSION))
{
  session_start();
}
date_default_timezone_set('Asia/Calcutta');
$set_order_id = $_SESSION['sess_od_id'];

$add_pay_failure_date = date('Y-m-d h:i:s');

$rqfile = implode(',',$_REQUEST);
$pathpge_url = $_SERVER['REQUEST_URI']; 

mysqli_query($con, "INSERT INTO `milkyway_request_chk` (`pageurl`,`requestfile`,`date`) values ('".$pathpge_url."','".$rqfile."','".$add_pay_failure_date."')");


if($_SESSION['sess_od_id'] == '')
{
  header('location:index.php');
}

$order_rec_qry = mysqli_query($con, "SELECT * FROM `milkway_userpay_list` WHERE `ord_id`='".$set_order_id."' AND `status` NOT IN ('success')");
if(mysqli_num_rows($order_rec_qry) > 0)
{
  $upadate_pay_qry = mysqli_query($con, "UPDATE `milkway_userpay_list` SET `status` = 'failure',`pay_datetime`='$add_pay_failure_date' WHERE `ord_id` = '".$set_order_id."'");
  if(mysqli_affected_rows($con))
  {
    $fail_msg = '<p class="sucess_content">OOPs Your Payment Failed With Order Id :'. $set_order_id;
  }
  else
  {
    $fail_msg = '<p class="sucess_content">OOPs Your Payment Failed</p><p class="sucess_content"> Something Wrong With Order Id :'. $set_order_id . 'Contact to SWOCO Team !!!</p>';
  }
}
else
{
$fail_msg = '<p class="sucess_content">OOPs Your Payment Failed</p><p class="sucess_content">Record Not Update Your Account With Order Id :'. $set_order_id . 'Contact to SWOCO Team.</p>';
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
                     <button type="submit" class="btn btn-success text-white"><a href="index.php" class="text-white">Back to dashbord</a></button>
                    </form>
                   </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 ">
                   <img src="app-assets/images/logo/logo.png" alt="branding logo">
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body text-center">
                   <p class="sucess_title">Payment Failed </b> </p>
<?php if(!empty($fail_msg)) { echo $fail_msg; } ?> </div>
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
 