<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
}  
$ref_idst = $_SESSION['ref_idsignup'];
$query = mysqli_query($con, "SELECT * FROM `withdraw`  ORDER BY id ASC");
$date = date('Y-m-d G:i:s');
?>
 <script>
      function upConfirmwithdrawl(trs)
      {
        var x1 = confirm('Are You Sure You Want to Confirm This Request ?');
        if(x1)
        {
          window.location.href='update_function_file.php?action=withdrwal&trnss='+trs;
        }
      }
    </script>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Withdraw List </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item active">Withdraw List
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
                        <tr>
                         <th>SNo</th>
                         <th>User Id</th>
                         <th>Transaction Id</th>
                         <th>Withdraw Amount($)</th>
                          <th>BTC Price</th>
                         <th>Bitcoin Address</th>
                         <th>Message</th>
                         <th>Status</th>
                          <th>Date</th>
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
                                $sql=mysqli_query($con,"select * from milkyway_usersignup  where id='".$row['user_id']."'");
                                $data=mysqli_fetch_array($sql);
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['user_ref_id'];?></td>
                               <td><?php echo $row['trns_id'];?></td>
                               <td>$<?php echo $row['amount']; ?></td>
                                 <td><?php echo $row['btc_amount']; ?></td>
                               	 <td><?php echo $data['bitcoin_wallet_address'];?></td>
                               	   <td><?php echo $row['message'];?></td> 
                               	   <?php if($row['status']=='success'){?>
                           <td style="color:green;"><?php echo "Success"?></td>
                           <?php }
                           else
                           {
                           ?>
                           <td style="color:red;"><?php echo "Pending"?></td>
                           <?php }?>
                              
                               	  <td><?php echo $row['date'];?></td> 
                               	  <td><?php if($row['status'] =='success'){ echo 'Payment Done';} else { ?><a onclick="upConfirmwithdrawl(<?php echo $row['trns_id']; ?>);"  class="btn btn-success mr-10">Pay Withdraw</a><?php } ?></td>
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
 <?php include('inc/footer.php');?>