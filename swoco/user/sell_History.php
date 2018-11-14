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
$query = mysqli_query($con, "SELECT * FROM `sell_token` where status='Pending' ORDER BY id ASC");
 $date = date('Y-m-d G:i:s');
if(isset($_GET['id']))
{
   
      $sql=mysqli_query($con,"INSERT INTO `buy_token`(`user_id`, `sell_user_id`, `token_quantity`, `phase`, `status`, `buy_date`) VALUES ('".$_SESSION['user_id']."','".$_GET['id']."','".$_GET['token']."','".$_GET['phase']."','Pending','".$date."')");
   if($sql)
   {
       $msg='<div class="alert alert-success">You have Buy Token Success!</div>'; 
   }
   else
   {
      $msg='<div class="alert alert-danger">You have Not Buy!</div>';  
   }
  
}
?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Swoco Buy List </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item"><a href="Swoco_Market.php">Swoco Market</a>
                </li>
                <li class="breadcrumb-item active">Swoco Buy List
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
                  <h4 class="card-title">Swoco Buy Table</h4>
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
                  
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th>SNo</th>
                         <th>Order Id</th>
                         <th>Token Quantity</th>
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
                                 $q=mysqli_query($con,"SELECT sum(token_quantity)as sell FROM `buy_token` where status='Pending' and order_id='". $row['order_id']."' and phase='".$row['sell_phase']."' ORDER BY id ASC");
                        $qq=mysqli_fetch_array($q);
                        $a=$row['sell_token']-$qq['sell'];
                         if($a!=0)
                         {
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['order_id'];?></td>
                                <td><?php echo $row['sell_token']-$qq['sell']; ?></td>
                              	 <td><a class="btn btn-secondary buttons-print btn-primary mr-1" href="buy_sell_token.php?id=<?php echo $row['user_ref_id'];?>&token=<?php echo $row['sell_token']-$qq['sell'];?>&phase=<?php echo $row['sell_phase'];?>&orderid=<?php echo $row['order_id'];?>"><span>BUY</span></a></td>
                           
                            </tr>
                            <?php
                         }
                            $cnt++; } } ?>
					
                       
						
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