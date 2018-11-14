<?php
error_reporting(0);
include('../inc/dbase.php');
if(!isset($_SESSION))
{
session_start();
}

if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}

if(isset($_GET['pd_id']))
{
	$prchase_id = $_GET['pd_id'];

	mysqli_query($con, "DELETE FROM `milkway_userpay_list` WHERE `id`='".$prchase_id."'");

	header('location:'.$_SERVER['HTTP_REFERER']);
}
?>