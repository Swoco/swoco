<?php include('../inc/header.php'); ?>
<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}
?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Level Tree </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item active"> Level Tree
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="buy_History-plus">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Level</h4>
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
                
	     <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
              <style type="text/css">
        #scrolly{
            width: 100%;
            height: 350px;
			overflow:auto;
            overflow-y: scroll;
            margin: 0 auto;
            white-space: nowrap;
        }
		/*Now the CSS*/
* {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	/*border: 1px solid #ccc;*/
	/*padding:10px;*/
	text-decoration: none;
	color: #333;
	font-size: 12px;
	display: inline-block;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
	font-family: "Source Sans Pro", sans-serif;
}
.tree li a img{
   width: 80px;
    height: 80px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    border: 1px solid #afa4a4;
    padding: 5px;
    box-shadow: 10px 10px 10px #0000001c;
}

.tree li  img{
   width: 80px;
    height: 80px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    border: 1px solid #afa4a4;
    padding: 5px;
    box-shadow: 10px 10px 10px #0000001c;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	/*background: #efefef; 
	color: #000; 
	border: 1px solid #94a0b4;*/
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}

/*Thats all. I hope you enjoyed it.
Thanks :)*/
div{
	font-size:12px;
	font-family: "Source Sans Pro", sans-serif;
}

.tree_center{
    margin-left: -167px;
    position: relative;
    left: 50%;
}
	
    </style>


	<div class="tree" >
	    
    <ul>

    	  <?php
$query_coin_prc = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` where status='1' order by id");
$today_cn_price = mysqli_fetch_array($query_coin_prc);
$today_cn_price123 = $today_cn_price['unit_coin_prc'];

$select_tree = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$_SESSION['ref_idsignup']."'");
while($row_tree = mysqli_fetch_array($select_tree)){
$ur_refss=$row_tree['id'];
$ur_refss_id = $row_tree['reference_id'];
$query_ref_qry = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id."' AND pay_status='pending' ORDER BY id ASC");
$query_ref_amt_result = mysqli_fetch_array($query_ref_qry);

$query_ref_qry1 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss."' AND status='pending' ORDER BY id ASC");
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

<li class="tree_center">
<img src="app-assets/images/no-image.jpg" height="100px;"><br>
<span>Ref id: <?php echo $row_tree['reference_id']; ?></span>


<!-- loop 2 -->
<ul>
<?php
$select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree['reference_id']."'");
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='pending' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='pending' ORDER BY id ASC");
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
<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_2['reference_id']; ?>
</a>

<!-- loop 3 -->
<ul>
	<?php
$select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
		$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='pending' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_3['reference_id']; ?>
</a>
<ul>
	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='Pending' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_4['reference_id']; ?>
</a>
<ul>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='Pending' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_5['reference_id']; ?>
</a>
<ul>
	<?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='Pending' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_6['reference_id']; ?>
</a>

<ul>
	<?php
$select_tree_7 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_6['reference_id']."'");
while($row_tree_7 = mysqli_fetch_array($select_tree_7)){
$ur_refss7=$row_tree_7['id'];
		$ur_refss_id7 = $row_tree_7['reference_id'];
$query_ref_qry7 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id7."' AND pay_status='Pending' ORDER BY id ASC");
$query_ref_amt_result7 = mysqli_fetch_array($query_ref_qry7);

$query_ref_qry16 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss7."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_7['reference_id']; ?>
</a>
<ul>
	<?php
$select_tree_8 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_7['reference_id']."'");
while($row_tree_8 = mysqli_fetch_array($select_tree_8)){
$ur_refss8=$row_tree_8['id'];
		$ur_refss_id8 = $row_tree_8['reference_id'];
$query_ref_qry8 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id8."' AND pay_status='Pending' ORDER BY id ASC");
$query_ref_amt_result8 = mysqli_fetch_array($query_ref_qry8);

$query_ref_qry17 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss8."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_8['reference_id']; ?>
</a>

<ul>
	<?php
$select_tree_9 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_8['reference_id']."'");
while($row_tree_9 = mysqli_fetch_array($select_tree_9)){
$ur_refss9=$row_tree_9['id'];
		$ur_refss_id9 = $row_tree_9['reference_id'];
$query_ref_qry9 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id9."' AND pay_status='Pending' ORDER BY id ASC");
$query_ref_amt_result9 = mysqli_fetch_array($query_ref_qry9);

$query_ref_qry18 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss9."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_9['reference_id']; ?>
</a>
<ul>
	<?php
$select_tree_10 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_9['reference_id']."'");
while($row_tree_10 = mysqli_fetch_array($select_tree_10)){
$ur_refss10=$row_tree_10['id'];
		$ur_refss_id10 = $row_tree_10['reference_id'];
$query_ref_qry10 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id10."' AND pay_status='Pending' ORDER BY id ASC");
$query_ref_amt_result10 = mysqli_fetch_array($query_ref_qry10);

$query_ref_qry19 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss10."' AND status='pending' ORDER BY id ASC");
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

	<li>
<a target="_parent" href=""><img src="app-assets/images/no-image.jpg" height="100px;"><br>
Ref id: <?php echo $row_tree_10['reference_id']; ?>
</a>
</li>
<?php } ?>
</ul>
</li>
<?php }?>
</ul>
</li>
<?php } ?>
</ul>
</li>
<?php }?>
</ul>
</li>
<?php } ?>
</ul>
</li>
<?php } ?>
</ul>
</li>
<?php } ?>
</ul>
</li>
<?php } ?>
</ul>
</li>
<? } ?>
</ul>
</li>

<? } ?>
</ul>
</div>

	

                  
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
 <?php include('../inc/footer.php');?>