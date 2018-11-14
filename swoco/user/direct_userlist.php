<?php include('../inc/header.php');?>
<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}

$ref_idst = $_SESSION['ref_idsignup'];

$query = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `link_reference_id`= '".$ref_idst."' ORDER BY id ASC");

?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Direct User List</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
               
                <li class="breadcrumb-item active">Direct User List
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
                   
                    <table class="table table-striped table-bordered file-export" >
                      <thead>
                         <tr style="background-color:#5f76bb;color:#fff;">
                            <th>SNo</th>
                            <th>User Id</th>
                          <th>Name</th>
                          <th>Email Id</th>
                          <th>Mobile No</th>
                          <th>Date</th>
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
                                <td><?php echo $row['reference_id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                               <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                               
                           
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