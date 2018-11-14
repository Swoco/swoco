<?php
error_reporting(0);
include('../inc/dbase.php');
if(!isset($_SESSION))
{
	session_start();
}
$user = $_SESSION['ref_idsignup'];

$current_token=mysqli_query($con,"SELECT * FROM `milkyway_icocoin` where status='1'");
$current_token_price=mysqli_fetch_array($current_token);
$token_price=$current_token_price['unit_coin_prc'];
$sell_phase=$current_token_price['id'];

$sell_token_phase=mysqli_query($con,"select * from sell_token where sell_phase<'".$current_token_price['id']."' and user_id='".$_SESSION['user_id']."' and sell_status='0'");
while($row=mysqli_fetch_array($sell_token_phase))
{
    if($row['day']<=7)
    {
      // echo '1';
    }
    else
    {
  $gt_inv_type = '';
  $gt_inv_type_amt = '';
  $gt_temp_date = date('Y-m-d h:i:s');
  $gt_add_date = date('Y-m-d h:i:s');
  $date=date('Y-m-d h:i:s');
  $ref_date = date('Y-m-d h:i:s');
  $gt_se_id = session_id();
  $gt_user_id = $_SESSION['user_id'];
   $login_ck = 'user';
  $gt_user_email = $_SESSION['email'];
  $user = $_SESSION['ref_idsignup'];
  $gt_total_prc=$row['sell_token']*$token_price;
  mysqli_query($con,"update sell_token set sell_status='1' where sell_phase<'".$current_token_price['id']."' and user_id='".$_SESSION['user_id']."' and day>7 and sell_token>0");
      // mysqli_query($con,"update milkway_userpay_list set qnty='".$row['sell_token']."' where ord_id='".$row['order_id']."' and phase_mode='".$row['sell_phase']."'and user_id='".$_SESSION['user_id']."' and remarks='SELL MARKET'");
       	$insert_pay_record_qry = mysqli_query($con, "INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`user_id`,`user_rf_id`,`mode`,`user_email`,`verify_number`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`inv_type_amt`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,remarks,`pay_via_panel`,`pay_datetime`) 
      	VALUES ('".$gt_se_id."','','".$gt_user_id."','".$user."','".$login_ck."','".$gt_user_email."','','".$row['order_id']."','".$row['sell_token']."','".$token_price."','".$gt_total_prc."', '', '','". $sell_phase."','".$gt_inv_type."','".$gt_inv_type_amt."','unpaid','','".$gt_temp_date."','".$gt_add_date."','success','RETURN SELL MARKET','','$gt_add_date')");
    }
}
$direct_user=mysqli_query($con,"SELECT count(id) as direct FROM `milkyway_usersignup` where link_reference_id='".$_SESSION['ref_idsignup']."'");
$direct_user_no=mysqli_fetch_array($direct_user);
$direct_u=$direct_user_no['direct'];

$level=mysqli_query($con,"SELECT sum(percent_amt_qty)as levelincome FROM `milkyway_level__income` where user_id='".$user."' and pay_status='success'");
$level_income=mysqli_fetch_array($level);
//echo '<script>alert("'.$level_income['levelincome'].'");</script>';
$reinvest=mysqli_query($con,"SELECT sum(token)as token ,sum(total_token)as amount FROM `reinvestment_token` where user_id='".$_SESSION['user_id']."'");
$reinvest_income=mysqli_fetch_array($reinvest);

$withdraw=mysqli_query($con,"SELECT sum(amount)as token ,sum(btc_amount)as amount FROM `withdraw` where user_id='".$_SESSION['user_id']."' and status='success'");
$withdraw_income=mysqli_fetch_array($withdraw);
$data=mysqli_query($con,"select * from milkway_userpay_list  where user_id='".$_SESSION['user_id']."'");
$data_email=mysqli_fetch_array($data);
$purchase=mysqli_query($con,"SELECT sum(total_price)as token,sum(qnty) as amount FROM `milkway_userpay_list` where user_rf_id='".$user."' and status='success' and remarks in('Buy Token','Pay By Admin','Reinvestment')");
$purchase_amount=mysqli_fetch_array($purchase);

$purchase1=mysqli_query($con,"SELECT sum(total_price)as token,sum(qnty) as amount FROM `milkway_userpay_list` where user_id='".$_SESSION['user_id']."' and remarks='SELL MARKET'");
$purchase_amount1=mysqli_fetch_array($purchase1);

$transfer=mysqli_query($con,"SELECT sum(total_price)as token,sum(qnty) as amount,remarks FROM `milkway_userpay_list` where user_id='".$_SESSION['user_id']."' and remarks='Transfer'");
$transfer_amount1=mysqli_fetch_array($transfer);

$return_sell=mysqli_query($con,"SELECT sum(total_price)as token,sum(qnty) as amount FROM `milkway_userpay_list` where user_id='".$_SESSION['user_id']."' and remarks='RETURN SELL MARKET'");
$return_sell_amount=mysqli_fetch_array($return_sell);

$locked=mysqli_query($con,"SELECT sum(sell_token)as amount FROM `sell_token` where user_id='".$_SESSION['user_id']."' and status='pending' and sell_status='0'");
$locked_amount=mysqli_fetch_array($locked);

// $buy=mysqli_query($con,"SELECT sum(income)as income,sum(token_quantity)as buy FROM `buy_token` where sell_user_id='".$_SESSION['ref_idsignup']."'");
// $buy_amount=mysqli_fetch_array($buy);

$buy=mysqli_query($con,"SELECT sum(qty)as income FROM `upload_purchase_swoco` where sell_user_id='".$_SESSION['ref_idsignup']."'");
$buy_amount=mysqli_fetch_array($buy);

$buy1=mysqli_query($con,"SELECT sum(income)as income,sum(token_quantity)as buy FROM `buy_token` where user_id='".$_SESSION['user_id']."'");
$buy_amount1=mysqli_fetch_array($buy1);

$locked1=$locked_amount['amount']-$buy_amount['buy'];
// $buy2=mysqli_query($con,"SELECT sum(income)as income,sum(token_quantity)as buy FROM `buy_token` where user_id='".$_SESSION['user_id']."'");
// $buy_amount2=mysqli_fetch_array($buy2);

// $final_token=$purchase_amount1['amount']+$buy_amount2['buy'];
// $final_amount=$purchase_amount1['token']+$buy_amount2['income'];

?>
<?php include('../inc/header.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
          <!--<marquee class="marquee_style" alternate="behaivor">If you have any query regarding income click on support tab place your query within 24hr, it will be resolve .</marquee>-->
          <?php
          
$reg_paiduserquery = mysqli_query($con, "SELECT * FROM `milkway_userpay_list` WHERE `status`='success' group by user_id desc");
    $reg_paidusercount = mysqli_num_rows($reg_paiduserquery);


    // unpaid user
    $unpaid_u_arr = array();
    while($row_unpaid_ur = mysqli_fetch_array($reg_paiduserquery))
		{
		$unpaid_u_arr[] = $row_unpaid_ur['user_id'];
		}

	$success_id_res = implode(',',$unpaid_u_arr);

	$user_unpaid_red_query = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` where id NOT IN ($success_id_res)");
	$tota_un_paid_num = mysqli_num_rows($user_unpaid_red_query);
while($unpaid=mysqli_fetch_array($user_unpaid_red_query))
{
   // echo $unpaid['id'].'<br>';
    if ($unpaid['id']==$_SESSION['user_id']){
       
        echo '<marquee class="marquee_style" alternate="behaivor">ICO 1st Phase is on kindly purchase swoco to get benefits.</marquee>';
     
        break;
  
}
}
//   echo '<div class="marquee_style blinking" style="width:100%;text-align:center;">Kindly download your Swoco wallet & update your receiving address to get your swoco address in dashboard  <a class="te_wh" href="https://www.swoco.io/swoco/user/wallet_plus.php"><button type="button" class=" btn btn-success  btn-rounded btn-outline blinking" style="background-color: #0c466d !important;"> Click Here</button></a></div>';


//   $mob_verif_chkquery = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` where id='".$_SESSION['user_id']."'");
//   $row=mysqli_fetch_array($mob_verif_chkquery);
//   if($row['region']=='Asia')
//   {
//         // echo '<marquee class="marquee_style" alternate="behaivor">Achieve  $5000 as direct Joining and win  Thailand trip or $450 as a balance. Reward Program Start From 10th of Aug to 9 of Sep</marquee>';
//   }
          ?>
      </div>
      <div class="content-body">
        <div id="crypto-stats-3" class="row">
         
		 <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-bandcamp  lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>swoco value with <?php if($current_token_price['phase']=='First'){
                    echo 'I';
                    }
                    if($current_token_price['phase']=='Second'){
                    echo 'II';
                    }
                    if($current_token_price['phase']=='Thrid'){
                    echo 'III';
                    }
                    if($current_token_price['phase']=='Fourth'){
                    echo 'IV';
                    }
                    ?> phase</h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4"><?php echo $token_price;?> <i class="fa fa-dollar"></i></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12"> 
                    <canvas id="btc-chartjs" class="height-75 btc-chartjs"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
		 <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-hourglass lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>Buy Swoco</h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4"><?php 
                    if($transfer_amount1['remarks']=='Transfer')
                    {
                       echo number_format(0, 2, '.' ,'');  
                    }
                    else
                    {
                     $a=$purchase_amount['amount']-$purchase_amount1['amount']+$return_sell_amount['amount'];
                    $b=$transfer_amount1['token'];
                    $c=$a-$b;
                  echo number_format($c, 2, '.' ,'');
                    }
                     ?> 
                    <i >swoco</i>
                    </h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="eth-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-money lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>Purchased  </h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4"><?php 
                     if($transfer_amount1['remarks']=='Transfer')
                    {
                       echo number_format(0, 2, '.' ,'');  
                    }
                    else
                    {
            $pur= $purchase_amount['token'];
            //+$reinvest_income['amount'];
                  echo  number_format($pur, 2, '.' ,'');
                    }
            //   echo  number_format(0, 2, '.' ,'')
                    ?>  <i class="fa fa-dollar"></i></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		  
		  <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-signal   lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>Level income </h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4"><?php $level= $level_income['levelincome']-$reinvest_income['amount']-$withdraw_income['token'];
                    
                     echo  number_format($level, 2, '.' ,'');?> <i class="fa fa-dollar"></i></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas  class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		    <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-credit-card   lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4> Market Income  </h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4"><?php $mar=$buy_amount['income']*$token_price;
                     echo  number_format($mar, 2, '.' ,'');
                    ?>  <i class="fa fa-dollar"></i></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		   <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-print   lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>swoco on sell </h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4"><?php $so=$locked1;
                     echo  number_format($so, 2, '.' ,'');
                    ?>
                    <i>swoco</i></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="ltc-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		  
		   <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-male   lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>Direct user</h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4"><?php echo $direct_u;?> <i class="la la-arrow-up"></i></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
            <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-database   lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <!--<h4>Sold Token</h4>-->
                     <h4>Withdraw </h4>
                    </div>
					
                    <div class="col-12 text-center">
                    <!--<h6 class="success darken-4"><?php echo $buy_amount['buy']; ?> <i class="fa fa-gg-circle"></i></h6>-->
                     <h6 class="success darken-4"><?php $wi=$withdraw_income['token'];
                      echo  number_format($wi, 2, '.' ,'');
                     ?>  <i class="fa fa-dollar"></i></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="col-xl-4 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-gg   lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>Reinvestment Swoco  </h4>
                    </div>
					<div class="col-12 text-center">
                    <h6 class="success darken-4"><?php 
                     if($transfer_amount1['remarks']=='Transfer')
                    {
                       echo number_format(0, 2, '.' ,'');  
                    }
                    else
                    {
                    $re=$reinvest_income['token'];
                     echo  number_format($re, 2, '.' ,'');
                     //echo  number_format(0, 2, '.' ,'');
                    }
                    ?> swoco</h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
         
          
		   </div>
     </div>
           <div class="col-xl-12 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h1><i class="fa fa-sticky-note   lighten-1 font-large-2" ></i></h1>
                    </div>
                     <div class="col-12 text-center">
                    <h4>Disclaimer  </h4>
                    </div>
					<div class="col-12 h1_note">
                    <h5>
                        Byu & Sell cryptocurrencies are subject to market, technical and legal risks.  If user loss cryptocurrencies, SWOCO doesn't guarantee any returns. Users use SWOCO at their own risk. Do consult your financial advisor before making any investment decision. SWOCO will not be held responsible for the investment decisions you make based on the information provided on the website.
                    </h5>
                    </div>
                  </div>
                </div>
                  </div>
            </div>
          </div>
          
 
</div>
 </div>
</div>
<marquee class="marquee_style" alternate="behaivor">Dear Users,Due to the overwhelming surge in popularity, Technical team working on important updates. you may face some temporarily disabled  services due to internal upgrade. kindly submit support ticket.our support team will revert within 72 hours. We apologize for any inconvenience caused.
</marquee>
  <?php include('../inc/footer.php');?>
  
   <script src="app-assets/js/jquery.syotimer.min.js"></script>
   <script>
$('.simple_timer').syotimer({
 year: 2018,
 month: 9,
 day: 10,
 hour: 0,
 minute: 0,
});

</script>
<script type="text/javascript">
	$(document).ready(function(){
	//	$("#myplusModal").modal('show');
	});
</script>
 <script type="text/javascript">
$('#overlay').modal('show');
</script>