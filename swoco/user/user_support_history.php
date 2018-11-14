<?php
error_reporting(0);
include('../inc/dbase.php');

if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}

$ur_id = $_SESSION['user_id'];
$query = mysqli_query($con, "SELECT * FROM `milkyway_usersupport` WHERE `user_id`= '".$ur_id."' AND `status`='1' ORDER BY `id` desc");

?>
<?php include('../inc/header.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">SUPPORT TICKET HISTORY</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Support Ticket</a>
                </li>
                <li class="breadcrumb-item active">Support Ticket History
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
       <!-- Complex headers table -->
        <section id="headers">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"></h4>
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
                    
                    <table class="table table-striped table-bordered complex-headers">
                      <thead>
                       
                        <tr>
                   <th>No</th>
                                <th>Ticket</th>
                                <th>Subject</th>
                                <th>Message</th>
                                
                                <th>Add Date</th>
                                  <th>Current Status</th>
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
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['ticket_no']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['msg']; ?></td>
                                
                                <td><?php echo $row['user_add_date']; ?></td>
                                <?php if( $row['support_status']=='complete'){
                                 ?>
                                 <td style="color:green;"><?php echo $row['support_status'];?></td>
                                 
                                 <?php
                                }
                                  else
                                  {
                                      ?>
                                       <td style="color:red;"><?php echo $row['support_status'];?></td>
                                
                                      <?php
                                  }
                                  ?>
                                 
                               <td><a href="user_support_history_st.php?idrt=<?php echo $row['ticket_no']; ?>">View</a></td>


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
        <!--/ Complex headers table -->
       
        
        
        <!--/ Language - Comma decimal place table -->
      </div>
    </div>
  </div>
 <?php include('../inc/footer.php');?>