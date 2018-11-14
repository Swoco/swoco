 <?php
error_reporting(0);
include('inc/dbase.php');

if(isset($_SESSION['adm_email']) == '') {
        header("location:log_in.php");
    }  
    ?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <!--<meta name="description" content="Modern admin is super flexible, powerful,
  clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities 
  with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard 
  template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">-->
  <title>
  </title>
  <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/apple-icon-120.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
 <link rel="stylesheet" type="text/css" href="app-assets/css/app.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
 <link rel="stylesheet" type="text/css" href="app-assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <a class="navbar-brand" href="index.php">
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
            
           <!--  <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
              <div class="search-input">
                <input class="input" type="text" placeholder="Explore Modern...">
              </div>
            </li>-->
            
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1" style="color:white;">Hello,
                  <span class="user-name text-bold-700"><?php echo $_SESSION['u_name'];?></span>
                </span>
                 <span>
                 <i class="fa fa-angle-down mg-l-3" style="color:white;"></i>
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="user-profile.php"><i class="ft-user"></i> Edit Profile</a>
                <a class="dropdown-item" href="recover-password.php"><i class="ft-check-square"></i>Change Password</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="ft-power"></i> Logout</a>
              </div>
            </li>
            
            <!--<li class="dropdown dropdown-notification nav-item">-->
            <!--  <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>-->
            <!--    <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">5</span>-->
            <!--  </a>-->
            <!--  <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">-->
            <!--    <li class="dropdown-menu-header">-->
            <!--      <h6 class="dropdown-header m-0">-->
            <!--        <span class="grey darken-2">Notifications</span>-->
            <!--      </h6>-->
            <!--      <span class="notification-tag badge badge-default badge-danger float-right m-0">5 New</span>-->
            <!--    </li>-->
            <!--    <li class="scrollable-container media-list w-100">-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading">You have new order!</h6>-->
            <!--            <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left align-self-center"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading red darken-1">99% Server load</h6>-->
            <!--            <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading yellow darken-3">Warning notifixation</h6>-->
            <!--            <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan"></i></div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading">Complete the task</h6>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading">Generate monthly report</h6>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--    </li>-->
            <!--    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>-->
            <!--  </ul>-->
            <!--</li>-->
            <!--<li class="dropdown dropdown-notification nav-item">-->
            <!--  <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>-->
            <!--  <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">-->
            <!--    <li class="dropdown-menu-header">-->
            <!--      <h6 class="dropdown-header m-0">-->
            <!--        <span class="grey darken-2">Messages</span>-->
            <!--      </h6>-->
            <!--      <span class="notification-tag badge badge-default badge-warning float-right m-0">4 New</span>-->
            <!--    </li>-->
            <!--    <li class="scrollable-container media-list w-100">-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left">-->
            <!--            <span class="avatar avatar-sm avatar-online rounded-circle">-->
            <!--              <img src="app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span>-->
            <!--          </div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading">Margaret Govan</h6>-->
            <!--            <p class="notification-text font-small-3 text-muted">I like your portfolio, let's start.</p>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left">-->
            <!--            <span class="avatar avatar-sm avatar-busy rounded-circle">-->
            <!--              <img src="app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span>-->
            <!--          </div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading">Bret Lezama</h6>-->
            <!--            <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Tuesday</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left">-->
            <!--            <span class="avatar avatar-sm avatar-online rounded-circle">-->
            <!--              <img src="app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"><i></i></span>-->
            <!--          </div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading">Carie Berra</h6>-->
            <!--            <p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Friday</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--      <a href="javascript:void(0)">-->
            <!--        <div class="media">-->
            <!--          <div class="media-left">-->
            <!--            <span class="avatar avatar-sm avatar-away rounded-circle">-->
            <!--              <img src="app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"><i></i></span>-->
            <!--          </div>-->
            <!--          <div class="media-body">-->
            <!--            <h6 class="media-heading">Eric Alsobrook</h6>-->
            <!--            <p class="notification-text font-small-3 text-muted">We have project party this saturday.</p>-->
            <!--            <small>-->
            <!--              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">last month</time>-->
            <!--            </small>-->
            <!--          </div>-->
            <!--        </div>-->
            <!--      </a>-->
            <!--    </li>-->
            <!--    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>-->
          <!--    </ul>-->
          <!--  </li>-->
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

<li class="nav-item "><a href="user_list.php"><i class="fa fa-user"></i><span class="menu-title" >User list</span></a></li>
<li class="nav-item "><a href="reward-hitstory.php"><i class="fa fa-exchange"></i><span class="menu-title" >Reward History</span></a></li>
<li class="nav-item "><a href="Transaction_History.php"><i class="fa fa-exchange"></i><span class="menu-title" >Transaction History</span></a></li>
<li class="nav-item "><a href="search-downline.php"><i class="fa fa-tree"></i><span class="menu-title" >Search Downline Tree</span></a></li>
<li class="nav-item "><a href="level-tree.php"><i class="fa fa-tree"></i><span class="menu-title" >Level Tree</span></a></li>
<li class="nav-item "><a href="direct-level-tree.php"><i class="fa fa-tree"></i><span class="menu-title" >Admin Level Tree</span></a></li>
<li class="nav-item "><a href="sell_list.php"><i class="fa fa-optin-monster"></i><span class="menu-title" >Swoco Market Sell List </span></a></li>
<li class="nav-item "><a href="buy_list.php"><i class="fa fa-th"></i><span class="menu-title" >Swoco Market Buy List</span></a></li>
<li class="nav-item "><a href="reinvestment_list.php"><i class="fa fa-gg"></i><span class="menu-title" >Reinvestment List</span></a></li>
<li class="nav-item "><a href="withdraw-list.php"><i class="fa fa-shopping-cart"></i><span class="menu-title" >Withdraw List</span></a></li>
<li class="nav-item "><a href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title" >Manage Phase </span><span><i class="fa fa-angle-down nav_arrow "></i></span></a>
<ul>
    <li class="nav-item "><a href="manage_phase.php"><i class="fa fa-file-powerpoint-o"></i><span class="menu-title" >Website Phase</span></a></li>
     <li class="nav-item "><a href="manage_app.php"><i class="fa fa-file-powerpoint-o"></i><span class="menu-title" >App Phase</span></a></li>
     
</ul>
</li>
<li class="nav-item "><a href="manage_purchaseamount.php"><i class="fa fa-file-powerpoint-o"></i><span class="menu-title" >Manage Purchase Amount</span></a></li>
<li class="nav-item "><a href="support-histroy.php"><i class="fa fa-envelope-open"></i><span class="menu-title" >Chat Support</span> 

</li>
<li class="nav-item "><a href="notification_for_user.php"><i class="fa fa-bell"></i><span class="menu-title" >Notification</span></a></li>
</ul>

   </div>
  </div>