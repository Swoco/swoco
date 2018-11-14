<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
 $sql_history = "SELECT * FROM milkway_userpay_list WHERE 1=1 ORDER BY `id` desc";
  $query = mysqli_query($con, $sql_history);
  
  $sql_history1 = "SELECT sum(qnty)as qunty,sum(total_price) as amount FROM milkway_userpay_list  ORDER BY `id` desc";
  $query1 = mysqli_query($con, $sql_history1);
  
  
//  $ur_id = $_SESSION['user_id'];

$p_user_order_id='';
$p_user_phase_mode='';
$p_user_pay_status='';

$user_purch_sql = "SELECT * FROM `milkway_userpay_list` WHERE 1=1";
if(isset($_POST['p_user_hist_submit']))
{
 $p_user_order_id = mysqli_real_escape_string($con, trim($_POST['p_user_order_id']));
 $p_user_phase_mode = mysqli_real_escape_string($con, trim($_POST['p_user_phase_mode']));
  $p_user_remarks_mode = mysqli_real_escape_string($con, trim($_POST['p_user_remarks_status']));
 $p_user_pay_status = mysqli_real_escape_string($con, trim($_POST['p_user_pay_status']));

  $start_dte = mysqli_real_escape_string($con, trim($_POST['start_d']));
   $end_dte = mysqli_real_escape_string($con, trim($_POST['end_d']));

 if($p_user_order_id !='')
 {
    $user_purch_sql .= " AND `ord_id`='".$p_user_order_id."'";
 }
 if($p_user_phase_mode !='')
 {
     $user_purch_sql .= " AND `phase_mode`='".$p_user_phase_mode."'";
 }
 if($p_user_remarks_mode !='')
 {
     $user_purch_sql .= " AND `remarks`='".$p_user_remarks_mode."'";
 }
 if($p_user_pay_status !='')
 {
    $user_purch_sql .= " AND `status`='".$p_user_pay_status."'";
 }

  if(($start_dte !='') && ($end_dte !=''))
        {
          $start_dte2 = date('Y-m-d 00:00:00', strtotime($start_dte));
          $end_dte2 = date('Y-m-d 00:00:00', strtotime('+1 day', strtotime($end_dte)));
          $user_purch_sql .= " AND `added_date` >= '".$start_dte2."' AND `added_date` <= '".$end_dte2."'";
        } 

}

$user_purch_sql .= " ORDER BY `pay_datetime` DESC";

    $query = mysqli_query($con, $user_purch_sql);



        $phs_mode_arr = array();
    $phs_mode_arr_query = mysqli_query($con, "SELECT `phase_mode` FROM `milkway_userpay_list`  group by `phase_mode`");
    while($row_phs_mode_arr = mysqli_fetch_array($phs_mode_arr_query))
    {
        $phs_mode_arr[] = $row_phs_mode_arr['phase_mode'];         
    }



        $phs_remarks_arr = array();
    $phs_remarks_arr_query = mysqli_query($con, "SELECT `remarks` FROM `milkway_userpay_list`  group by `remarks`");
    while($row_phs_remarks_arr = mysqli_fetch_array($phs_remarks_arr_query))
    {
        $phs_remarks_arr[] = $row_phs_remarks_arr['remarks'];         
    }

    $st_arr = array();
    $st_arr_query = mysqli_query($con, "SELECT `status` FROM `milkway_userpay_list` group by `status`");
    while($row_st_arr = mysqli_fetch_array($st_arr_query))
    {
        $st_arr[] = $row_st_arr['status'];         
    }
 
    ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Transaction History</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">Transaction History
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
                  <h4 class="card-title">File export</h4>
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
                  
                  <div class="advancesearchbtn">
		   <div class="row">
 
 <div class="col-sm-6">
     <!--<a href="excel_format.php?action=user_purchasehistory&order_id=<?php echo $p_user_order_id; ?>&phase_mode=<?php echo $p_user_phase_mode; ?>&remarks=<?php echo $p_user_remarks_mode; ?>&status=<?php echo $p_user_pay_status; ?>&uiddd=<?php echo $ur_id; ?>">-->
     <!--    <button class="btn btn-primary pull-left advancesearchbtn1">Download CSV</button></a>-->
         </div>
		
		<div class="col-sm-6"><button class="btn btn-primary pull-right advancesearchbtn1">Advanced Search</button></div>
		 </div>
         </div>
        


  <div class="panel panel-default advancesearchdiv card-view" style="display: none;">

                <div class="panel-wrapper ">

                  <div class="panel-body">

                     <div class="table-responsive">

                                         <table class="table table-striped table-bordered" cellspacing="0" width="100%">

                                         <thead>

                                         <tr>

                                         <!--<th>Order Id :</th>-->
                                             <!--<th>&nbsp; </th>-->
                                            <th>Phase Mode :</th>
                                           
                                            <th>Status :</th>
                                            <th>Remarks</th>
                                            <th>&nbsp; </th>
                                            <!--<th>Start date :</th>-->
                                           
                                            <!--<th>end date :</th>-->
                                          

                                        </tr>

                                        </thead>

                                        <tbody>

                                            <form action="" method="post" name="purchase-user-form">

                                        <tr>

                                            <!--<th><input class="form-control" name="p_user_order_id" placeholder="Enter Order Id " autocomplete="off" value="<?php echo $p_user_order_id; ?>"></th>-->

                                            <!--<th>&nbsp; </th>-->

                                            <th><select class="form-control" name="p_user_phase_mode">
                                                <option value="">Select Phase</option>
                                                <?php foreach ($phs_mode_arr as $phs_mode_ar) { ?>
                                                <option value="<?php echo $phs_mode_ar; ?>" <?php if($p_user_phase_mode == $phs_mode_ar) { echo "selected"; } ?>><?php echo $phs_mode_ar; ?></option>
                                                <?php } ?>
                                            </select></th>

                                          

                                            <th><select class="form-control" name="p_user_pay_status">
                                                <option value="">Select Status</option>
                                                <?php foreach ($st_arr as $st_ar) { ?>
                                                <option value="<?php echo $st_ar; ?>" <?php  if($p_user_pay_status == $st_ar) { echo "selected"; } ?>><?php echo $st_ar; ?></option>
                                                <?php } ?>
                                            </select></th>
                                              <th><select class="form-control" name="p_user_remarks_status">
                                                <option value="">Select remarks</option>
                                                <?php foreach ($phs_remarks_arr as $phs_remarks_ar) { ?>
                                                <option value="<?php echo $phs_remarks_ar; ?>" <?php  if($p_user_remarks_mode == $phs_remarks_ar) { echo "selected"; } ?>><?php echo $phs_remarks_ar; ?></option>
                                                <?php } ?>
                                            </select></th>
