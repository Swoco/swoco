<?php
// create connection
$host_name = 'localhost';
$user_name = 'swoco_coin';
$pass = 'swoco_coin@123';
$dbname = 'swoco_coin';
$config = array(
	'host'=>$host_name,
	'user'=>$user_name,
	'pass'=>$pass,
	'dbname'=>$dbname
);
$con = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['dbname']);
if(mysqli_connect_errno())
{
	die('Connection failed :' . mysqli_connect_error());
}
// user panel title
define('SITE_MAIN', 'Swoco');
// user panel title
define('SITE_USER', 'User Panel');
// admin panel title
define('SITE_ADMIN', 'Admin Panel');
$root_path_main = 'http://swoco.io/swoco/user/';
$root_path_admin = 'http://swoco.io/swoco/admin/';
$root_path_user = 'http://swoco.io/swoco/user/';
// set session 
session_start();
// set date by default
date_default_timezone_set('Asia/Calcutta');
$conf_comp_name = 'Swoco';
?>