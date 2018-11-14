<?php include('../inc/header.php');?>
<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}
$ref_ur_id = $_SESSION['ref_idsignup'];
//echo '<script>alert("'.$ref_ur_id.'");</script>';
?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Level Income </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                
                <li class="breadcrumb-item active">Level Income 
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="file-export-plus">
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
                                <th>Income Level</th>
                               <th>Total User</th>
                               <th>Action</th>
              
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            	for($cnt = 1; $cnt<=10; $cnt++)
                            	{
                            	$totalcount_inc_query = mysqli_query($con, "SELECT * FROM `milkyway_level__income` WHERE `user_id`= '".$ref_ur_id."' AND `income_level`='$cnt' AND `pay_status`='success'");
                            	$totalcount_res = mysqli_num_rows($totalcount_inc_query);
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                  <td><?php echo 'LEVEL '.$cnt; ?></td>
                                  <td><?php echo $totalcount_res; ?></td>
                                    <td><a href="income_level_history.php?level=<?php echo $cnt; ?>" target="_blank" class="btn btn-success mr-10">Level History</a></td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- File export table -->
         </div>
    </div>
  </div>
 <?php include('../inc/footer.php');?>