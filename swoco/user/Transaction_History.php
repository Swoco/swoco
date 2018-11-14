<?php include('../inc/header.php');?>
<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}

$ref_ur_id =$_SESSION['ref_idsignup'];
$query = mysqli_query($con, "SELECT * FROM  `milkway_userpay_list` WHERE `user_rf_id`='".$ref_ur_id."'");

function amountdata($id,$mode)
{
     $query1=mysqli_query($con,"SELECT  sum(sell_token) as token FROM `sell_token` where user_id='$id'");
   while($row1 = mysqli_fetch_array($query1))
     return $row1['token'];
}
?>
<script>
     function delPurchase(txv1)
     {
      var xbd = confirm('Are You Sure You Want Delete this ?');

      if(xbd)
      {
          window.location.href='update_function.php?pd_id='+txv1;
      }
     }
   </script>
	
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Transaction  History</h3>
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
              <div class="card" style="overflow:auto;">
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
                    <table class="table table-striped table-bordered file-export" style="font-family:vev;">
                      <thead>
                      <tr style="background-color:#5f76bb;color:#fff;">
                                <th>No</th>
                                <th>Order Id</th>
                                 <!--<th>Add by</th>-->
                                 <th>Swoco Price ($)</th>
                                <th>Swoco Qty</th>
                                <th>Swoco  Amount($)</th>
                                <th>Phase</th>
                               <th>Payment Status</th>
                                <th>Remarks</th>
                                <th>Pay Date</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(mysqli_num_rows($query) > 0)
                            {
                            $cnt = 1;
                            while($row = mysqli_fetch_array($query)) 
                            {  
//                                 $query1=mysqli_query($con,"SELECT  sum(sell_token) as token FROM `sell_token` where user_id='".$row['user_id']."' and buy_phase='".$row['phase_mode']."' asc  id");
// $row1 = mysqli_fetch_array($query1)
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['ord_id']; ?></td>
                                 <!--<td><?php if($row['mode']=='admin'){ echo 'admin';}else { echo 'user'; } ?></td>-->
                                <td><?php echo $row['unit_price']; ?></td>
                                <td><?php echo $row['total_price']/$row['unit_price'] ?></td>
                                 <td><?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['phase_mode']; ?></td>
                                <?php if($row['status']=='success'){?>
                           <td style="color:green;"><?php echo "Success"?></td>
                           <?php }
                           else
                           {
                           ?>
                           <td style="color:red;"><?php echo "Pending"?></td>
                           <?php }?>
                              <!--<td><?php echo $row['status']; ?></td>-->
                                <td><?php echo $row['remarks']; ?></td>
                                <td><?php echo $row['pay_datetime']; ?></td>
                                
                                <?php if($row['status']=='pending'){ ?>
                                <td><a href="reintiate_buy_coin.php?purcid=<?php echo $row['id']; ?>&qty=<?php echo $row['total_price'];?>&order_id=<?php echo $row['ord_id'];?>"><input type="button"  class="btn btn-success mr-10" value="Pay Now"></a>
                               </td><td><a href="javascript:void(0);" onclick="delPurchase(<?php echo $row['id']; ?>);"><input type="button" value="Delete"  class="btn btn-success mr-10"></a></td>

                                 <?php } else { ?>
                  
                                <td>..</td>
                                <td>..</td>
                              
                                <?php } ?>
                            </tr>
                            <?php $cnt++; } } ?>

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
 <?php include('../inc/footer.php');?>