<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
    ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Level Tree History</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">Level Tree History
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="file-export">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"></h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                        <h1>Level 1</h1>
                    <table class="table table-striped table-bordered file-export" style="font-family:Times New Roman;">
                       <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                <th>SNO</th>
                                 <th>User Name</th>
                                <th>User Id</th>
                                <th>Total Purchase Amount</th>
                                <th>Total Purchase Qunatity</th>
                              <th>Joining Date</th>
                            </tr>
                            
                        </thead>
             <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                          
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
           
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_2['name']; ?></td>
                                <td><?php echo $row_tree_2['reference_id']; ?></td>
                                <td><?php echo  floor($total_amount1);?></td>
                                <td><?php echo floor($query_ref_amt_result11['token']);?></td>
                                <td><?php echo date('F d Y h:i:s', strtotime($row_tree_2['date']));?></td>
                               </tr>
                               
                                  <?php
                                  
     $cnt++;
}
  
                            
                                  ?>
                                
                          

                       
                         </table>
                   <br>
                   <h1>Level 2</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                      <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                            <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                           
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_3['name']; ?></td>
                                <td><?php echo $row_tree_3['reference_id']; ?></td>
                                <td><?php echo $row_tree_2['reference_id']; ?></td>
                                <td><?php echo $row_tree_2['name']?></td>
                                <td><?php echo  floor($total_amount11);?></td>
                                <td><?php echo floor($query_ref_amt_result12['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_3['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
 }
 
 ?>
                                
                          

                       
                         </table>
                             <br>                
                   <h1>Level 3</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                     <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                           
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
                                
                                
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_4['name']; ?></td>
                                <td><?php echo $row_tree_4['reference_id']; ?></td>
                                <td><?php echo $row_tree_3['reference_id']; ?></td>
                                <td><?php echo $row_tree_3['name']?></td>
                                <td><?php echo  floor($total_amount3);?></td>
                                <td><?php echo floor($query_ref_amt_result13['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_4['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}

?>
                        </table>
                         
                          <br>                
                   <h1>Level 4</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                      <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                         
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
                                
                                
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_5['name']; ?></td>
                                <td><?php echo $row_tree_5['reference_id']; ?></td>
                                <td><?php echo $row_tree_4['reference_id']; ?></td>
                                <td><?php echo $row_tree_4['name']?></td>
                                <td><?php echo  floor($total_amount4);?></td>
                                <td><?php echo floor($query_ref_amt_result14['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_5['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}
}

?>
                        </table>
   
     <br>                
                   <h1>Level 5</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                       <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                          
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
	 <?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result15 = mysqli_fetch_array($query_ref_qry15);

$query_ref_qry25 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss6."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result25 = mysqli_fetch_array($query_ref_qry25);

$reinvest5=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss6."'");
$reinvest_income5=mysqli_fetch_array($reinvest5);

$buy5=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss6."'");
$buy_amount5=mysqli_fetch_array($buy5);

$total_amount5=$query_ref_amt_result15['amount']+$query_ref_amt_result25['amount1'];

$total_income_amnt_6a = $query_ref_amt_result6['ref_total_amt'];
if($total_income_amnt_6a == '')
{
$total_income_amnt_6 = 0;
}
else
{
$total_income_amnt_6 = $total_income_amnt_6a;
}

	?>
                                
                                
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_6['name']; ?></td>
                                <td><?php echo $row_tree_6['reference_id']; ?></td>
                                <td><?php echo $row_tree_5['reference_id']; ?></td>
                                <td><?php echo $row_tree_5['name']?></td>
                                <td><?php echo  floor($total_amount5);?></td>
                                <td><?php echo floor($query_ref_amt_result15['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_6['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}
}
}

?>
                        </table>
   
    <br>                
                   <h1>Level 6</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                       <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                        
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
	 <?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result15 = mysqli_fetch_array($query_ref_qry15);

$query_ref_qry25 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss6."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result25 = mysqli_fetch_array($query_ref_qry25);

$reinvest5=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss6."'");
$reinvest_income5=mysqli_fetch_array($reinvest5);

$buy5=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss6."'");
$buy_amount5=mysqli_fetch_array($buy5);

$total_amount5=$query_ref_amt_result15['amount']+$query_ref_amt_result25['amount1'];

