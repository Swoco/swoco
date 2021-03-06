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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Confirmation | <?php echo SITE_MAIN ?></title>

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
                     <button type="submit" class="btn btn-success text-white"><a href="log_in.php"  class="text-white">Sign in</a></button>
                    </form>
                   </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 ">
                   <img src="app-assets/images/logo/logo.png" alt="branding logo">
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body text-center">
                   <p class="sucess_title">Dear <b><?php if(!empty($_GET['n'])){ echo ucwords($_GET['n']);} ?>, </b> </p>
                   <p class="sucess_content">You have successfully joined with us.</p><p class="sucess_content">We have sent a verification link to your registered email address.
                   Kindly verify your email with us. Make sure to check your spam folder in case you don't receive it in your inbox.  </p>
                  </div>
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

