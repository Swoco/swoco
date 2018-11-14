<?php
error_reporting(0);
include('../inc/dbase.php');
date_default_timezone_set('Asia/Calcutta');
$phase= $_POST['token_v'];
$json=array();
$sql_mar=mysqli_query($con,"SELECT sum(l.qnty) as token ,l.phase_mode as mode,i.id as pmode,l.pay_datetime as date FROM `milkway_userpay_list` l ,milkyway_icocoin i where l.pay_datetime <=(NOW() - INTERVAL 1 MONTH) and l.phase_mode='".$phase."' and l.status='success' and l.remarks='Buy Token' and l.remarks='Pay By Admin' and l.user_id='".$_SESSION['user_id']."'  and i.status='1'");
$market=mysqli_fetch_assoc($sql_mar);
$json[]=$market;
 if(empty($market['mode']))
{
    echo '1';
}
else if($market['mode']<$market['pmode']){
   echo json_encode($json);
}
// $sql=mysqli_query($con,"select sum(qnty) as token,phase_mode from milkway_userpay_list where user_id='".$_SESSION['user_id']."' and phase_mode='".$phase."'");
// $sql_row=mysqli_num_rows($sql);
// $sql_c=mysqli_fetch_array($sql);
//  $sql_phase=mysqli_query($con,"select * from milkyway_icocoin where status='1'");
// $sql_phase_name=mysqli_fetch_array($sql_phase);
// $token=$sql_c['token'];
// $phase=$sql_c['phase_mode'];
// if($sql_phase_name['id']==$sql_c['phase_mode']  )
// {
// echo '0';
// }
//  if($sql_phase_name['id']>$sql_c['phase_mode'])n
// {
  // echo $token; 
// }

?>