$total_income_amnt_6a = $query_ref_amt_result6['ref_total_amt'];
if($total_income_amnt_6a == '')
{
$total_income_amnt_6 = 0;
}
else
{
$total_income_amnt_6 = $total_income_amnt_6a;
}

	?>
	<?php
$select_tree_7 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_6['reference_id']."'");
while($row_tree_7 = mysqli_fetch_array($select_tree_7)){
$ur_refss7=$row_tree_7['id'];
		$ur_refss_id7 = $row_tree_7['reference_id'];
$query_ref_qry7 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id7."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result7 = mysqli_fetch_array($query_ref_qry7);

$query_ref_qry16 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss7."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result16 = mysqli_fetch_array($query_ref_qry16);

$query_ref_qry26 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss7."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result26 = mysqli_fetch_array($query_ref_qry26);

$reinvest6=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss7."'");
$reinvest_income6=mysqli_fetch_array($reinvest6);

$buy6=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss7."'");
$buy_amount6=mysqli_fetch_array($buy6);

$total_amount6=$query_ref_amt_result16['amount']+$query_ref_amt_result26['amount1'];

$total_income_amnt_7a = $query_ref_amt_result7['ref_total_amt'];
if($total_income_amnt_7a == '')
{
$total_income_amnt_7 = 0;
}
else
{
$total_income_amnt_7 = $total_income_amnt_7a;
}

	?>
                                
                                
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_7['name']; ?></td>
                                <td><?php echo $row_tree_7['reference_id']; ?></td>
                                <td><?php echo $row_tree_6['reference_id']; ?></td>
                                <td><?php echo $row_tree_6['name']?></td>
                                <td><?php echo  floor($total_amount6);?></td>
                                <td><?php echo floor($query_ref_amt_result16['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_7['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}
}
}
}

?>
                        </table>
   
       <br>                
                   <h1>Level 7</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                       <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                          
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
	 <?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result15 = mysqli_fetch_array($query_ref_qry15);

$query_ref_qry25 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss6."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result25 = mysqli_fetch_array($query_ref_qry25);

$reinvest5=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss6."'");
$reinvest_income5=mysqli_fetch_array($reinvest5);

$buy5=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss6."'");
$buy_amount5=mysqli_fetch_array($buy5);

$total_amount5=$query_ref_amt_result15['amount']+$query_ref_amt_result25['amount1'];

$total_income_amnt_6a = $query_ref_amt_result6['ref_total_amt'];
if($total_income_amnt_6a == '')
{
$total_income_amnt_6 = 0;
}
else
{
$total_income_amnt_6 = $total_income_amnt_6a;
}

	?>
	<?php
$select_tree_7 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_6['reference_id']."'");
while($row_tree_7 = mysqli_fetch_array($select_tree_7)){
$ur_refss7=$row_tree_7['id'];
		$ur_refss_id7 = $row_tree_7['reference_id'];
$query_ref_qry7 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id7."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result7 = mysqli_fetch_array($query_ref_qry7);

$query_ref_qry16 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss7."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result16 = mysqli_fetch_array($query_ref_qry16);

$query_ref_qry26 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss7."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result26 = mysqli_fetch_array($query_ref_qry26);

$reinvest6=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss7."'");
$reinvest_income6=mysqli_fetch_array($reinvest6);

$buy6=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss7."'");
$buy_amount6=mysqli_fetch_array($buy6);

$total_amount6=$query_ref_amt_result16['amount']+$query_ref_amt_result26['amount1'];

$total_income_amnt_7a = $query_ref_amt_result7['ref_total_amt'];
if($total_income_amnt_7a == '')
{
$total_income_amnt_7 = 0;
}
else
{
$total_income_amnt_7 = $total_income_amnt_7a;
}

	?>
          <?php
$select_tree_8 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_7['reference_id']."'");
while($row_tree_8 = mysqli_fetch_array($select_tree_8)){
$ur_refss8=$row_tree_8['id'];
		$ur_refss_id8 = $row_tree_8['reference_id'];
$query_ref_qry8 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id8."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result8 = mysqli_fetch_array($query_ref_qry8);

$query_ref_qry17 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss8."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result17 = mysqli_fetch_array($query_ref_qry17);

$query_ref_qry27 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss8."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result27 = mysqli_fetch_array($query_ref_qry27);

$reinvest7=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss8."'");
$reinvest_income7=mysqli_fetch_array($reinvest7);

