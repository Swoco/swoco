<?php
error_reporting(0);
include('inc/dbase.php');
session_start();

session_unset($_SESSION['last_lg_time']);
session_unset($_SESSION['adm_email']);
session_unset($_SESSION['auth']);
session_unset($_SESSION['idt']);
session_unset($_SESSION['u_name']);

// not set cookie
setcookie('admin_email', '', time()-60*60*7, '/admin', $root_path_main);
setcookie('admin_pass', '', time()-60*60*7, '/admin', $root_path_main);

session_destroy();

 header('location:log_in.php');

//header('location:'.$root_path_admin);

?>