<!--<th><div class='input-group date' id='datetimepicker1'>-->
<!--                    <input type='text' class="form-control" name="start_d" value="<?php echo $start_dte; ?>"/>-->
<!--                    <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--                    </span>-->
<!--                </div></th>-->
<!-- <th><div class='input-group date' id='datetimepicker2'>-->
<!--                    <input type='text' class="form-control" name="end_d" value="<?php echo $end_dte; ?>"/>-->
<!--                    <span class="input-group-addon">-->
<!--                        <span class="glyphicon glyphicon-calendar"></span>-->
<!--                    </span>-->
<!--                </div></th>-->

<th><input type="submit" name="p_user_hist_submit" class="btn btn-primary form-control" value="Search"></th>

                                        </tr>

                                        </form>

                                        </tbody>

                                         </table>

                                        </div>

                  </div>

                </div>

              </div>    

                  
                  
                    <table class="table table-striped table-bordered file-export">
                      <thead>
                        <tr>
                                <th>No</th>
                                <th>Order Id</th>
                                <!--<th>Add by</th>-->
                                <th>User Id</th>
                             
                                <th>User Email</th>
								<th> Swoco Qty</th>
                                <th>Swoco Price ($)</th>
								<th>Amount ($)</th>
								<th>BTC Amount</th>
								<th>Phase</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Pay Date</th>
                                <th>Action</th>

							   
                        </tr>
                      </thead>
                      <tbody>
                           <?php
                            $cnt = 1;
                            while($row = mysqli_fetch_array($query)) 
                            {  
                              $u_ids  = $row['user_id'];
                              $u_res_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='".$u_ids."'");
                              $u_res_rec = mysqli_fetch_array($u_res_qry);
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['ord_id']; ?></td>
                                 <!--<td><?php echo $row['mode'];?></td>-->
                                <td><a href="user-list-summary.php?id=<?php echo $row['user_id']; ?>" target="_blank"><?php echo $u_res_rec['reference_id']; ?></a></td>
                             
                                <td><?php echo $row['user_email']; ?></td>
                                 <td><?php echo $row['total_price']/$row['unit_price'] ?></td>
                                <td><?php echo $row['unit_price']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                                 <td><?php 
                                 if( $row['inv_type_amt']=='')
                                 {
                                     echo '-';
                                 }
                                 else{
                                echo  $row['inv_type_amt'];
                                 }?></td>
                                <td><?php echo 'Phase'.$row['phase_mode']; ?></td>
                            
                              <?php if($row['status']=='success'){?>
                           <td style="color:green;"><?php echo $row['status'];?></td>
                           <?php }
                           else
                           {
                           ?>
                           <td style="color:red;"><?php echo $row['status'];?></td>
                           <?php }?>
                                <!--<td><?php echo $row['status']; ?></td>-->
                                 <td><?php echo $row['remarks']; ?></td>
                                <td><?php echo $row['pay_datetime']; ?></td>
                                 
                                 <?php if($row['status']=='pending'){ ?>
                              
                               <td><a href="reintiate_buy_coin.php?purcid=<?php echo $row['id']; ?>&userid=<?php echo $row['user_id']; ?>&qty=<?php echo $row['total_price'];?>&order_id=<?php echo $row['ord_id'];?>"><input type="button"  class="btn btn-success mr-10" value="Pay Now"></a>
                             
                                 <?php } else { ?>
                  
                                <td>..</td>
                              
                                <?php } ?>
                                
                            </tr>
							<?php $cnt++; } ?>
                     </tbody>
                     
                    </table>
                    
                    
                      <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                            <th>SNO</th>
                                <th>TOTAL PURCHASE AMOUNT</th>
                              
                                 <th>TOTAL SWOCO QUNATITY</th>
                               
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          $row1 = mysqli_fetch_array($query1);
                         // $row11 = mysqli_fetch_array($query11);
                          ?>
                            <tr>
                                <td>1</td>
                                <td><?php echo $row1['amount']; ?></td>
                                 <td><?php echo $row1['qunty']; ?></td>
                            </tr>
						
                     </tbody>
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
  <?php if(isset($_POST['p_user_hist_submit'])){ ?>
    <script>
        $(".advancesearchdiv").show();
    </script>
  <?php } ?>

  <script>
  $(document).ready(function(){
    $(".advancesearchbtn1").click(function(){
        $(".advancesearchdiv").toggle();
    });
});
  </script>



<!--<script type="text/javascript">-->
<!--            $(function () {-->
<!--                $('#datetimepicker1').datetimepicker();-->
<!--            });-->
<!--        </script>-->


<!--<script type="text/javascript">-->
<!--            $(function () {-->
<!--                $('#datetimepicker2').datetimepicker();-->
<!--            });-->
<!--        </script>-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>-->
