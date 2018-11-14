<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');

if(!isset($_SESSION))
{
session_start();
}

if(isset($_SESSION['adm_email']) == '') 
   {
        header("location:index.php");
    }  

    $uiu_id = $_GET['id'];

    $user_get_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE id='$uiu_id'");
    $user_get_result = mysqli_fetch_array($user_get_qry);

    $sql = "SELECT sum(qnty) AS t_qnty, sum(total_price) AS t_total_price FROM `milkway_userpay_list` WHERE user_id='".$uiu_id."' AND `status`='pending'";
    $query = mysqli_query($con, $sql);
    $result_response = mysqli_fetch_array($query);
 $sql2 = "SELECT * FROM `milkway_userpay_list` WHERE user_id='".$uiu_id."' AND `status`='pending' order by pay_datetime desc";
    $query2 = mysqli_query($con, $sql2);
    
    $buy=mysqli_query($con,"SELECT sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$uiu_id."'");
$buy_amount=mysqli_fetch_array($buy);


$level=mysqli_query($con,"SELECT sum(percent_amt_qty)as levelincome FROM `milkyway_level__income` where user_id='".$user_get_result['reference_id']."' and pay_status='pending'");
$level_income=mysqli_fetch_array($level);
?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">User Summary</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">User Summary List
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="user-list-summary">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">User Summary</h4>
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
<tr>
<th>Name</th>
<th>Email</th>
<th>Contact</th>
<th>Swoco Qty</th>
<th>Purchase Amount($)</th>
<th>Income</th>
<th>Level Income</th>
</tr>                              
                           </tr>
                      </thead>
                      <tbody>
                           <tr>
                          
                         <td><?php echo $user_get_result['name']; ?></td>
                          <td><?php echo $user_get_result['email']; ?></td>
                           <td><?php echo $user_get_result['contact']; ?></td>
                          <td><?php echo $result_response['t_qnty']; ?></td>
                          <td><?php echo number_format((float)$result_response['t_total_price'], 4, '.', ''); ?></td>
                          <td><?php echo $buy_amount['buy'];?></td>
                        <td><?php echo $level_income['levelincome'];?></td>
                           <td></td>
                        </tr>
                      </tbody>   
                       
                        
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        
        
        <!--/ Language - Comma decimal place table -->
      </div>
    </div>
  </div>
 <?php include('inc/footer.php');?>