$buy7=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss8."'");
$buy_amount7=mysqli_fetch_array($buy7);

$total_amount7=$query_ref_amt_result17['amount']+$query_ref_amt_result27['amount1'];

$total_income_amnt_8a = $query_ref_amt_result8['ref_total_amt'];
if($total_income_amnt_8a == '')
{
$total_income_amnt_8 = 0;
}
else
{
$total_income_amnt_8 = $total_income_amnt_8a;
}

	?>                      
                                
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_8['name']; ?></td>
                                <td><?php echo $row_tree_8['reference_id']; ?></td>
                                <td><?php echo $row_tree_7['reference_id']; ?></td>
                                <td><?php echo $row_tree_7['name']?></td>
                                <td><?php echo  floor($total_amount7);?></td>
                                <td><?php echo floor($query_ref_amt_result17['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_8['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}
}
}
}
}

?>
                        </table>
                         <br>                
                   <h1>Level 8</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                       <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                          
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
	 <?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result15 = mysqli_fetch_array($query_ref_qry15);

$query_ref_qry25 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss6."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result25 = mysqli_fetch_array($query_ref_qry25);

$reinvest5=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss6."'");
$reinvest_income5=mysqli_fetch_array($reinvest5);

$buy5=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss6."'");
$buy_amount5=mysqli_fetch_array($buy5);

$total_amount5=$query_ref_amt_result15['amount']+$query_ref_amt_result25['amount1'];

$total_income_amnt_6a = $query_ref_amt_result6['ref_total_amt'];
if($total_income_amnt_6a == '')
{
$total_income_amnt_6 = 0;
}
else
{
$total_income_amnt_6 = $total_income_amnt_6a;
}

	?>
	<?php
$select_tree_7 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_6['reference_id']."'");
while($row_tree_7 = mysqli_fetch_array($select_tree_7)){
$ur_refss7=$row_tree_7['id'];
		$ur_refss_id7 = $row_tree_7['reference_id'];
$query_ref_qry7 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id7."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result7 = mysqli_fetch_array($query_ref_qry7);

$query_ref_qry16 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss7."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result16 = mysqli_fetch_array($query_ref_qry16);

$query_ref_qry26 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss7."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result26 = mysqli_fetch_array($query_ref_qry26);

$reinvest6=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss7."'");
$reinvest_income6=mysqli_fetch_array($reinvest6);

$buy6=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss7."'");
$buy_amount6=mysqli_fetch_array($buy6);

$total_amount6=$query_ref_amt_result16['amount']+$query_ref_amt_result26['amount1'];

$total_income_amnt_7a = $query_ref_amt_result7['ref_total_amt'];
if($total_income_amnt_7a == '')
{
$total_income_amnt_7 = 0;
}
else
{
$total_income_amnt_7 = $total_income_amnt_7a;
}

	?>
          <?php
$select_tree_8 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_7['reference_id']."'");
while($row_tree_8 = mysqli_fetch_array($select_tree_8)){
$ur_refss8=$row_tree_8['id'];
		$ur_refss_id8 = $row_tree_8['reference_id'];
$query_ref_qry8 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id8."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result8 = mysqli_fetch_array($query_ref_qry8);

$query_ref_qry17 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss8."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result17 = mysqli_fetch_array($query_ref_qry17);

$query_ref_qry27 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss8."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result27 = mysqli_fetch_array($query_ref_qry27);

$reinvest7=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss8."'");
$reinvest_income7=mysqli_fetch_array($reinvest7);

$buy7=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss8."'");
$buy_amount7=mysqli_fetch_array($buy7);

$total_amount7=$query_ref_amt_result17['amount']+$query_ref_amt_result27['amount1'];

$total_income_amnt_8a = $query_ref_amt_result8['ref_total_amt'];
if($total_income_amnt_8a == '')
{
$total_income_amnt_8 = 0;
}
else
{
$total_income_amnt_8 = $total_income_amnt_8a;
}

	?>      
	 <?php
