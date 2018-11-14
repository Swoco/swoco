<?php include('inc/header.php');?>
<?php
error_reporting(0);
include('inc/dbase.php');
include('inc/checker.php');
session_start();
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
    $coin_status = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE `status`='1'");
$coin_status1 = mysqli_fetch_array($coin_status);
//  $sql_history = "SELECT * FROM `buy_token` where status='Pending' ORDER BY `id` desc";
 $sql_history = "SELECT * FROM `upload_purchase_swoco`  where qty!=0 and status='pending'  ORDER BY `id` desc";
  $query = mysqli_query($con, $sql_history);
  
  if(isset($_GET['page_nm']) && ($_GET['page_nm'] == 'pay_btc'))
{
	$id = $_GET['id'];
	$upadte_prev_status = mysqli_query($con, "UPDATE `upload_purchase_swoco` SET `status`= 'Done' Where id = '".$id."'");

	header('location:buy_list.php');
}

//   function convert_btc($qty,$price)
// 	{

// 	$usdamount=$qty*$price;
// 	//$url ="https://api.blockchain.info/stats";
// 	$url ="https://apiv2.bitcoinaverage.com/convert/global?from=USD&to=BTC&amount=".$usdamount;
// 	$ch = curl_init($url);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 	curl_setopt($ch, CURLOPT_POST, 0);
// 	curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	$output = curl_exec($ch);
// 	curl_close($ch);
// 	$amount = json_decode($output, true);
// 	//print_r($amount);
// 	$amt= number_format((float)$amount['price'], 8, '.', ''); 
// 	echo $amt;	

// 	}
// 	 function convert_btcwithfee($qty,$price)
// 	{

// 	$usdamount=$qty*$price;
// 		$fee='0.5';
// 	$a=$usdamount-$fee;
// 	//$url ="https://api.blockchain.info/stats";
// 	$url ="https://apiv2.bitcoinaverage.com/convert/global?from=USD&to=BTC&amount=".$a;
// 	$ch = curl_init($url);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 	curl_setopt($ch, CURLOPT_POST, 0);
// 	curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	$output = curl_exec($ch);
// 	curl_close($ch);
// 	$amount = json_decode($output, true);
// 	//print_r($amount);

// 	$amt= number_format((float)$amount['price'], 8, '.', ''); 
// //	$amt1 = $amt-$fee; 
// 	echo $amt;	

// 	}
    ?>
     <script>

        function changicoStatus(ir)

        {

            var xr = confirm('Are You Sure You Want to Pay BTC  ?');



            if(xr)

            {

                window.location.href='pay_btc.php?page_nm=pay_btc&id='+ir;

            }

            else

            {

                 return false;

            }



        }

    </script>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12  breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Swoco Market Buy</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
              
                <li class="breadcrumb-item active">Swoco Market Buy
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
                                 <th>Sell User Id</th>
                                  <th>Buy User Id</th>
                                 <th>Swoco Quantity</th>
                                 <th>Amount USD</th>
                                <th>BTC Amount</th>
                                  <!--<th>Pay BTC</th>-->
                                   <th>BTC Address</th>
							     <th>Status</th>
                                <th>Buy Date</th>
                                <th>Action</th>

							   
                        </tr>
                      </thead>
                      <tbody>
                           <?php
                            $cnt = 1;
                            while($row = mysqli_fetch_array($query)) 
                            {  $sql=mysqli_query($con,"select * from milkyway_usersignup where reference_id='".$row['sell_user_id']."'");
                            $row1=mysqli_fetch_array($sql);
                                 ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['order_id']; ?></td>
                                 <td><?php echo $row['sell_user_id']; ?></a></td>
                                <td><?php echo $row['buy_user_id']; ?></td>
                                  <td><?php echo $row['qty']; ?></td>
                                   <td><?php echo $row['income']; ?></td>
                                  <td><?php echo $row['btc_amount'];;?></td>
                                  
                                   <td><?php echo $row1['bitcoin_wallet_address'];?></td>
                               <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                 <td>
                                     <?php if($row['status']=='pending'){?>
                               <a href="javascript:void(0)" style="color:blue;"   onclick="return changicoStatus(<?php echo $row['id']; ?>);">Pay BTC</a>
                                   <?php  }
                                     else
                                     {
                                        echo '<a href="javascript:void(0)" style="color:blue;" >Pay BTC</a>';
                                     
                                     }?>
                                     </td>
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