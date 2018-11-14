<?php
error_reporting(0);
include('../inc/dbase.php');

if(isset($_GET['p']) && $_GET['p'] != '')
{
    $offer_path = '?p='.$_GET['p'].'&rnd_c='.$_GET['rnd_c'];
}
else
{
    $offer_path = '';
}

if($_GET['uidcode'] !='')
{
  $getemail = mysqli_real_escape_string($con,trim($_GET['uidcode']));

  $check_validate_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE md5(email)='".$getemail."' AND `status`='0'");
	$check_valiadte_data = mysqli_fetch_array($check_validate_qry);
	if(mysqli_num_rows($check_validate_qry) > 0)
	{
		$update_signup_qry = mysqli_query($con, "update `milkyway_usersignup` set `status`='1' where md5(email)='".$getemail."'");
		if($update_signup_qry)
		{
			$page_msg = "Your Account has been Activated Successfully !";
		}
		else
		{
			$page_msg = "Unable to Activate Please Try Again !!!";
		}
	}
	else
	{
		 $check_validaten_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE md5(email)='".$getemail."' AND `status`='1'");
	$check_valiadten_data = mysqli_fetch_array($check_validaten_qry);
	if(mysqli_num_rows($check_validaten_qry) > 0)
	{
		$page_msg = "<span style='color:white;'>You have Already Verified Your Account successfully!</span>";
	}
	else
	{
		$page_msg = " This is invalid Url Please try Again !!!!!!!";
	}
	}
}
else
{
	header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Verification | <?php echo SITE_MAIN ?></title>

   <link rel="shortcut icon"  href="../app-assets/images/ico/apple-icon-120.png">

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
<body style="background-image: url(app-assets/images/bg_side.png);" class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
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
                     <button type="submit" class="btn btn-success text-white"><a href="log_in.php"  class="text-white">Sign in</a></button>
                    </form>
                   </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 ">
                   <img src="app-assets/images/logo/logo.png" alt="branding logo">
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body text-center">
                   <p class="sucess_title" style="
    margin-bottom: 4px;
">
                       <b style="
    color: #FFEB3B;
"> Congratulations! </b> </p>
                   
                     <h5 class="payment-ok text-white"><b> Your account has been successfully verified.</b> </h5>
                      <h5 class="payment-ok text-white"><b> Login to start journey with Swoco</b></h5>
                  </div>
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

