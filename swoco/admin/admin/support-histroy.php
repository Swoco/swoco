<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
 $date = date('Y-m-d G:i:s');
$query = mysqli_query($con, "SELECT * FROM `milkyway_usersupport` WHERE support_status='pending' GROUP BY `ticket_no` ORDER BY `id` desc");

$query1 = mysqli_query($con, "SELECT * FROM `milkyway_usersupport` WHERE support_status !='pending' ORDER BY `id` desc");

?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Support History</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item active">Support History
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
                                <th>No</th>
                                 <th>User Id</th>
                                 <th>User Email</th>
                                <th>Ticket</th>
                             
                                <th>Subject</th>
                                <th>Message</th>
                                 <th>Status</th>
                                <th>Add Date</th>
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
                                $u_get_id = $row['user_id'];
                                $user_record_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `id`='".$u_get_id."'");
                                $user_record_result = mysqli_fetch_array($user_record_qry);
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $user_record_result['email']; ?></td> 
                                <td><?php echo $row['ticket_no']; ?></td>
                              <!--   <td><?php echo $row['order_date']; ?></td> -->
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['msg']; ?></td>
                                <td><?php echo $row['support_status']; ?></td>
                                <td><?php echo $row['user_add_date']; ?></td>
                               <th><a href="user_support_history_admin.php?idrss=<?php echo $row['id']; ?>">View</a></th>
                            </tr>
                            <?php $cnt++; } } ?>
							<?php
							 if(mysqli_num_rows($query1) > 0)
                            {
                            $cnt1 = $cnt;
                            while($row = mysqli_fetch_array($query1)) 
                            {  
                                $u_get_id = $row['user_id'];
                                $user_record_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `id`='".$u_get_id."'");
                                $user_record_result = mysqli_fetch_array($user_record_qry);
                            ?>
                            <tr>
                                <td><?php echo $cnt1; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $user_record_result['email']; ?></td> 
                                <td><?php echo $row['ticket_no']; ?></td>
                              <!--   <td><?php echo $row['order_date']; ?></td> -->
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['msg']; ?></td>
                                <td><?php echo $row['support_status']; ?></td>
                                <td><?php echo $row['user_add_date']; ?></td>
                               <th><a href="user_support_history_admin.php?idrss=<?php echo $row['id']; ?>">View</a></th>
                            </tr>
                            <?php $cnt1++; } } ?>
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