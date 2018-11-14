   

 
<?php
error_reporting(0);
include('../inc/dbase.php');

if($_SESSION['user_id'] == '')
{
    header('location:log_in.php');
}
$notification_up_qry = mysqli_query($con, "SELECT * FROM `milkyway_usernotification` WHERE id='1'");
$result_notification= mysqli_fetch_array($notification_up_qry);



?>

<?php
error_reporting(0);
include('../inc/dbase.php');
include('../inc/checker.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}
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
     
 <link rel="stylesheet" type="text/css" href="../admin/app-assets/vendors/css/tables/datatable/datatables.min.css">
   <link rel="stylesheet" type="text/css" href="../admin/app-assets/css/jquery.treegrid.css">
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
                <!--<li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>-->
              </ul>
            </li>
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
            <!--  </ul>-->
            <!--</li>-->
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
   <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">

<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <!--<li class="add-hover nav-item "><a href=""><i class="fa fa-home"></i><span class="menu-title" >Reward</span></a>-->
    
    
    <!--</li>-->
    <!--<div class="rtitem">-->
    <!--<p> Asia</p>    -->
    <!--   <p> Europe</p>  -->
    <!--   <p> US</p>  -->
    <!--</div>-->
 
  
<li class="nav-item "><a href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title blinking" >Reward </span><span><i class="fa fa-angle-down nav_arrow "></i></span></a>
<ul>
     <li class="nav-item "><a href="asia.php"><span class="menu-title" >Asia Pacific Region</span></a></li>
     <li class="nav-item "><a href="europe.php"><span class="menu-title" >Europe Region</span></a></li>
     <li class="nav-item "><a href="us.php"><span class="menu-title" >USA Region </span></a></li>
    
</ul>
</li>  
  
    
<li class="nav-item "><a href="index.php"><i class="fa fa-home"></i><span class="menu-title" >Dashboard</span></a></li>

<li class="nav-item "><a href="Buy_token.php"><i class="fa fa-money"></i><span class="menu-title" >Buy Swoco</span></a></li>
<li class="nav-item "><a href="Transaction_History.php"><i class="fa fa-exchange"></i><span class="menu-title" >Transaction History</span></a></li>
<li class="nav-item "><a href="direct_userlist.php"><i class="fa fa-user"></i><span class="menu-title" >Direct User List</span></a></li>
<!--<li class="nav-item "><a href="downline_list"><i class="fa fa-signal"></i><span class="menu-title" >Level Income History</span></a></li>-->
<li class="nav-item "><a href="downline_list.php"><i class="fa fa-signal"></i><span class="menu-title" >Level Income History</span></a></li>
<!--<li class="nav-item "><a href="tree-view.php"><i class="fa fa-tree"></i><span class="menu-title" >User Level Table</span></a></li>-->
<li class="nav-item "><a href="tree-view.php"><i class="fa fa-shopping-cart"></i><span class="menu-title" >User Level Table </span></a>

</li>  

<li class="nav-item "><a href="Swoco_Market.php"><i class="fa fa-optin-monster"></i><span class="menu-title" >SWOCO Market</span> 
<span><i class="fa fa-angle-down nav_arrow "></i></span></a>
<ul>
     <li class="nav-item "><a href="Swoco_Market.php"><i class="fa fa-optin-monster"></i><span class="menu-title" >Market</span></a></li>
    <!--<li class="nav-item "><a href="buy_history.php"><i class="fa fa-shopping-cart"></i><span class="menu-title" >My Buy Token List</span></a></li>-->
        <li class="nav-item "><a href="mysell_token.php"><i class="fa fa-money"></i><span class="menu-title" >Sell Swoco status </span></a></li>
         <!--<li class="nav-item "><a href="buy_list_me.php"><i class="fa fa-shopping-cart"></i><span class="menu-title" >Buy Token List</span></a></li>-->
       
        <!--<li class="nav-item "><a href="cancel_sell_token.php"><i class="fa fa-ban"></i><span class="menu-title" >Cancel Sell Token</span></a></li>-->
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
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">User Level Table</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">User Level Table
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="file-export" style="overflow:auto;">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"></h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard">
                  
                  <table class="table table-striped table-bordered file-export tree" style="font-family: vev !important;">
                      <tr style="
    background: #5f76bb;
    color:  white;text-align:center;
"> <td >User Id</td><td>Name</td><td>Purchased($)</td><td>Total Swoco</td><td>Level</td><td>Date of Joining</td></tr>
       <?php
$query_coin_prc = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` where status='1' order by id");
$today_cn_price = mysqli_fetch_array($query_coin_prc);
$today_cn_price123 = $today_cn_price['unit_coin_prc'];

$select_tree = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$_SESSION['ref_idsignup']."'");
while($row_tree = mysqli_fetch_array($select_tree)){
$ur_refss=$row_tree['id'];
$ur_refss_id = $row_tree['reference_id'];
$query_ref_qry = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result = mysqli_fetch_array($query_ref_qry);

$query_ref_qry1 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result1 = mysqli_fetch_array($query_ref_qry1);

$query_ref_qry2 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$reinvest=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss."'");
$reinvest_income=mysqli_fetch_array($reinvest);

$buy=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss."'");
$buy_amount=mysqli_fetch_array($buy);

$total_amount=$query_ref_amt_result1['amount']+$query_ref_amt_result2['amount1'];

$total_income_amnt1a = $query_ref_amt_result['ref_total_amt'];

if($total_income_amnt1a == '')
{
$total_income_amnt = 0;
}
else
{
$total_income_amnt = $total_income_amnt1a;
}


?>
                <tr class="treegrid-1">
                    <td>
                        <!--<a target="_parent" href="tree1?sr=<?php echo $row_tree['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree['name']; ?><br><b>Email:</b> <?php echo $row_tree['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree['link_reference_id'];?><br><b>Level Income:</b> $<?php echo floor($total_income_amnt);?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result2['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result1['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
<span><?php echo $row_tree['reference_id']; ?></span>
<!--</a>-->
<td><?php echo $row_tree['name'];?></td><td><?php echo  floor($total_amount);?></td><td><?php echo floor($query_ref_amt_result1['token']);?></td>
<td>0</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree['date']));?></td>
                <?php
$select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree['reference_id']."'");
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
	
?>
                <tr class="treegrid-2 treegrid-parent-1">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_2['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_2['name']; ?><br><b>Email:</b> <?php echo $row_tree_2['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_2['link_reference_id'];?><br><b>LEVEL Income:</b> $<?php echo floor($total_income_amnt_2);?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result21['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income1['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount1['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount1);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result11['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_2['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
<?php echo $row_tree_2['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_2['name'];?></td><td><?php echo  floor($total_amount1);?></td><td><?php echo floor($query_ref_amt_result11['token']);?></td>
<td>1</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_2['date']));?></td>

                <?php
$select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
		$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest2=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income2=mysqli_fetch_array($reinvest2);

$buy2=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount2=mysqli_fetch_array($buy2);

$total_amount2=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}

	?>
                <tr class="treegrid-3 treegrid-parent-2">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_3['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_3['name']; ?><br><b>Email:</b> <?php echo $row_tree_3['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_3['link_reference_id'];?><br><b>LEVEL Income:</b> $<?php echo $total_income_amnt_3;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result22['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income2['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount2['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount2);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result12['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_3['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
<?php echo $row_tree_3['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_3['name'];?></td><td><?php echo  floor($total_amount2);?></td><td><?php echo floor($query_ref_amt_result12['token']);?></td>
<td>2</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_3['date']));?></td>

                	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
                <tr class="treegrid-4 treegrid-parent-3">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_4['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_4['name']; ?><br><b>Email:</b> <?php echo $row_tree_4['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_4['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_4;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result23['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income3['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount3['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount3);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result13['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_4['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
<?php echo $row_tree_4['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_4['name'];?></td><td><?php echo  floor($total_amount3);?></td><td><?php echo floor($query_ref_amt_result13['token']);?></td>
<td>3</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_4['date']));?></td>

                	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
                <tr class="treegrid-5 treegrid-parent-4">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_5['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_5['name']; ?><br><b>Email:</b> <?php echo $row_tree_5['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_4['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_5;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result24['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income4['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount4['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount4);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result14['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_5['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
 <?php echo $row_tree_5['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_5['name'];?></td><td><?php echo  floor($total_amount4);?></td><td><?php echo floor($query_ref_amt_result14['token']);?></td>
<td>4</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_5['date']));?></td>

                <?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result15 = mysqli_fetch_array($query_ref_qry15);

$query_ref_qry25 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss6."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result25 = mysqli_fetch_array($query_ref_qry25);

$reinvest5=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss6."'");
$reinvest_income5=mysqli_fetch_array($reinvest5);

$buy5=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss6."'");
$buy_amount5=mysqli_fetch_array($buy5);

$total_amount5=$query_ref_amt_result15['amount']+$query_ref_amt_result25['amount1'];

$total_income_amnt_6a = $query_ref_amt_result6['ref_total_amt'];
if($total_income_amnt_6a == '')
{
$total_income_amnt_6 = 0;
}
else
{
$total_income_amnt_6 = $total_income_amnt_6a;
}

	?>
                <tr class="treegrid-6 treegrid-parent-5">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_6['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_6['name']; ?><br><b>Email:</b> <?php echo $row_tree_6['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_6['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_6;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result25['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income5['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount5['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount5);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result15['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_6['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
 <?php echo $row_tree_6['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_6['name'];?></td><td><?php echo  floor($total_amount5);?></td><td><?php echo floor($query_ref_amt_result15['token']);?></td>
<td>5</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_6['date']));?></td>

                	<?php
$select_tree_7 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_6['reference_id']."'");
while($row_tree_7 = mysqli_fetch_array($select_tree_7)){
$ur_refss7=$row_tree_7['id'];
		$ur_refss_id7 = $row_tree_7['reference_id'];
$query_ref_qry7 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id7."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result7 = mysqli_fetch_array($query_ref_qry7);

$query_ref_qry16 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss7."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result16 = mysqli_fetch_array($query_ref_qry16);

$query_ref_qry26 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss7."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result26 = mysqli_fetch_array($query_ref_qry26);

$reinvest6=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss7."'");
$reinvest_income6=mysqli_fetch_array($reinvest6);

$buy6=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss7."'");
$buy_amount6=mysqli_fetch_array($buy6);

$total_amount6=$query_ref_amt_result16['amount']+$query_ref_amt_result26['amount1'];

$total_income_amnt_7a = $query_ref_amt_result7['ref_total_amt'];
if($total_income_amnt_7a == '')
{
$total_income_amnt_7 = 0;
}
else
{
$total_income_amnt_7 = $total_income_amnt_7a;
}

	?>

                <tr class="treegrid-7 treegrid-parent-6">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_7['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_7['name']; ?><br><b>Email:</b> <?php echo $row_tree_7['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_7['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_7;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result26['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income6['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount6['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount6);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result16['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_7['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
 <?php echo $row_tree_7['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_7['name'];?></td><td><?php echo  floor($total_amount6);?></td><td><?php echo floor($query_ref_amt_result16['token']);?></td>
<td>6</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_7['date']));?></td>

                	<?php
$select_tree_8 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_7['reference_id']."'");
while($row_tree_8 = mysqli_fetch_array($select_tree_8)){
$ur_refss8=$row_tree_8['id'];
		$ur_refss_id8 = $row_tree_8['reference_id'];
$query_ref_qry8 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id8."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result8 = mysqli_fetch_array($query_ref_qry8);

$query_ref_qry17 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss8."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result17 = mysqli_fetch_array($query_ref_qry17);

$query_ref_qry27 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss8."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result27 = mysqli_fetch_array($query_ref_qry27);

$reinvest7=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss8."'");
$reinvest_income7=mysqli_fetch_array($reinvest7);

$buy7=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss8."'");
$buy_amount7=mysqli_fetch_array($buy7);

$total_amount7=$query_ref_amt_result17['amount']+$query_ref_amt_result27['amount1'];

$total_income_amnt_8a = $query_ref_amt_result8['ref_total_amt'];
if($total_income_amnt_8a == '')
{
$total_income_amnt_8 = 0;
}
else
{
$total_income_amnt_8 = $total_income_amnt_8a;
}

	?>
                <tr class="treegrid-8 treegrid-parent-7">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_8['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_8['name']; ?><br><b>Email:</b> <?php echo $row_tree_8['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_8['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_8;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result27['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income7['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount7['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount7);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result17['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_8['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
Ref id: <?php echo $row_tree_8['reference_id']; ?>
<!--</a> -->
<td><?php echo $row_tree_8['name'];?></td><td><?php echo  floor($total_amount7);?></td><td><?php echo floor($query_ref_amt_result17['token']);?></td>
<td>7</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_8['date']));?></td>
 
                
                <?php
$select_tree_9 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_8['reference_id']."'");
while($row_tree_9 = mysqli_fetch_array($select_tree_9)){
$ur_refss9=$row_tree_9['id'];
		$ur_refss_id9 = $row_tree_9['reference_id'];
$query_ref_qry9 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id9."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result9 = mysqli_fetch_array($query_ref_qry9);

$query_ref_qry18 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss9."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result18 = mysqli_fetch_array($query_ref_qry18);

$query_ref_qry28 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss9."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result28 = mysqli_fetch_array($query_ref_qry28);

$reinvest8=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss9."'");
$reinvest_income8=mysqli_fetch_array($reinvest8);

$buy8=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss9."'");
$buy_amount8=mysqli_fetch_array($buy8);


$total_amount8=$query_ref_amt_result18['amount']+$query_ref_amt_result28['amount1'];

$total_income_amnt_9a = $query_ref_amt_result9['ref_total_amt'];
if($total_income_amnt_9a == '')
{
$total_income_amnt_9 = 0;
}
else
{
$total_income_amnt_9 = $total_income_amnt_9a;
}

	?>

                 <tr class="treegrid-9 treegrid-parent-8">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_9['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_9['name']; ?><br><b>Email:</b> <?php echo $row_tree_9['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_9['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_9;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result28['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income8['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount8['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount8);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result18['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_9['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
 <?php echo $row_tree_9['reference_id']; ?>
<!--</a>   -->
<td><?php echo $row_tree_9['name'];?></td><td><?php echo  floor($total_amount8);?></td><td><?php echo floor($query_ref_amt_result18['token']);?></td>
<td>8</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_9['date']));?></td>
 
                	<?php
$select_tree_10 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_9['reference_id']."'");
while($row_tree_10 = mysqli_fetch_array($select_tree_10)){
$ur_refss10=$row_tree_10['id'];
		$ur_refss_id10 = $row_tree_10['reference_id'];
$query_ref_qry10 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id10."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result10 = mysqli_fetch_array($query_ref_qry10);

$query_ref_qry19 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss10."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result19 = mysqli_fetch_array($query_ref_qry19);

$query_ref_qry29 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss10."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result29 = mysqli_fetch_array($query_ref_qry29);

$reinvest9=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss10."'");
$reinvest_income9=mysqli_fetch_array($reinvest9);

$buy9=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss10."'");
$buy_amount9=mysqli_fetch_array($buy9);

$total_amount9=$query_ref_amt_result19['amount']+$query_ref_amt_result29['amount1'];

$total_income_amnt_10a = $query_ref_amt_result10['ref_total_amt'];
if($total_income_amnt_10a == '')
{
$total_income_amnt_10 = 0;
}
else
{
$total_income_amnt_10 = $total_income_amnt_10a;
}
?>

                 <tr class="treegrid-10 treegrid-parent-9">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_10['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_10['name']; ?><br><b>Email:</b> <?php echo $row_tree_10['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_10['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_10;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result29['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income9['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount9['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount9);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result19['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_10['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
<?php echo $row_tree_10['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_10['name'];?></td><td><?php echo  floor($total_amount9);?></td><td><?php echo floor($query_ref_amt_result19['token']);?></td>
<td>9</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_10['date']));?></td>
 
</td>
   
   	<?php
$select_tree_11 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_10['reference_id']."'");
while($row_tree_11 = mysqli_fetch_array($select_tree_11)){
$ur_refss10=$row_tree_11['id'];
		$ur_refss_id11 = $row_tree_11['reference_id'];
$query_ref_qry11 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id11."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry20 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss11."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result20 = mysqli_fetch_array($query_ref_qry20);

$query_ref_qry30 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss11."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result30 = mysqli_fetch_array($query_ref_qry30);

$reinvest10=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss11."'");
$reinvest_income10=mysqli_fetch_array($reinvest10);

$buy10=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss11."'");
$buy_amount10=mysqli_fetch_array($buy10);

$total_amount10=$query_ref_amt_result20['amount']+$query_ref_amt_result30['amount1'];

$total_income_amnt_11a = $query_ref_amt_result11['ref_total_amt'];
if($total_income_amnt_11a == '')
{
$total_income_amnt_11 = 0;
}
else
{
$total_income_amnt_11 = $total_income_amnt_11a;
}
?>

                 <tr class="treegrid-11 treegrid-parent-10">
                    <td>
<!--                        <a target="_parent" href="tree1?sr=<?php echo $row_tree_10['reference_id'];?>" data-container="body" data-toggle="popover" data-html="true" data-content="<div><b>Name:</b> <?php echo $row_tree_10['name']; ?><br><b>Email:</b> <?php echo $row_tree_10['email']; ?><br><b>Link Referece Id:</b> <?php echo $row_tree_10['link_reference_id'];?><br><b>Level Income:</b> $<?php echo $total_income_amnt_10;?><br><b>Locked Amount:</b> $<?php echo floor($query_ref_amt_result29['amount1']);?><br><b>Reinvestment Amount:</b> $<?php echo floor($reinvest_income9['token']);?><br><b>Income:</b> $<?php echo floor($buy_amount9['buy']);?><br><b>Total Purchase Amount:</b> <?php echo floor($total_amount9);?><br><b>Total Purchase Token Qunatity:</b> <?php echo floor($query_ref_amt_result19['token']); ?><br><b>Joining Date:</b> <?php echo date('F d Y h:i:s', strtotime($row_tree_10['date'])); ?></div>">-->
<!--<img src="app-assets/images/no-image.jpg" height="100px;"><br>-->
<?php echo $row_tree_10['reference_id']; ?>
<!--</a>-->
<td><?php echo $row_tree_11['name'];?></td><td><?php echo  floor($total_amount10);?></td><td><?php echo floor($query_ref_amt_result20['token']);?></td>
<td>10</td>
<td><?php echo date('F d Y h:i:s', strtotime($row_tree_11['date']));?></td>
 
</td>
   <?php }?>
   </tr>
   </td>
            

<?php } ?>
</tr>
</td>
<?php }?>
</tr>
</td>
<?php } ?>
</tr>
</td>
<?php }?>
</tr>
</td>
<?php } ?>
</tr>
</td>
<?php } ?>
</tr>
</td>
<?php } ?>
</tr>
</td>
<?php } ?>
</tr>
</td>
<? } ?>
</tr>
</td>

<? } ?>
</tr>
</table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- File export table -->
        
       
        
        
        <!--/ Language - Comma decimal place table --> 
      </div>
    </div>
  </div>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
 
  <script src="app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
  
  <script src="app-assets/js/core/app-menu.min.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.min.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.min.js" type="text/javascript"></script>
 
  <script src="app-assets/js/scripts/tables/datatables/datatable-advanced.js"  type="text/javascript"></script>
  
  <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/charts/echarts/echarts.js" type="text/javascript"></script>
  <!--<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>-->

  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/scripts/pages/dashboard-crypto.min.js" type="text/javascript"></script>
   <script src="../admin/app-assets/js/core/jquery.treegrid.bootstrap3.js" type="text/javascript"></script>
<script src="../admin/app-assets/js/core/jquery.treegrid.js" type="text/javascript"></script>


  <script>
$(document).ready(function(){
    $("#out").click(function(){
        alert("<b>You have sell 100 coins</b>")
    });
});
</script>
    <script type="text/javascript">

            $(document).ready(function() {
                $('.tree').treegrid();
                $('.tree-2').treegrid({
                    expanderExpandedClass: 'glyphicon glyphicon-minus',
                    expanderCollapsedClass: 'glyphicon glyphicon-plus'
                });

            });
        </script>   	


   

 </body>
 </html> 
 
           