$select_tree_9 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_8['reference_id']."'");
while($row_tree_9 = mysqli_fetch_array($select_tree_9)){
$ur_refss9=$row_tree_9['id'];
		$ur_refss_id9 = $row_tree_9['reference_id'];
$query_ref_qry9 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id9."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result9 = mysqli_fetch_array($query_ref_qry9);

$query_ref_qry18 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss9."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result18 = mysqli_fetch_array($query_ref_qry18);

$query_ref_qry28 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss9."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result28 = mysqli_fetch_array($query_ref_qry28);

$reinvest8=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss9."'");
$reinvest_income8=mysqli_fetch_array($reinvest8);

$buy8=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss9."'");
$buy_amount8=mysqli_fetch_array($buy8);


$total_amount8=$query_ref_amt_result18['amount']+$query_ref_amt_result28['amount1'];

$total_income_amnt_9a = $query_ref_amt_result9['ref_total_amt'];
if($total_income_amnt_9a == '')
{
$total_income_amnt_9 = 0;
}
else
{
$total_income_amnt_9 = $total_income_amnt_9a;
}

	?>
                                
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_9['name']; ?></td>
                                <td><?php echo $row_tree_9['reference_id']; ?></td>
                                <td><?php echo $row_tree_8['reference_id']; ?></td>
                                <td><?php echo $row_tree_8['name']?></td>
                                <td><?php echo  floor($total_amount8);?></td>
                                <td><?php echo floor($query_ref_amt_result18['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_9['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}
}
}
}
}
}

?>
                        </table>
                                           <br>                
                   <h1>Level 9</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                 <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                     <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                          
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
	 <?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result15 = mysqli_fetch_array($query_ref_qry15);

$query_ref_qry25 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss6."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result25 = mysqli_fetch_array($query_ref_qry25);

$reinvest5=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss6."'");
$reinvest_income5=mysqli_fetch_array($reinvest5);

$buy5=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss6."'");
$buy_amount5=mysqli_fetch_array($buy5);

$total_amount5=$query_ref_amt_result15['amount']+$query_ref_amt_result25['amount1'];

$total_income_amnt_6a = $query_ref_amt_result6['ref_total_amt'];
if($total_income_amnt_6a == '')
{
$total_income_amnt_6 = 0;
}
else
{
$total_income_amnt_6 = $total_income_amnt_6a;
}

	?>
	<?php
$select_tree_7 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_6['reference_id']."'");
while($row_tree_7 = mysqli_fetch_array($select_tree_7)){
$ur_refss7=$row_tree_7['id'];
		$ur_refss_id7 = $row_tree_7['reference_id'];
$query_ref_qry7 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id7."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result7 = mysqli_fetch_array($query_ref_qry7);

$query_ref_qry16 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss7."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result16 = mysqli_fetch_array($query_ref_qry16);

$query_ref_qry26 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss7."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result26 = mysqli_fetch_array($query_ref_qry26);

$reinvest6=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss7."'");
$reinvest_income6=mysqli_fetch_array($reinvest6);

$buy6=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss7."'");
$buy_amount6=mysqli_fetch_array($buy6);

$total_amount6=$query_ref_amt_result16['amount']+$query_ref_amt_result26['amount1'];

$total_income_amnt_7a = $query_ref_amt_result7['ref_total_amt'];
if($total_income_amnt_7a == '')
{
$total_income_amnt_7 = 0;
}
else
{
$total_income_amnt_7 = $total_income_amnt_7a;
}

	?>
          <?php
$select_tree_8 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_7['reference_id']."'");
while($row_tree_8 = mysqli_fetch_array($select_tree_8)){
$ur_refss8=$row_tree_8['id'];
		$ur_refss_id8 = $row_tree_8['reference_id'];
$query_ref_qry8 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id8."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result8 = mysqli_fetch_array($query_ref_qry8);

$query_ref_qry17 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss8."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result17 = mysqli_fetch_array($query_ref_qry17);

$query_ref_qry27 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss8."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result27 = mysqli_fetch_array($query_ref_qry27);

$reinvest7=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss8."'");
$reinvest_income7=mysqli_fetch_array($reinvest7);

