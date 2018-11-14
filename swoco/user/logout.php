<?php
error_reporting(0);
include('..inc/dbase.php');
session_start();

  $fetch_logout_uid_user = $_SESSION['user_id'];
  $sess_expire_logout_uid_qry = mysqli_query($con, "UPDATE `milkyway_usersignup` SET `uni_session_id`='',`uni_time`='',`login_status`='0' WHERE `id`='".$fetch_logout_uid_user."'");
  if(mysqli_affected_rows($con))
  {

unset($_SESSION['user_id']);
unset($_SESSION['contact']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['ref_idsignup']);

session_destroy();

// header('location:index.php');


header('location:'.$root_path_main.'index.php');
}
else
{
	session_destroy();
	header('location:'.$root_path_main.'index.php');
}

?>