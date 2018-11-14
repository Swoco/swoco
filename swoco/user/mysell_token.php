<?php include('../inc/header.php'); ?>
<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}
$ref_idst = $_SESSION['ref_idsignup'];
$query = mysqli_query($con, "SELECT * FROM `sell_token` where user_id='".$_SESSION['user_id']."' and sell_status='0' ORDER BY id ASC");

 $date = date('Y-m-d G:i:s');
if(isset($_GET['id']))
{
   $sql=mysqli_query($con,"UPDATE `sell_token` SET status='Canceled',canceled_date='".$date."' where order_id='".$_GET['orderid']."'");
   if($sql)
   {
       $sql=mysqli_query($con,"UPDATE `milkway_userpay_list` SET `total_price`=`total_price`+'".$_GET['token']."' where user_id='".$_GET['id']."' and phase_mode='".$_GET['phase']."'");
       $msg='<div class="alert alert-success">You have Cancel Token Success!</div>'; 
   }
   else
   {
      $msg='<div class="alert alert-danger">You have not Cancel Token !</div>';  
   }
  
}
?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Sell Swoco </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item active"><a href="Swoco_Market.php">Swoco Market</a>
                </li>
                 <li class="breadcrumb-item active">Sell Swoco List
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="buy_History-plus">
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
                	<?php if(!empty($msg)) { echo $msg; } ?>
	
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                  
                    <table class="table table-striped table-bordered file-export">
                      <thead>
                        <tr style="background-color:#5f76bb;color:#fff;">
                         <th>SNo</th>
                         <th>Order Id</th>
                         
                          <th>Swoco Quantity</th>
                          <th>Swoco Remaining</th>
                          <th>Sell Swoco</th>
                          <th>Phase</th>
                          <th>Status</th>
                          <th>Date</th>
                          <!--<th>Action</th>-->
						   </tr>
                      </thead>
                      <tbody>
                        <?php
                            if(mysqli_num_rows($query) > 0)
                            {
                            $cnt = 1;
                            while($row = mysqli_fetch_array($query)) 
                            {  
                        $q=mysqli_query($con,"SELECT sum(token_quantity)as sell FROM `buy_token` where status='Pending' and order_id='". $row['order_id']."' and phase='".$row['phase']."' ORDER BY id ASC");
                        $qq=mysqli_fetch_array($q);
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['order_id'];?></td>
                               
                                <td><?php echo $row['update_sell_token']; ?></td>
                                <td><?php echo $row['sell_token'];?></td>
                                <td><?php $a=$row['update_sell_token']-$row['sell_token'];
                                if($a=='0')
                                {
                                    echo $row['update_sell_token'];
                                }
                                else
                                {
                                    echo $a;
                                }
                                ?></td>
                               <td><?php echo $row['sell_phase']; ?></td>
                             
                               	 <td><?php 
                               	 if($row['status']=='Pending')
                               	 {
                               	 echo '<span style="color:red;">'.$row['status'].'</span>';
                               	 }
                               	 else
                               	 {
                               	     echo '<span style="color:green;">'.$row['status'].'</span>';
                               	 }
                               	 ?></td> 
                               	 <td><?php echo $row['sell_date'];?></td>
                          <!--<td><a class="btn btn-secondary buttons-print btn-primary mr-1" href="mysell_token.php?id=<?php echo $row['user_id'];?>&token=<?php echo $row['sell_token'];?>&phase=<?php echo $row['phase'];?>&orderid=<?php echo $row['order_id'];?>"  onclick="if (!confirm('Are you sure you want to cancle sell token?')) { return false }"><span>Cancel</span></a></td>-->
                           
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