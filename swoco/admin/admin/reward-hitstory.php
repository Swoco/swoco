<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
//  $sql_history = "SELECT * FROM milkway_userpay_list WHERE 1=1 ORDER BY `id` desc";
//   $query = mysqli_query($con, $sql_history);
  
  $sql_history1 = "SELECT * FROM `milkyway_level__income` where pay_status='success' and up_date in ('Asia','Europe','Americas')  and percent_amt='7'";
  $query1 = mysqli_query($con, $sql_history1);
  
 
    ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Reward History</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">Reward History
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
                  
                    <table class="table table-striped table-bordered file-export">
                      <thead>
                        <tr>
                                <th>No</th>
                                <th>Order Id</th>
                                <th>User Id</th>
                                <th>Email</th>
                              	<th>Reward Amount </th>
                                <th>Date</th>
                                

							   
                        </tr>
                      </thead>
                      <tbody>
                           <?php
                            $cnt = 1;
                            while($row = mysqli_fetch_array($query1)) 
                            {  
                              $u_ids  = $row['user_id'];
                              $u_res_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE reference_id='".$u_ids."'");
                              $u_res_rec = mysqli_fetch_array($u_res_qry);
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['inc_transfer_status']; ?></td>
                                 <!--<td><?php echo $row['mode'];?></td>-->
                                <td><a href="user-list-summary.php?id=<?php echo $row['user_id']; ?>" target="_blank"><?php echo $u_res_rec['reference_id']; ?></a></td>
                             
                                <td><?php echo $u_res_rec['email']; ?></td>
                                <td><?php echo $row['ref_amt'];?></td>
                                <td><?php echo $row['add_date'];?></td>
                                
                            </tr>
							<?php $cnt++; } ?>
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