$buy7=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss8."'");
$buy_amount7=mysqli_fetch_array($buy7);

$total_amount7=$query_ref_amt_result17['amount']+$query_ref_amt_result27['amount1'];

$total_income_amnt_8a = $query_ref_amt_result8['ref_total_amt'];
if($total_income_amnt_8a == '')
{
$total_income_amnt_8 = 0;
}
else
{
$total_income_amnt_8 = $total_income_amnt_8a;
}

	?>      
	 <?php
$select_tree_9 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_8['reference_id']."'");
while($row_tree_9 = mysqli_fetch_array($select_tree_9)){
$ur_refss9=$row_tree_9['id'];
		$ur_refss_id9 = $row_tree_9['reference_id'];
$query_ref_qry9 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id9."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result9 = mysqli_fetch_array($query_ref_qry9);

$query_ref_qry18 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss9."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result18 = mysqli_fetch_array($query_ref_qry18);

$query_ref_qry28 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss9."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result28 = mysqli_fetch_array($query_ref_qry28);

$reinvest8=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss9."'");
$reinvest_income8=mysqli_fetch_array($reinvest8);

$buy8=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss9."'");
$buy_amount8=mysqli_fetch_array($buy8);


$total_amount8=$query_ref_amt_result18['amount']+$query_ref_amt_result28['amount1'];

$total_income_amnt_9a = $query_ref_amt_result9['ref_total_amt'];
if($total_income_amnt_9a == '')
{
$total_income_amnt_9 = 0;
}
else
{
$total_income_amnt_9 = $total_income_amnt_9a;
}

	?>
		<?php
$select_tree_10 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_9['reference_id']."'");
while($row_tree_10 = mysqli_fetch_array($select_tree_10)){
$ur_refss10=$row_tree_10['id'];
		$ur_refss_id10 = $row_tree_10['reference_id'];
$query_ref_qry10 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id10."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result10 = mysqli_fetch_array($query_ref_qry10);

$query_ref_qry19 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss10."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result19 = mysqli_fetch_array($query_ref_qry19);

$query_ref_qry29 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss10."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result29 = mysqli_fetch_array($query_ref_qry29);

$reinvest9=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss10."'");
$reinvest_income9=mysqli_fetch_array($reinvest9);

$buy9=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss10."'");
$buy_amount9=mysqli_fetch_array($buy9);

$total_amount9=$query_ref_amt_result19['amount']+$query_ref_amt_result29['amount1'];

$total_income_amnt_10a = $query_ref_amt_result10['ref_total_amt'];
if($total_income_amnt_10a == '')
{
$total_income_amnt_10 = 0;
}
else
{
$total_income_amnt_10 = $total_income_amnt_10a;
}
?>
                                
                                <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_10['name']; ?></td>
                                <td><?php echo $row_tree_10['reference_id']; ?></td>
                                <td><?php echo $row_tree_9['reference_id']; ?></td>
                                <td><?php echo $row_tree_9['name']?></td>
                                <td><?php echo  floor($total_amount9);?></td>
                                <td><?php echo floor($query_ref_amt_result19['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_10['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}
}
}
}
}
}
}

?>
                        </table>
                                                                   <br>                
                   <h1>Level 10</h1>
                    <table class="table table-striped table-bordered" style="font-family:Times New Roman;">
                         <thead>
                            <tr style="background-color:#5f76bb;color:#fff;">
                                <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                              <!--  <th>SNO</th>-->
                              <!--   <th>User Name</th>-->
                              <!--  <th>User Id</th>-->
                              <!--  <th>Total Purchase Amount</th>-->
                              <!--  <th>Total Purchase Qunatity</th>-->
                              <!--<th>Joining Date</th>-->
                            </tr>
                            
                        </thead>
                     <?php
                              $cnt = 1;
                            $select_tree_2 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$_GET['id']."'");
                          
while($row_tree_2 = mysqli_fetch_array($select_tree_2)){
$ur_refss2=$row_tree_2['id'];
	$ur_refss_id2 = $row_tree_2['reference_id'];
$query_ref_qry2 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id2."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result2 = mysqli_fetch_array($query_ref_qry2);

$query_ref_qry11 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss2."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry21 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss2."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result21 = mysqli_fetch_array($query_ref_qry21);

$reinvest1=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss2."'");
$reinvest_income1=mysqli_fetch_array($reinvest1);

