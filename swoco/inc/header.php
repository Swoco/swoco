<?php
error_reporting(0);
include('dbase.php');

if($_SESSION['user_id'] == '')
{
    header('location:log_in.php');
}
$notification_up_qry = mysqli_query($con, "SELECT * FROM `milkyway_usernotification` WHERE id='1'");
$result_notification= mysqli_fetch_array($notification_up_qry);



?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <!--
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
 -->
 
  <title> Swoco
  </title>
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
   <!-- <link rel="stylesheet" type="text/css" href="app-assets/css/font_ex.css"> -->
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
     <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="../user/index.php">
              <img class="brand-logo" alt="" src="app-assets/images/logo/logo.png" style="width:100%;">
             
            </a>
          </li>
        <!--  <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
              <i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>-->
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
           
            
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700"><?php echo $_SESSION['name'];?></span>
                </span>
                <span class="logged-name">
                  <!--<img src="app-assets/images/portrait/small/avatar-s-19.png" alt="avatar">-->
                  <i class="fa fa-angle-down mg-l-3"></i>
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="user-profile.php"><i class="ft-user"></i> Edit Profile</a>
                <a class="dropdown-item" href="recover-password.php"><i class="fa fa-key"></i>Change password</a>
              
                <!--<a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>-->
                <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="ft-power"></i> Logout</a>
              </div>
            </li>
            
            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow"></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Notifications</span>
                  </h6>
                  <!--<span class="notification-tag badge badge-default badge-danger float-right m-0">5 New</span>-->
                </li>
                <li class="scrollable-container media-list w-100">
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                        <!--<h6 class="media-heading">You have new order!</h6>-->
                        <a href="notification.php"><p class="notification-text font-small-3 text-muted"><?php echo substr($result_notification['content'],0,50);?>...</p></a>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?php echo date('F d Y h:i:s', strtotime($result_notification['add_date'])); ?></time>
                        </small>
                      </div>
                    </div>
                  </a>
             </li>
                   </ul>
            </li>
          
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
   <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
<li class="nav-item "><a href="index.php"><i class="fa fa-home"></i><span class="menu-title" >Dashboard</span></a></li>
<!--<li class="nav-item "><a href="Buy_token.php"><i class="fa fa-money"></i><span class="menu-title" >Buy Swoco</span></a></li>-->
<li class="nav-item "><a href="Transaction_History.php"><i class="fa fa-exchange"></i><span class="menu-title" >Transaction History</span></a></li>
<li class="nav-item "><a href="direct_userlist.php"><i class="fa fa-user"></i><span class="menu-title" >Direct User List</span></a></li>
<li class="nav-item "><a href="search-downline.php"><i class="fa fa-tree"></i><span class="menu-title" >Search Downline Tree</span></a></li>
<li class="nav-item "><a href="downline_list.php"><i class="fa fa-signal"></i><span class="menu-title" >Level Income History</span></a></li>
<li class="nav-item "><a href="direct-level-tree.php"><i class="fa fa-tree"></i><span class="menu-title" >User Level Tree</span></a></li>
<li class="nav-item "><a href="levellist.php"><i class="fa fa-shopping-cart"></i><span class="menu-title" >User Level Table </span></a>
</li>  
<li class="nav-item "><a href="Swoco_Market.php"><i class="fa fa-optin-monster"></i><span class="menu-title" >SWOCO Market</span> 
<span><i class="fa fa-angle-down nav_arrow "></i></span></a>
<ul>
     <li class="nav-item "><a href="Swoco_Market.php"><i class="fa fa-optin-monster"></i><span class="menu-title" >Market</span></a></li>
        <li class="nav-item "><a href="mysell_token.php"><i class="fa fa-money"></i><span class="menu-title" >Sell Swoco status </span></a></li>
       </ul>
</li>
<li class="nav-item "><a href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title" >Withdraw </span><span><i class="fa fa-angle-down nav_arrow "></i></span></a>
<ul>
     <li class="nav-item "><a href="reinvestment_token.php"><i class="fa fa-gg"></i><span class="menu-title" >Reinvestment</span></a></li>
     <li class="nav-item "><a href="reinvestment_list.php"><i class="fa fa-exchange"></i><span class="menu-title" >Reinvestment List</span></a></li>
     <li class="nav-item "><a href="withdraw.php"><i class="fa fa-shopping-cart"></i><span class="menu-title" >Withdraw </span></a></li>
     <li class="nav-item "><a href="withdraw-list.php"><i class="fa fa-money"></i><span class="menu-title" >Withdraw List</span></a></li>
</ul>
</li>
<li class="nav-item "><a href="referral_link.php"><i class="fa fa-link"></i><span class="menu-title" >Referral Link</span></a></li>
<li class="nav-item "><a href="notification.php"><i class="fa fa-bell"></i><span class="menu-title" >Notification</span></a></li>
<li class="nav-item "><a href="support.php"><i class="fa fa-envelope-open"></i><span class="menu-title" >Support</span></a></li>
<li class="nav-item "><a href="video.php"><i class="fa fa-video-camera"></i><span class="menu-title" >Video</span></a></li>
<li class="nav-item "><a href="logout.php"><i class="ft-power"></i><span class="menu-title" > Logout</span></a></li>
</ul>
  </div>
  </div>
  <?php
    $get_profile_url = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1);
   
    if($get_profile_url != 'user-profile.php')
    {
    $se_idfg = $_SESSION['user_id'];
    $mob_verif_chkquery = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `id`='".$se_idfg."'  AND country='' AND region=''");
    if(mysqli_num_rows($mob_verif_chkquery) > 0)
    {
    
      echo "<script>alert('Please Update Your Profile First !!!');window.location='user-profile.php';</script>";
    }
      }
 ?> 
   <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125014025-1"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'UA-125014025-1');
</script>