<?php
include('dbase.php');
if(!isset($_SESSION))
{
       session_start();
}

if(isset($_COOKIE['admin_email']) && isset($_COOKIE['admin_pass']))
{
 
$email_ck = $_COOKIE['admin_email'];
$pass_ck = $_COOKIE['admin_pass'];
 $query_ck=mysqli_query($con, "select * from `milkyway_adminlogin` where `pswd`='".$pass_ck."' and `email`='".$email_ck."' and `status`='1'");
    $countRow_ck=mysqli_num_rows($query_ck);
     $fetch_ck=mysqli_fetch_array($query_ck);
    if($countRow_ck>0)
    {
        setcookie('admin_email', $email_ck, time()+60*60*7, '/admin', $root_path_main);
        setcookie('admin_pass', $pass_ck, time()+60*60*7, '/admin', $root_path_main);

        $_SESSION['adm_email']= $fetch_ck['email'];
        $_SESSION['auth']= $fetch_ck['type'];
        $_SESSION['idt'] = $fetch_ck['id'];
        $_SESSION['u_name'] = $fetch_ck['name'];
    }
    else
    {
     header('location:logout.php');    
    }
    
}
?>