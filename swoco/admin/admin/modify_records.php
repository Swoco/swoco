<?php

error_reporting(0);

include('inc/dbase.php');

include('inc/checker.php');


date_default_timezone_set('Asia/Calcutta');


if(isset($_POST['edit_row_phase']))

{

	$pid = $_POST['row_id'];

	$punit_price = $_POST['p1unit_prc'];

	$pdate_duration = $_POST['p1date_duration'];



	$record_phase_update_qry = mysqli_query($con, "UPDATE `milkyway_icocoin` SET `unit_coin_prc`='".$punit_price."',`date_duration`='".$pdate_duration."' WHERE id = '".$pid."'");


	$chk_coin_ph_qry = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE id='".$pid."'");
    $chk_coin_ph_result = mysqli_fetch_array($chk_coin_ph_qry);

    if($chk_coin_ph_result['phase'] == 'No Phase')
    {
    	mysqli_query($con, "UPDATE `milkyway_solacecoin_list` SET token_price='$punit_price' ORDER BY id desc limit 1");
    } 

	echo "success";

}





if(isset($_POST['edit_row_userlist']))

{

	$up_id = $_POST['row_id'];

	$up_name = $_POST['u4_name'];

	$up_email = $_POST['u4_email'];

	$up_contact = $_POST['u4_contact'];

	$up_date = $_POST['u4_date'];



	$record_usp_update_qry = mysqli_query($con, "UPDATE `milkyway_usersignup` SET `name`='".$up_name."', `contact`='".$up_contact."', `date`='".$up_date."', `email`='".$up_email."' WHERE id = '".$pid."'");

	echo "success";

}



if(isset($_POST['edit_row_admin_coin']))

{

	$upp_id = $_POST['row_id'];

	$grand_totalcoin = $_POST['p4_grand_totalcoin'];

	$totalcoin = $_POST['p4_totalcoin'];



	$record_admincoin_update_qry = mysqli_query($con, "UPDATE `milkyway_adminassigncoin` SET `grand_totalcoin`='".$grand_totalcoin."', `totalcoin`='".$totalcoin."' WHERE id = '".$upp_id."'");

	echo "success";

}

if(isset($_POST['edit_pay_v']))

{

	$id = $_POST['row_id'];

	$pay_via_nm = $_POST['pay_n_v'];


	$gateway_record_update_qry = mysqli_query($con, "UPDATE `milkyway_pay_gateway_mod` SET `pay_via`='".$pay_via_nm."' WHERE id = '".$id."'");

	echo "success";

}


if(isset($_POST['edit_row_admin_ico_coin']))
{
	$admin_coin_id = $_POST['row_id'];
	$ico_sol_total_qty = $_POST['ico_sol_total_qty3'];
	$ico_perc = $_POST['ico_perc3'];
	$admin_co_fee = $_POST['admin_co_fee3'];

	if(($ico_perc != '' && $ico_perc > '0') && ($ico_sol_total_qty !='' && $ico_sol_total_qty > '0') && ($admin_co_fee !='' && $admin_co_fee > '0'))
    {
    $prev_admin_cn_rec_qry = mysqli_query($con, "SELECT * FROM `milkyway_adminassigncoin` WHERE id='".$admin_coin_id."'");
    $prev_admin_cn_rec_result = mysqli_fetch_array($prev_admin_cn_rec_qry);
    $pre_gt_coin_rs = $prev_admin_cn_rec_result['grand_totalcoin'];
    $pre_re_coin_rs = $prev_admin_cn_rec_result['totalcoin'];
    $rem_distributor_coin_rs =  $pre_gt_coin_rs - $pre_re_coin_rs;

    $rs_ico_coin_qty = ($ico_sol_total_qty * $ico_perc) / 100;
    $rs_remain_coin_qty = $rs_ico_coin_qty - $rem_distributor_coin_rs;
    $rs_remain_total_ico_coin = $ico_sol_total_qty - $rs_ico_coin_qty;


    if(($ico_sol_total_qty > $rs_ico_coin_qty) && ($rs_ico_coin_qty > $rem_distributor_coin_rs))
     {
    $mod_date = date('Y-m-d h:i:s');

	$record_admincoin_assign_coinupdate_qry = mysqli_query($con, "UPDATE `milkyway_adminassigncoin` SET `total_coin_qty`='".$ico_sol_total_qty."',`ico_percentage`='".$ico_perc."',`grand_totalcoin`='".$rs_ico_coin_qty."',`totalcoin`='".$rs_remain_coin_qty."',`rem_perc_coin`='".$rem_distributor_coin_rs."',`rem_total_coin_qty`='".$rs_remain_total_ico_coin."',`admin_fee`='".$admin_co_fee."',`mod_date`='".$mod_date."' WHERE id = '".$admin_coin_id."'");

	if(mysqli_affected_rows($con))
	{
		echo "success";
	}
	else
	{
		echo "fail";
	}

		}
		else
		{
           echo "fail1";
		}
     }
     else
		{
           echo "fail1";
		}
	


}

?>