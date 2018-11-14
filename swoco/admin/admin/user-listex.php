<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();

    ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">User List</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">User List
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
                          <th>SNo</th>
<th>User Id</th>
<th>Name</th>
<th>Email</th>
<th>Contact no</th>
<th>Referral Id</th>
<th>Bitcoin Address</th>
<th>Swoco Address</th>
<th>Status</th>
<th>Created date</th>
<th>Payment</th>
						  
                        </tr>
                      </thead>
                      <tbody>
                         <?php
$sql=mysqli_query($con,"SELECT * FROM `milkyway_usersignup` WHERE reference_id!='02563286649209'  ORDER BY `id` desc ");
$i=1;
while($row=mysqli_fetch_array($sql))
{
    if($row['link_reference_id']==''){
        $refer='No Referral';
    }
    else
    {
        $refer=$row['link_reference_id'];
    }
                          
                          ?>
                       <tr>
                           <td><?php echo $i;?></td>
                           <td><?php echo $row['reference_id'];?></td>
                            <td><?php echo $row['name'];?></td>
                           <td><?php echo $row['email'];?></td>
                           <td><?php echo $row['contact'];?></td>
                           <td><?php echo $refer;?></td>
                             <td><?php echo $row['bitcoin_wallet_address'];?></td>
                               <td><?php echo $row['swoco_wallet_address'];?></td>
                            <?php if($row['status']==1){?>
                           <td style="color:green;"><?php echo "Verifed"?></td>
                           <?php }
                           else
                           {
                           ?>
                           <td style="color:red;"><?php echo "Not Verify"?></td>
                           <?php }?>
                            <td><?php echo $row['date'];?></td>
                            <td><a href="buy-coin-admin.php?idt=<?php echo $row['id']; ?>&iem=<?php echo $row['email']; ?>" style="color:blue;" target="_blank">Pay</a></td>

                       </tr>
                       <?php
                       $i++;}?>
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