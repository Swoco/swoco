<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  

    ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">All Ticket</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">All Ticket
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
                  
                    
                      <?php
                                                    if (@$_REQUEST['status'] == 'Open') {
                                                        ?>

                                                        <table class="table table-striped table-bordered file-export">
 <thead>

                                                                <tr>
                                                                    <th>Action</th>
                                                                    <th>Name</th>
                                                                    <th>Subject</th>
                                                                    <th>Status</th>
                                                                    <th>Last Updated</th>

                                                                </tr>

                                                            </thead>

                                                            <tbody>

                                                                <?php
                                                                $select_ticket123 = mysqli_query($con,"select * from `create_ticket` where `close_ticket`='0' order by reply_status asc,last_update_date desc");
                                                                while ($display_ticket123 = mysqli_fetch_array($select_ticket123)) {

                                                                    $count_new_ticket123 = mysqli_query($con,"select * from `ticket_reply` where ticket_number='" . $display_ticket123['ticket_number'] . "' and  `notification_status`='2' order by ticket_id desc");

                                                                    $select_username = mysqli_query($con,"select * from `milkyway_usersignup` where `id`='" . $display_ticket123['user_id'] . "'");
                                                                    $display_username = mysqli_fetch_array($select_username);
                                                                    ?>

                                                                    <tr>
                                                                        <td><a href="all_view_support_ticket.php?ticket-number=<?php echo $display_ticket123['ticket_number']; ?> " target="_blank" title="Send Reply" style="color:green;text-decoration: underline">Reply</a></td>
                                                                        <td><?php echo $display_username['name'] . " (" . $display_username['id'] . ")"; ?></td>
                                                                        <td><a href="all_view_support_ticket.php?ticket-number=<?php echo $display_ticket123['ticket_number']; ?> " target="_blank" style="color:green;text-decoration: underline"> #<?php echo $display_ticket123['ticket_number']; ?> - <?php echo $display_ticket123['subject']; ?> </a></td>
                                                                        <td>
                                                                            <?php
                                                                            if ($display_ticket123['reply_status'] == '0') {
                                                                                ?>

                                                                                Pending <span class="badge vd_bg-red"><?php echo mysqli_num_rows($count_new_ticket123); ?></span>
                                                                                <?php
                                                                            } else if ($display_ticket123['reply_status'] == '1') {
                                                                                ?>
                                                                                Answered  
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                        <td data-title="Last Updated" class="numeric" style="text-align: center"><?php echo $display_ticket123['last_update_date']; ?></td>
                                                                    </tr>                                               
                                                                    <?php
                                                                }
                                                                ?>


                                                            </tbody>
                                                        </table>

                                                        <?php
                                                    } else if (@$_REQUEST['status'] == 'Close') {
                                                        ?>
                                                        <table class="table table-striped" id="tabledata">

                                                            <thead>

                                                                <tr>

                                                                    <th>Reply</th>

                                                                    <th>Name</th>
                                                                    <th>Subject</th>
                                                                    <th>Status</th>
                                                                    <th>Last Updated</th>
                                                                    <th>Open Date</th>
                                                                    <th>Close Date</th>

                                                                </tr>

                                                            </thead>

                                                            <tbody>

                                                                <?php
                                                                $select_ticket123 = mysqli_query($con,"select * from `create_ticket` where `close_ticket`='1' order by ticket_id desc");
                                                                while ($display_ticket123 = mysqli_fetch_array($select_ticket123)) {

                                                                    $select_username = mysqli_query($con,"select * from `milkyway_usersignup` where `id`='" . $display_ticket123['user_id'] . "'");
                                                                    $display_username = mysqli_fetch_array($select_username);
                                                                    ?>

                                                                    <tr>

                                                                        <td><a href="all_view_support_ticket.php?ticket-number=<?php echo $display_ticket123['ticket_number']; ?> " target="_blank" title="View Reply" style="color:green;text-decoration: underline">View</a></td>



                                                                        <td><?php echo $display_username['name'] . " (" . $display_username['id'] . ")"; ?></td>
                                                                        <td><a href="all_view_support_ticket.php?ticket-number=<?php echo $display_ticket123['ticket_number']; ?> " target="_blank" style="color:green;text-decoration: underline"> #<?php echo $display_ticket123['ticket_number']; ?> - <?php echo $display_ticket123['subject']; ?> </a></td>
                                                                        <td>
                                                                            <?php
                                                                            if ($display_ticket123['reply_status'] == '0') {
                                                                                ?>

                                                                                Pending
                                                                                <?php
                                                                            } else if ($display_ticket123['reply_status'] == '1') {
                                                                                ?>
                                                                                Answered  
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                        </td>
                                                                        <td data-title="Last Updated" class="numeric" style="text-align: center"><?php echo $display_ticket123['last_update_date']; ?></td>
                                                                        <td><?php echo $display_ticket123['generate_date']; ?></td>
                                                                        <td><?php echo $display_ticket123['close_date']; ?></td>
                                                                    </tr>                                               
                                                                    <?php
                                                                }
                                                                ?>


                                                            </tbody>
                                                        </table>

                                                        <?php
                                                    }
                                                    ?>
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