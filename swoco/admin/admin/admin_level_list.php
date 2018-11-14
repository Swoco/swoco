<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  


$query = mysqli_query($con, "SELECT * FROM `milkyway_level__income` WHERE pay_status='pending' AND `user_id`!='' ORDER BY id ASC");

?>
<?php include('inc/header.php');?>
 <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Level Histroy</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">Level Histroy</li>
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
								   <th>User Id</th>
                                <th>Ref Id</th>
                               <th>Amount Percentage</th>
                                <th>Level</th>
                                <th>Add Date</th>

							</tr>

                      </thead>
                      <tbody>
                           <?php
                            if(mysqli_num_rows($query) > 0)
                            {
                            $cnt = 1;
                            while($row = mysqli_fetch_array($query)) 
                            {  
                            	$rf_id_gt = $row['ref_id'];
                                $rf_id_gt_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `reference_id`='".$rf_id_gt."'"); 
                                $rf_id_gt_result = mysqli_fetch_array($rf_id_gt_qry);
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <!--<td><?php echo $rf_id_gt_result['name']; ?></td>-->
                                <td><a href="downline-tree.php?sr=<?php echo $row['ref_id']; ?>" target="_blank"><?php echo $row['user_id']; ?></a></td>
                                <td><?php echo $row['ref_id']; ?></td>
                             
                                <td><?php echo $row['percent_amt']; ?>%</td>
                                <td><?php echo $row['income_level']; ?></td>
                              
                                <td><?php echo $row['add_date']; ?></td>
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