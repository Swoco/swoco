<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
 $sql_history = "SELECT * FROM `sell_token` where sell_status='0' ORDER BY `id` desc";
  $query = mysqli_query($con, $sql_history);
    ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Sell Token History</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">Sell Token History
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
                                <!--<th>Add by</th>-->
                                 <th>User Id</th>
                                 <th>Sell Amount</th>
                                 <th>Remaining Sell Amount</th>
							     <th>Status</th>
                                <th>Sell Date</th>

							   
                        </tr>
                      </thead>
                      <tbody>
                           <?php
                            $cnt = 1;
                            while($row = mysqli_fetch_array($query)) 
                            {  
                                 ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['user_ref_id']; ?></a></td>
                                <td><?php echo $row['update_sell_token']; ?></td>
                                <td><?php 
                               echo $row['sell_token'];
                                ?></td>
                                <td><?php 
                                if($row['sell_token']==0)
                                {
                                    echo 'Sold';
                                }
                                else
                                {
                                    echo 'pending';
                                }
                                ?></td>
                                <td><?php echo $row['sell_date']; ?></td>
                              
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