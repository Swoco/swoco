<?php
error_reporting(0);
include('inc/dbase.php');

$prev_page_path = $_SERVER['HTTP_REFERER'];

if(isset($_GET['page_nm']) && ($_GET['page_nm'] == 'manage-complete'))
{
	$id = $_GET['id'];
	$comp_status = $_GET['compst'];
	if($comp_status == '0')
	{
      $comp_status2 = '1';
	}
	else
	{
     $comp_status2 = '0';
	}
	$upadte_prev_status = mysqli_query($con, "UPDATE `milkyway_icocoin` SET `complete`= '".$comp_status2."' Where id = '".$id."'");

	header('location:'.$prev_page_path);
}




?>