<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
 if(isset($_GET['page_nm']) && ($_GET['page_nm'] == 'pay_btc'))
{
	$id = $_GET['id'];
	$upadte_prev_status = mysqli_query($con, "UPDATE `upload_purchase_swoco` SET `status`= 'Done' Where id = '".$id."'");

	header('location:buy_list.php');
}
?>