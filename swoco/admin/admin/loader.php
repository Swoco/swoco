<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
date_default_timezone_set('Asia/Calcutta');
$ad_date = date('Y-m-d h:i:s');
$page_path = $_SERVER['REQUEST_URI'];

$prev_page_path = $_SERVER['HTTP_REFERER'];

if(isset($_GET['page_nm']) && $_GET['page_nm'] != '')
{
  if(isset($_GET['ic_status']) && $_GET['ic_status'] != '')
  {
  	$idr = $_GET['ic_status'];  

  	$ck_ico_prev_coin_qry = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE `status`='1'");
  	$ck_ico_prev_result = mysqli_fetch_array($ck_ico_prev_coin_qry);
  
  	if(mysqli_num_rows($ck_ico_prev_coin_qry) == 1)
  	{
  	$prev_status_id = $ck_ico_prev_result['id'];

  	/*$idr = 1;*/
  	$upadte_select_status = mysqli_query($con, "UPDATE `milkyway_icocoin` SET `status`= '1',`start`='$ad_date',`end`='' Where id = '".$idr."' and `status`='0'");

  	if(mysqli_affected_rows($con) == 1)
  	{
  		// No Issue
  		$upadte_prev_status = mysqli_query($con, "UPDATE `milkyway_icocoin` SET `status`= '0',`end`='$ad_date' Where id = '".$prev_status_id."' and `status`='1'");
  			if(mysqli_affected_rows($con) == 1)
			  	{
			  		// No Issue
			  		header('location:'.$prev_page_path);
			  	}
			  	else 
			  	{

			  			// record not update some went wrong contact to team 1
			  		   $log_file_qry = mysqli_query($con, "INSERT INTO `milkyway_logfle` (`page_name`,`msg`,`add_date`) VALUES ('".$page_path."','record not update some went wrong contact to team 1','$ad_date')");
			  		   header('location:'.$prev_page_path);
			  	}
  	}
  	else
  	{
  		// some went wrong contact to team 5
			  		   $log_file_qry = mysqli_query($con, "INSERT INTO `milkyway_logfle` (`page_name`,`msg`,`add_date`) VALUES ('".$page_path."','some went wrong contact to team 5','$ad_date')");
			  		   header('location:'.$prev_page_path);
  	}

  }
  else if(mysqli_num_rows($ck_ico_prev_coin_qry) > 1)
  			{
  				// issue
  				$upadte_all_status = mysqli_query($con, "UPDATE `milkyway_icocoin` SET `status`= '0'");

			  	if(mysqli_affected_rows($con))
			  	{
                   $upadte_one_status = mysqli_query($con, "UPDATE `milkyway_icocoin` SET `status`= '1',`start`='$ad_date' ORDER BY id DESC LIMIT 1");
                   if(mysqli_num_rows($upadte_one_status) == 1)
		  			{
		  				// No iisue
		  				header('location:'.$prev_page_path);
		  			}
		  			else
			  	{
			  		 // some went wrong contact to team 2
			  		 $log_file_qry = mysqli_query($con, "INSERT INTO `milkyway_logfle` (`page_name`,`msg`,`add_date`) VALUES ('".$page_path."','something went wrong contact to team 2','$ad_date')");
			  		 header('location:'.$prev_page_path);
			  	}
			  	}
			  	else
			  	{
			  		 // some went wrong contact to team 3
			  		 $log_file_qry = mysqli_query($con, "INSERT INTO `milkyway_logfle` (`page_name`,`msg`,`add_date`) VALUES ('".$page_path."','some went wrong contact to team 3','$ad_date')");
			  		 header('location:'.$prev_page_path);
			  	}
  			}
  }
  else
  {
  	header('location:index.php');
  }
}
else
{
	header('location:index.php');
}

?>