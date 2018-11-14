<?php
error_reporting(0);
include('../inc/dbase.php');

if(!isset($_SESSION))
{
	session_start();
}
date_default_timezone_set('Asia/Calcutta');
if($_SESSION['user_id'] == '')
{
    header('location:login.php');
}
$get_contact_number_id = $_SESSION['user_id'];
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
$total_coin_qry24 = mysqli_query($con, "SELECT * FROM `milkyway_adminassigncoin` WHERE `status`='1'");
$total_coin_result24 = mysqli_fetch_array($total_coin_qry24);
$rem_coin = $total_coin_result24['totalcoin'];

if(isset($_POST['submit']))
{
 if($_SESSION['email'] == '')
  {
       header('location:login.php');
  }
  else
	{
  $user = $_SESSION['ref_idsignup'];
  $urs_id = $_SESSION['user_id'];
$user_detail_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='".$urs_id."'");
$user_detail_result = mysqli_fetch_array($user_detail_qry);
$buy_ref_key =$user_detail_result['link_reference_id'];
  $gt_se_id = session_id();
  $gt_user_id = $_SESSION['user_id'];
  $login_ck = 'user';
  $gt_user_email = $_SESSION['email'];
  $inv_order_id ='201807134143';
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
$sql_t=mysqli_query($con,"select * from `milkway_userpay_list` where user_id='".$gt_user_id."'");
if($gt_qty <= $rem_coin)
  {
//  	 if(mysqli_num_rows($sql_t)>0)
// 	 {
//   if($_POST['buy_ttl_prc']>=20)
//   {
// 	$insert_pay_record_qry = mysqli_query($con, "INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`user_id`,`user_rf_id`,`mode`,`user_email`,`verify_number`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`inv_type_amt`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,remarks,`pay_via_panel`,`pay_datetime`) 
//      	VALUES ('".$gt_se_id."','','".$gt_user_id."','".$user."','".$login_ck."','".$gt_user_email."','','".$inv_order_id."','".$gt_qty."','".$gt_prc."','".$gt_total_prc."', '', '','".$phase_i."','".$gt_inv_type."','".$gt_inv_type_amt."','unpaid','','".$gt_temp_date."','".$gt_add_date."','pending','Buy Token','','$gt_add_date')");
//   $sponce = $buy_ref_key;
// $plan_amount = $gt_total_prc;
// $income1 = $plan_amount*7/100;
// $income1_percent_amt = $income1;

// $income2 = $plan_amount*4/100;
// $income2_percent_amt = $income2;

// $income3 = $plan_amount*2/100;
// $income3_percent_amt = $income3;

// $income4 = $plan_amount*1/100;
// $income4_percent_amt = $income4;

// $income5 = $plan_amount*1/100;
// $income5_percent_amt = $income5;

// $income6 = $plan_amount*(1/100);
// $income6_percent_amt = $income6;

// $income7 = $plan_amount*(1/100);
// $income7_percent_amt = $income7;

// $income8 = $plan_amount*(1/100);
// $income8_percent_amt = $income8;

// $income9 = $plan_amount*(1/100);
// $income9_percent_amt = $income9;

// $income10 = $plan_amount*(1/100);
// $income10_percent_amt = $income10;
// $rdddg_id='';
// $select_upline = mysqli_query($con, "select * from milkyway_usersignup where reference_id='$sponce'");
// $row_upline = mysqli_fetch_array($select_upline);

// $insert_1 = mysqli_query($con, "insert into milkyway_level__income set 	inc_transfer_status='".$inv_order_id."',user_id='".$row_upline['reference_id']."',percent_amt='7',ref_id='$user',income_level='1',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income1_percent_amt',`add_date`='$ref_date'");

// //query 9 / /
// $select_upline_2 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline['reference_id']."'");
// $upline_count_2 = mysqli_num_rows($select_upline_2);
// $row_upline_2 = mysqli_fetch_array($select_upline_2);

// if($upline_count_2>0){
// $insert_2 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_2['link_reference_id']."',percent_amt='4',ref_id='$user',income_level='2',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income2_percent_amt',`add_date`='$ref_date'");
// }
// //query 8 / /
// $select_upline_3 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_2['link_reference_id']."'");
// $upline_count_3 = mysqli_num_rows($select_upline_3);
// $row_upline_3 = mysqli_fetch_array($select_upline_3);

// if($upline_count_3>0){
// $insert_3 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_3['link_reference_id']."',percent_amt='2',ref_id='$user',income_level='3',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income3_percent_amt',`add_date`='$ref_date'");
// }
// //query 7 / /
// $select_upline_4 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_3['link_reference_id']."'");
// $upline_count_4 = mysqli_num_rows($select_upline_4);
// $row_upline_4 = mysqli_fetch_array($select_upline_4);

// if($upline_count_4>0){
// $insert_4 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_4['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='4',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income4_percent_amt',`add_date`='$ref_date'");
// }
// //query 7 / /
// $select_upline_5 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_4['link_reference_id']."'");
// $upline_count_5 = mysqli_num_rows($select_upline_5);
// $row_upline_5 = mysqli_fetch_array($select_upline_5);

// if($upline_count_5>0){
// $insert_5 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_5['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='5',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income5_percent_amt',`add_date`='$ref_date'");
// }
// //query 6 / /
// $select_upline_6 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_5['link_reference_id']."'");
// $upline_count_6 = mysqli_num_rows($select_upline_6);
// $row_upline_6 = mysqli_fetch_array($select_upline_6);

// if($upline_count_6>0){
// $insert_6 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_6['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='6',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income6_percent_amt',`add_date`='$ref_date'");
// }
// //query 5 / /
// $select_upline_7 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_6['link_reference_id']."'");
// $upline_count_7 = mysqli_num_rows($select_upline_7);
// $row_upline_7 = mysqli_fetch_array($select_upline_7);

// if($upline_count_7>0){
// $insert_7 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_7['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='7',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income7_percent_amt',`add_date`='$ref_date'");
// }
// //query 4 / /
// $select_upline_8 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_7['link_reference_id']."'");
// $upline_count_8 = mysqli_num_rows($select_upline_8);
// $row_upline_8 = mysqli_fetch_array($select_upline_8);

// if($upline_count_8>0){
// $insert_8 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_8['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='8',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income8_percent_amt',`add_date`='$ref_date'");
// }
// //query 3 / /
// $select_upline_9 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_8['link_reference_id']."'");
// $upline_count_9 = mysqli_num_rows($select_upline_9);
// $row_upline_9 = mysqli_fetch_array($select_upline_9);

// if($upline_count_9>0){
// $insert_9 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_9['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='9',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income9_percent_amt',`add_date`='$ref_date'");
// }
// //query 3 / /
// $select_upline_10 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_9['link_reference_id']."'");
// $upline_count_10 = mysqli_num_rows($select_upline_10);
// $row_upline_10 = mysqli_fetch_array($select_upline_10);

// if($upline_count_10>0){
// $insert_10 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',user_id='".$row_upline_10['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='10',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income10_percent_amt',`add_date`='$ref_date'");
// }
// 	 	if($insert_pay_record_qry)
// 	 	{
// 	 		$_SESSION['sess_od_id'] = $inv_order_id;
	 	//	$msg = '<div class="alert alert-success" role="alert">Token Buy Success without reference id!wait for payment gateway. !!!</div>';
	 		// header('location:psuccess.php');
// 	 	}
// 	 	else
// 	 	{
// 	 		header('location:Buy-token.php?r=1');
// 	 	}
//     }
// else
// {
//   $msg = '<div class="alert alert-danger" role="alert">Purchase Amount Should be equal to or Greater than $20 !</div>';
// }
// }
// else
// {
//     if($_POST['buy_ttl_prc']>=$limit_purchaseamount['token_price'])
//   {

//   $sponce = $buy_ref_key;
// $plan_amount = $gt_total_prc;
// $income1 = $plan_amount*7/100;
// $income1_percent_amt = $income1;

// //echo $income_percent_amt;

// $income2 = $plan_amount*4/100;
// $income2_percent_amt = $income2;



// $income3 = $plan_amount*2/100;
// $income3_percent_amt = $income3;

// $income4 = $plan_amount*1/100;
// $income4_percent_amt = $income4;

// $income5 = $plan_amount*1/100;
// $income5_percent_amt = $income5;

// $income6 = $plan_amount*(1/100);
// $income6_percent_amt = $income6;

// $income7 = $plan_amount*(1/100);
// $income7_percent_amt = $income7;

// $income8 = $plan_amount*(1/100);
// $income8_percent_amt = $income8;

// $income9 = $plan_amount*(1/100);
// $income9_percent_amt = $income9;

// $income10 = $plan_amount*(1/100);
// $income10_percent_amt = $income10;
// $rdddg_id='';
// $select_upline = mysqli_query($con, "select * from milkyway_usersignup where reference_id='$sponce'");
// $row_upline = mysqli_fetch_array($select_upline);

// $insert_1 = mysqli_query($con, "insert into milkyway_level__income set 	inc_transfer_status='".$inv_order_id."',up_date='".$row_upline['region']."',user_id='".$row_upline['reference_id']."',percent_amt='7',ref_id='$user',income_level='1',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income1_percent_amt',`add_date`='$ref_date'");

// //query 9 / /
// $select_upline_2 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline['link_reference_id']."'");
// $upline_count_2 = mysqli_num_rows($select_upline_2);
// $row_upline_2 = mysqli_fetch_array($select_upline_2);

// if($upline_count_2>0){
// $insert_2 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_2['region']."',user_id='".$row_upline_2['link_reference_id']."',percent_amt='4',ref_id='$user',income_level='2',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income2_percent_amt',`add_date`='$ref_date'");
// }
// //query 8 / /
// $select_upline_3 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_2['link_reference_id']."'");
// $upline_count_3 = mysqli_num_rows($select_upline_3);
// $row_upline_3 = mysqli_fetch_array($select_upline_3);

// if($upline_count_3>0){
// $insert_3 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_3['region']."',user_id='".$row_upline_3['link_reference_id']."',percent_amt='2',ref_id='$user',income_level='3',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income3_percent_amt',`add_date`='$ref_date'");
// }
// //query 7 / /
// $select_upline_4 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_3['link_reference_id']."'");
// $upline_count_4 = mysqli_num_rows($select_upline_4);
// $row_upline_4 = mysqli_fetch_array($select_upline_4);

// if($upline_count_4>0){
// $insert_4 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_4['region']."',user_id='".$row_upline_4['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='4',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income4_percent_amt',`add_date`='$ref_date'");
// }
// //query 7 / /
// $select_upline_5 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_4['link_reference_id']."'");
// $upline_count_5 = mysqli_num_rows($select_upline_5);
// $row_upline_5 = mysqli_fetch_array($select_upline_5);

// if($upline_count_5>0){
// $insert_5 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_5['region']."',user_id='".$row_upline_5['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='5',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income5_percent_amt',`add_date`='$ref_date'");
// }
// //query 6 / /
// $select_upline_6 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_5['link_reference_id']."'");
// $upline_count_6 = mysqli_num_rows($select_upline_6);
// $row_upline_6 = mysqli_fetch_array($select_upline_6);

// if($upline_count_6>0){
// $insert_6 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_6['region']."',user_id='".$row_upline_6['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='6',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income6_percent_amt',`add_date`='$ref_date'");
// }
// //query 5 / /
// $select_upline_7 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_6['link_reference_id']."'");
// $upline_count_7 = mysqli_num_rows($select_upline_7);
// $row_upline_7 = mysqli_fetch_array($select_upline_7);

// if($upline_count_7>0){
// $insert_7 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_7['region']."',user_id='".$row_upline_7['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='7',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income7_percent_amt',`add_date`='$ref_date'");
// }
// //query 4 / /
// $select_upline_8 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_7['link_reference_id']."'");
// $upline_count_8 = mysqli_num_rows($select_upline_8);
// $row_upline_8 = mysqli_fetch_array($select_upline_8);

// if($upline_count_8>0){
// $insert_8 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_8['region']."',user_id='".$row_upline_8['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='8',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income8_percent_amt',`add_date`='$ref_date'");
// }
// //query 3 / /
// $select_upline_9 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_8['link_reference_id']."'");
// $upline_count_9 = mysqli_num_rows($select_upline_9);
// $row_upline_9 = mysqli_fetch_array($select_upline_9);

// if($upline_count_9>0){
// $insert_9 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_9['region']."',user_id='".$row_upline_9['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='9',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income9_percent_amt',`add_date`='$ref_date'");
// }
// //query 3 / /
// $select_upline_10 = mysqli_query($con, "select * from milkyway_usersignup where reference_id='".$row_upline_9['link_reference_id']."'");
// $upline_count_10 = mysqli_num_rows($select_upline_10);
// $row_upline_10 = mysqli_fetch_array($select_upline_10);

// if($upline_count_10>0){
// $insert_10 = mysqli_query($con, "insert into milkyway_level__income set inc_transfer_status='".$inv_order_id."',up_date='".$row_upline_10['region']."',user_id='".$row_upline_10['link_reference_id']."',percent_amt='1',ref_id='$user',income_level='10',rd_id='$rdddg_id',ref_amt='$plan_amount',`ref_status`='YES',`pay_status`='pending',`percent_amt_qty`='$income10_percent_amt',`add_date`='$ref_date'");
// }
// 	$insert_pay_record_qry = mysqli_query($con, "INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`user_id`,`user_rf_id`,`mode`,`user_email`,`verify_number`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`inv_type_amt`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,remarks,`pay_via_panel`,`pay_datetime`) 
//      	VALUES ('".$gt_se_id."','','".$gt_user_id."','".$user."','".$login_ck."','".$gt_user_email."','','".$inv_order_id."','".$gt_qty."','".$gt_prc."','".$gt_total_prc."', '', '','".$phase_i."','".$gt_inv_type."','".$gt_inv_type_amt."','unpaid','','".$gt_temp_date."','".$gt_add_date."','pending','Buy Token','','$gt_add_date')");

//	$msg = '<div class="alert alert-success" role="alert">Token Buy Success with reference id!wait for payment gateway. !!!</div>';
$_SESSION['sess_od_id'] = $inv_order_id;

header('location:psuccess.php');    
        
//     }
// else
// {
//   $msg = '<div class="alert alert-danger" role="alert">Purchase Amount Should be equal to or Greater than '.$limit_purchaseamount['token_price'].'</div>';   
// }
 }
// }
// else
// {
//  $msg ="Sorry Swoco Qunatity Not Available Please Try Again !";   
// }
}
}
?>
<?php include('../inc/header.php');?>
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
										<p class="text-center">SWOCO </p>
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
																	<input type="text" class="form-control" name="buy_ttl_prc" id="buy_total_prc" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" > 

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
  	function numericFilter(txb)
      {
        txb.value = txb.value.replace(/[^\0-9]/ig,'');
      }
  </script>