$buy1=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss2."'");
$buy_amount1=mysqli_fetch_array($buy1);

$total_amount1=$query_ref_amt_result11['amount']+$query_ref_amt_result21['amount1'];

$total_income_amnt_2a = $query_ref_amt_result2['ref_total_amt'];
if($total_income_amnt_2a == '')
{
$total_income_amnt_2 = 0;
}
else
{
$total_income_amnt_2 = $total_income_amnt_2a;
}
$rf_id_gt = $row['reference_id'];
                                  ?>
                                                         <?php
                            //   $cnt = 1;
                            $select_tree_3 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_2['reference_id']."'");
while($row_tree_3 = mysqli_fetch_array($select_tree_3)){
$ur_refss3=$row_tree_3['id'];
	$ur_refss_id3 = $row_tree_3['reference_id'];
$query_ref_qry3 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id3."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result3 = mysqli_fetch_array($query_ref_qry3);

$query_ref_qry12 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss3."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result12 = mysqli_fetch_array($query_ref_qry12);

$query_ref_qry22 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss3."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result22 = mysqli_fetch_array($query_ref_qry22);

$reinvest11=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss3."'");
$reinvest_income11=mysqli_fetch_array($reinvest11);

$buy11=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss3."'");
$buy_amount11=mysqli_fetch_array($buy11);

$total_amount11=$query_ref_amt_result12['amount']+$query_ref_amt_result22['amount1'];

$total_income_amnt_3a = $query_ref_amt_result3['ref_total_amt'];
if($total_income_amnt_3a == '')
{
$total_income_amnt_3 = 0;
}
else
{
$total_income_amnt_3 = $total_income_amnt_3a;
}   
?>
 	<?php
$select_tree_4 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_3['reference_id']."'");
while($row_tree_4 = mysqli_fetch_array($select_tree_4)){
$ur_refss4=$row_tree_4['id'];
		$ur_refss_id4 = $row_tree_4['reference_id'];
$query_ref_qry4 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id4."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result4 = mysqli_fetch_array($query_ref_qry4);

$query_ref_qry13 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss4."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result13 = mysqli_fetch_array($query_ref_qry13);

$query_ref_qry23 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss4."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result23 = mysqli_fetch_array($query_ref_qry23);

$reinvest3=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss4."'");
$reinvest_income3=mysqli_fetch_array($reinvest3);

$buy3=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss4."'");
$buy_amount3=mysqli_fetch_array($buy3);

$total_amount3=$query_ref_amt_result13['amount']+$query_ref_amt_result23['amount1'];

$total_income_amnt_4a = $query_ref_amt_result4['ref_total_amt'];
if($total_income_amnt_4a == '')
{
$total_income_amnt_4 = 0;
}
else
{
$total_income_amnt_4 = $total_income_amnt_4a;
}

	?>
	<?php
$select_tree_5 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_4['reference_id']."'");
while($row_tree_5 = mysqli_fetch_array($select_tree_5)){
$ur_refss5=$row_tree_5['id'];
		$ur_refss_id5 = $row_tree_5['reference_id'];
$query_ref_qry5 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id5."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result5 = mysqli_fetch_array($query_ref_qry5);

$query_ref_qry14 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss5."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result14 = mysqli_fetch_array($query_ref_qry14);

$query_ref_qry24 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss5."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result24 = mysqli_fetch_array($query_ref_qry24);

$reinvest4=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss5."'");
$reinvest_income4=mysqli_fetch_array($reinvest5);

$buy4=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss5."'");
$buy_amount4=mysqli_fetch_array($buy4);

$total_amount4=$query_ref_amt_result14['amount']+$query_ref_amt_result24['amount1'];

$total_income_amnt_5a = $query_ref_amt_result5['ref_total_amt'];
if($total_income_amnt_5a == '')
{
$total_income_amnt_5 = 0;
}
else
{
$total_income_amnt_5 = $total_income_amnt_5a;
}

	?>
	 <?php
