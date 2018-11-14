<?php
error_reporting(0);
include('inc/dbase.php');

session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  

 date_default_timezone_set('Asia/Calcutta');
 $update_st_date = date('Y-m-d h:i:s');   

if(isset($_GET['action']) && $_GET['action'] == 'withdrwal')
{
 	$trnss_id = $_GET['trnss'];
	$get_all_record_qry = mysqli_query($con, "SELECT * FROM `withdraw` WHERE `trns_id`='".$trnss_id."'");
	$get_all_record_result = mysqli_fetch_array($get_all_record_qry);
//	$ins_query = mysqli_query($con, "INSERT INTO `milkyway_transaction_withdrawal_list` (`trns_id`,`add_admin_coin`,`user_id`,`user_withdrawal_coin`,`add_date`) VALUES ('".$trnss_id."','".$withdrwa_cn."','".$user_idid."','".$withdrwa_cn."','".$update_st_date."')");
	if($get_all_record_qry>0)
	{
	   // echo "UPDATE `withdraw` SET `status`='success' where `trns_id`='".$trnss_id."'";
		$withdrwal_record_up_qry = mysqli_query($con, "UPDATE `withdraw` SET `status`='success' where `trns_id`='".$trnss_id."'");

			header('location:'.$_SERVER['HTTP_REFERER']);
	
	}
	else
	{
		header('location:'.$_SERVER['HTTP_REFERER']);
	}
	
}
?>