$select_tree_6 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_5['reference_id']."'");
while($row_tree_6 = mysqli_fetch_array($select_tree_6)){
$ur_refss6=$row_tree_6['id'];
		$ur_refss_id6 = $row_tree_6['reference_id'];
$query_ref_qry6 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id6."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result6 = mysqli_fetch_array($query_ref_qry6);

$query_ref_qry15 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss6."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result15 = mysqli_fetch_array($query_ref_qry15);

$query_ref_qry25 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss6."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result25 = mysqli_fetch_array($query_ref_qry25);

$reinvest5=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss6."'");
$reinvest_income5=mysqli_fetch_array($reinvest5);

$buy5=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss6."'");
$buy_amount5=mysqli_fetch_array($buy5);

$total_amount5=$query_ref_amt_result15['amount']+$query_ref_amt_result25['amount1'];

$total_income_amnt_6a = $query_ref_amt_result6['ref_total_amt'];
if($total_income_amnt_6a == '')
{
$total_income_amnt_6 = 0;
}
else
{
$total_income_amnt_6 = $total_income_amnt_6a;
}

	?>
	<?php
$select_tree_7 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_6['reference_id']."'");
while($row_tree_7 = mysqli_fetch_array($select_tree_7)){
$ur_refss7=$row_tree_7['id'];
		$ur_refss_id7 = $row_tree_7['reference_id'];
$query_ref_qry7 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id7."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result7 = mysqli_fetch_array($query_ref_qry7);

$query_ref_qry16 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss7."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result16 = mysqli_fetch_array($query_ref_qry16);

$query_ref_qry26 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss7."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result26 = mysqli_fetch_array($query_ref_qry26);

$reinvest6=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss7."'");
$reinvest_income6=mysqli_fetch_array($reinvest6);

$buy6=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss7."'");
$buy_amount6=mysqli_fetch_array($buy6);

$total_amount6=$query_ref_amt_result16['amount']+$query_ref_amt_result26['amount1'];

$total_income_amnt_7a = $query_ref_amt_result7['ref_total_amt'];
if($total_income_amnt_7a == '')
{
$total_income_amnt_7 = 0;
}
else
{
$total_income_amnt_7 = $total_income_amnt_7a;
}

	?>
          <?php
$select_tree_8 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_7['reference_id']."'");
while($row_tree_8 = mysqli_fetch_array($select_tree_8)){
$ur_refss8=$row_tree_8['id'];
		$ur_refss_id8 = $row_tree_8['reference_id'];
$query_ref_qry8 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id8."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result8 = mysqli_fetch_array($query_ref_qry8);

$query_ref_qry17 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss8."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result17 = mysqli_fetch_array($query_ref_qry17);

$query_ref_qry27 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss8."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result27 = mysqli_fetch_array($query_ref_qry27);

$reinvest7=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss8."'");
$reinvest_income7=mysqli_fetch_array($reinvest7);

$buy7=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss8."'");
$buy_amount7=mysqli_fetch_array($buy7);

$total_amount7=$query_ref_amt_result17['amount']+$query_ref_amt_result27['amount1'];

$total_income_amnt_8a = $query_ref_amt_result8['ref_total_amt'];
if($total_income_amnt_8a == '')
{
$total_income_amnt_8 = 0;
}
else
{
$total_income_amnt_8 = $total_income_amnt_8a;
}

	?>      
	 <?php
$select_tree_9 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_8['reference_id']."'");
while($row_tree_9 = mysqli_fetch_array($select_tree_9)){
$ur_refss9=$row_tree_9['id'];
		$ur_refss_id9 = $row_tree_9['reference_id'];
$query_ref_qry9 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id9."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result9 = mysqli_fetch_array($query_ref_qry9);

$query_ref_qry18 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss9."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result18 = mysqli_fetch_array($query_ref_qry18);

$query_ref_qry28 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss9."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result28 = mysqli_fetch_array($query_ref_qry28);

$reinvest8=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss9."'");
$reinvest_income8=mysqli_fetch_array($reinvest8);

$buy8=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss9."'");
$buy_amount8=mysqli_fetch_array($buy8);


$total_amount8=$query_ref_amt_result18['amount']+$query_ref_amt_result28['amount1'];

$total_income_amnt_9a = $query_ref_amt_result9['ref_total_amt'];
if($total_income_amnt_9a == '')
{
$total_income_amnt_9 = 0;
}
else
{
$total_income_amnt_9 = $total_income_amnt_9a;
}

	?>
		<?php
$select_tree_10 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_9['reference_id']."'");
while($row_tree_10 = mysqli_fetch_array($select_tree_10)){
$ur_refss10=$row_tree_10['id'];
		$ur_refss_id10 = $row_tree_10['reference_id'];
$query_ref_qry10 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id10."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result10 = mysqli_fetch_array($query_ref_qry10);

$query_ref_qry19 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss10."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result19 = mysqli_fetch_array($query_ref_qry19);

$query_ref_qry29 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss10."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result29 = mysqli_fetch_array($query_ref_qry29);

$reinvest9=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss10."'");
$reinvest_income9=mysqli_fetch_array($reinvest9);

$buy9=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss10."'");
$buy_amount9=mysqli_fetch_array($buy9);

$total_amount9=$query_ref_amt_result19['amount']+$query_ref_amt_result29['amount1'];

$total_income_amnt_10a = $query_ref_amt_result10['ref_total_amt'];
if($total_income_amnt_10a == '')
{
$total_income_amnt_10 = 0;
}
else
{
$total_income_amnt_10 = $total_income_amnt_10a;
}
?>
	<?php
$select_tree_11 = mysqli_query($con, "select * from milkyway_usersignup where link_reference_id='".$row_tree_10['reference_id']."'");
while($row_tree_11 = mysqli_fetch_array($select_tree_11)){
$ur_refss10=$row_tree_11['id'];
		$ur_refss_id11 = $row_tree_11['reference_id'];
$query_ref_qry11 = mysqli_query($con, "SELECT sum(`percent_amt_qty`) as ref_total_amt FROM `milkyway_level__income` WHERE `user_id`= '".$ur_refss_id11."' AND pay_status='success' ORDER BY id ASC");
$query_ref_amt_result11 = mysqli_fetch_array($query_ref_qry11);

$query_ref_qry20 = mysqli_query($con, "SELECT sum(`total_price`) as amount,sum(qnty) as token FROM `milkway_userpay_list` WHERE `user_id`= '".$ur_refss11."' AND status='success' ORDER BY id ASC");
$query_ref_amt_result20 = mysqli_fetch_array($query_ref_qry20);

$query_ref_qry30 = mysqli_query($con, "SELECT sum(`sell_token`) as amount1 FROM `sell_token` WHERE `user_id`= '".$ur_refss11."' AND status='Pending' ORDER BY id ASC");
$query_ref_amt_result30 = mysqli_fetch_array($query_ref_qry30);

$reinvest10=mysqli_query($con,"SELECT sum(token)as token FROM `reinvestment_token` where user_id='".$ur_refss11."'");
$reinvest_income10=mysqli_fetch_array($reinvest10);

$buy10=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$ur_refss11."'");
$buy_amount10=mysqli_fetch_array($buy10);

$total_amount10=$query_ref_amt_result20['amount']+$query_ref_amt_result30['amount1'];

$total_income_amnt_11a = $query_ref_amt_result11['ref_total_amt'];
if($total_income_amnt_11a == '')
{
$total_income_amnt_11 = 0;
}
else
{
$total_income_amnt_11 = $total_income_amnt_11a;
}
 ?>
                                
                               <tr>
                                      <td><?php echo $cnt;?></td>
                                <td><?php echo $row_tree_11['name']; ?></td>
                                <td><?php echo $row_tree_11['reference_id']; ?></td>
                                <td><?php echo $row_tree_10['reference_id']; ?></td>
                                <td><?php echo $row_tree_10['name']?></td>
                                <td><?php echo  floor($total_amount10);?></td>
                                <td><?php echo floor($query_ref_amt_result20['token']);?></td>
                               <td><?php echo date('F d Y h:i:s', strtotime($row_tree_11['date']));?></td>
                               </tr>
                                  <?php 
    
   $cnt++; 
}
}
}
}
}
}
}
}
}
}
 
?>
                      </table>
                       </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- File export table -->
        
       
        
        
        <!--/ Language - Comma decimal place table -->
      </div>
    </div>
  </div>
  <?php include('inc/footer.php');?>
