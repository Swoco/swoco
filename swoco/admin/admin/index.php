 <?php include('inc/header.php');?>
 <?php
error_reporting(0);
include('inc/dbase.php');

if(isset($_SESSION['adm_email']) == '') {
        header("location:login.php");
    }  

    $today_date = date('Y-m-d');
$total_admin=mysqli_query($con,"SELECT * FROM `milkyway_adminassigncoin`");
$total_admin_coin=mysqli_fetch_array($total_admin);

     $coin_dist_unit_qry = mysqli_query($con, "SELECT * FROM `milkyway_icocoin` WHERE `status`='1'");
    $coin_dist_unit_result = mysqli_fetch_array($coin_dist_unit_qry);
    
    $swocomarket=mysqli_query($con,"SELECT sum(update_sell_token)as total FROM `sell_token` where sell_status='0'  ");
    $totalswocomarket=mysqli_fetch_array($swocomarket);
    
    $swocomarketpen=mysqli_query($con,"SELECT sum(sell_token)as total FROM `sell_token` where sell_status='0' ");
    $totalswocomarketpen=mysqli_fetch_array($swocomarketpen);
    
    $swocomarketbuy=mysqli_query($con,"SELECT sum(qty)as total FROM `upload_purchase_swoco` where status='pending' ");
    $totalswocomarketbuy=mysqli_fetch_array($swocomarketbuy);
    
    
    
      $reg_userquery = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` where reference_id !='02563286649209' order by id desc");
    $reg_usercount = mysqli_num_rows($reg_userquery);
     $reg_useractive = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` where  reference_id!='02563286649209' and  status='1' order by id desc");
    $reg_activecount = mysqli_num_rows($reg_useractive);
    
     $reg_today_businessquery = mysqli_query($con, "SELECT sum(`total_price`) AS tprce,sum(qnty) as quantity,sum(total_price/unit_price) as token FROM `milkway_userpay_list` WHERE `status`='success' and `added_date` like '%$today_date%'");
    $reg_today_business_count = mysqli_fetch_array($reg_today_businessquery);

      $reg_allpay_businessquery = mysqli_query($con, "SELECT sum(`total_price`) AS totalprce,sum(qnty) as quantity,sum(total_price/unit_price) as token FROM `milkway_userpay_list` WHERE `status`='success' ");
    $reg_allpay_business_count = mysqli_fetch_array($reg_allpay_businessquery);
    
    
      $reg_allpay_businessquery1 = mysqli_query($con, "SELECT sum(`total_price`) AS totalprce,sum(qnty) as quantity,sum(total_price/unit_price) as token FROM `milkway_userpay_list` WHERE `status`='success' and remarks='Buy Token' ");
    $reg_allpay_business_count1 = mysqli_fetch_array($reg_allpay_businessquery1);
    
     $buy_admin = mysqli_query($con, "SELECT sum(`total_price`) AS totalprce,sum(qnty) as quantity,sum(total_price/unit_price) as token FROM `milkway_userpay_list` WHERE `status`='success' and remarks='Pay By Admin' ");
    $buy_admin1 = mysqli_fetch_array($buy_admin);
    
    
    $locked=mysqli_query($con,"SELECT sum(sell_token)as amount FROM `sell_token` where status='Pending' and sell_status='0' ");
$locked_amount=mysqli_fetch_array($locked);


$buy=mysqli_query($con,"SELECT sum(income)as income,sum(token_quantity)as buy FROM `buy_token`");
$buy_amount=mysqli_fetch_array($buy);

$reinvest = mysqli_query($con, "SELECT SUM(total_token)as amount,SUM(token) as qunty FROM `reinvestment_token`");
$reinvest_admin=mysqli_fetch_array($reinvest);

$withdraw = mysqli_query($con, "SELECT sum(amount)as amount FROM `withdraw`");
$withdraw_admin=mysqli_fetch_array($withdraw);



$locked1=$locked_amount['amount']-$buy_amount['buy'];
    ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <div class="row">
					
						  <div class="col-md-4">
						  <div class="panel panel-default card-view pa-0">
						      	
							<div class="panel-wrapper ">
								
									<div class="sm-data-box">
										<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
										    	<div class="fa_size">	<i class="fa fa-bandcamp data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												<span class="weight-500 uppercase-font block font-13"><?php echo $coin_dist_unit_result['phase'];?> Phase | SWOCO</span>
											    <span class="txt-dark block counter"><span class="counter-anim"><?php echo $coin_dist_unit_result['unit_coin_prc'];?></span>$</span>
												
											
													
												</div>
									</div>
								
							</div>
						</div>
						
                      </div>
					    <div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper ">
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
												    	<div class="fa_size"><i class="fa fa-users data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    		<span class="weight-500 uppercase-font block font-13">Total User</span>
													<span class="txt-dark block counter"><span class="counter-anim"><?php echo  $reg_usercount;?></span></span>
												
												
												</div>
								</div>
								
								
								
								

							</div>
						</div>
                      </div>
                      <div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													<div class="fa_size"><i class="fa fa-user data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
														<span class="weight-500 uppercase-font block font-13">Active User</span>
													<a href="paid_user_detail.php"><span class="txt-dark block counter"><span class="counter-anim"><?php echo $reg_activecount;?></span></span></a>
												
												
												
												</div>
											
									
							
							</div>
						</div>
						</div>
	<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													
														<div class="fa_size"><i class="fa fa-database data-right-rep-icon txt-light-grey" aria-hidden="true"></i>
												</div>
													<span class="weight-500 uppercase-font block font-13">Purchase Amount By Gateway</span>
													
													<span class="txt-dark block counter"><span class="counter-anim">$ 
													<?php   if( $reg_allpay_business_count1['totalprce']==NULL)
													{
													    echo '0';
													}
													else
													{
													   echo  $reg_allpay_business_count1['totalprce'];
													}?></span> 
													
													</span></span>
												
												
												</div>
												
													
												
											
								
								</div>
							
						</div>
						</div>
							
	<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													
														<div class="fa_size"><i class="fa fa-database data-right-rep-icon txt-light-grey" aria-hidden="true"></i>
												</div>
													<span class="weight-500 uppercase-font block font-13">Purchase Amount By Admin</span>
													
													<span class="txt-dark block counter"><span class="counter-anim">$ 
													<?php   if( $buy_admin1['totalprce']==NULL)
													{
													    echo '0';
													}
													else
													{
													   echo  $buy_admin1['totalprce'];
													}?></span> 
													
													</span></span>
												
												
												</div>
												
													
												
											
								
								</div>
							
						</div>
						</div>
							<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													
														<div class="fa_size"><i class="fa fa-database data-right-rep-icon txt-light-grey" aria-hidden="true"></i>
												</div>
													<span class="weight-500 uppercase-font block font-13">Total Purchase Amount</span>
													
													<span class="txt-dark block counter"><span class="counter-anim">$
													<?php   if( $reg_allpay_business_count1['totalprce']==NULL)
													{
													    echo '0';
													}
													else
													{
													    echo  $reg_allpay_business_count1['totalprce']+$buy_admin1['totalprce'];
													}?></span> 
													
													</span></span>
												
												
												</div>
												
													
												
											
								
								</div>
							
						</div>
						</div>

	<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													
														<div class="fa_size"><i class="fa fa-database data-right-rep-icon txt-light-grey" aria-hidden="true"></i>
												</div>
													<span class="weight-500 uppercase-font block font-13">Reinvestment Purchase Amount</span>
													
													<span class="txt-dark block counter"><span class="counter-anim">$
													<?php   if( $reinvest_admin['amount']==NULL)
													{
													    echo '0';
													}
													else
													{
													    echo  $reinvest_admin['amount'];
													}?></span> 
													
													</span></span>
												
												
												</div>
												
													
												
											
								
								</div>
							
						</div>
						</div>
						<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													
														<div class="fa_size"><i class="fa fa-database data-right-rep-icon txt-light-grey" aria-hidden="true"></i>
												</div>
													<span class="weight-500 uppercase-font block font-13">Reinvestment Swoco Qunatity</span>
													
													<span class="txt-dark block counter"><span class="counter-anim">
													<?php   if( $reinvest_admin['qunty']==NULL)
													{
													    echo '0';
													}
													else
													{
													    echo  $reinvest_admin['qunty'];
													}?></span> 
													
													</span></span>
												
												
												</div>
												
													
												
											
								
								</div>
							
						</div>
						</div>
							<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													
														<div class="fa_size"><i class="fa fa-database data-right-rep-icon txt-light-grey" aria-hidden="true"></i>
												</div>
													<span class="weight-500 uppercase-font block font-13">Total Swoco Qunatity</span>
													
													<span class="txt-dark block counter"><span class="counter-anim">
													<?php   if( $reg_allpay_business_count1['token']==NULL)
													{
													    echo '0';
													}
													else
													{
													    echo  $reg_allpay_business_count1['quantity']+$buy_admin1['quantity'];
													   // echo $reg_allpay_business_count['token'];
													}?></span> 
													
													</span></span>
												
												
												</div>
												
													
												
											
								
								</div>
							
						</div>
						</div>
					
						<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
													
														<div class="fa_size"><i class="fa fa-database data-right-rep-icon txt-light-grey" aria-hidden="true"></i>
												</div>
													<span class="weight-500 uppercase-font block font-13">Withdraw Purchase Amount</span>
													
													<span class="txt-dark block counter"><span class="counter-anim">$
													<?php   if( $withdraw_admin['amount']==NULL)
													{
													    echo '0';
													}
													else
													{
													    echo  $withdraw_admin['amount'];
													}?></span> 
													
													</span></span>
												
												
												</div>
												
													
												
											
								
								</div>
							
						</div>
						</div>
						
					
						
							<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
												    
												    	<div class="fa_size"><i class="fa fa-print data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    <span class="weight-500 uppercase-font block font-13">Total Locked Token</span>
												    
													<span class="txt-dark block counter"><span class="counter-anim"><?php echo $locked1; ?></span> </span>
													
													
												
												</div>
							</div>
						</div>
						</div>
						
							
						<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
												    
												    <div class="fa_size"><i class="fa fa-google-wallet data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    <span class="weight-500 uppercase-font block font-13">Web Wallet</span>
													<span class="txt-dark block counter"><span class="counter-anim">0.0000</span> $ </span>
													
													
													</div>
												</div>	
							</div>
						</div>
						
											<div class="col-md-12 text-center"><h2 style="font-size: 32px;
    font-weight: bold;
    background-color: #0b3e60;
    color: wheat;
    margin-bottom: 10px;">Total ICO  Swoco Token</h2></div>	
						
						
							<div class="col-md-6">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-12 text-center pl-0 pr-0 data-wrap-left">
												    
												    <div class="fa_size"><i class="fa fa-google-wallet data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    <span class="weight-500 uppercase-font block font-13">Total Swoco Token </span>
													<span class="txt-dark block counter"><span class="counter-anim"><?php echo $total_admin_coin['total_coin_qty']; ?></span>  </span>
													
													
													</div>
												</div>	
							</div>
						</div>
						
						<div class="col-md-6">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-12 text-center pl-0 pr-0 data-wrap-left">
												    
												    <div class="fa_size"><i class="fa fa-google-wallet data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    <span class="weight-500 uppercase-font block font-13">Total Available Token</span>
													<span class="txt-dark block counter"><span class="counter-anim"><?php  
											
													  echo  $total_admin_coin['totalcoin'];
											
													?></span> </span>
													
													
													</div>
												</div>	
							</div>
						</div>
						
						
						
						<div class="col-md-12 text-center"><h2 style="font-size: 32px;
    font-weight: bold;
    background-color: #0b3e60;
    color: wheat;
    margin-bottom: 10px;">SWOCO MARKET</h2></div>	
						
						
							<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
												    
												    <div class="fa_size"><i class="fa fa-google-wallet data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    <span class="weight-500 uppercase-font block font-13">Total Swoco Sell Qunatity</span>
													<span class="txt-dark block counter"><span class="counter-anim"><?php echo $totalswocomarket['total']; ?></span>  </span>
													
													
													</div>
												</div>	
							</div>
						</div>
						
						<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
												    
												    <div class="fa_size"><i class="fa fa-google-wallet data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    <span class="weight-500 uppercase-font block font-13">Total Swoco Buy Qunatity</span>
													<span class="txt-dark block counter"><span class="counter-anim"><?php  if($totalswocomarketbuy['total']==NULL)
													{
													    echo '0';
													}
													else
													{
													  echo  $totalswocomarketbuy['total'];
													}; ?></span> </span>
													
													
													</div>
												</div>	
							</div>
						</div>
							<div class="col-md-4">
						<div class="panel panel-default card-view pa-0">
							
								
									<div class="sm-data-box">
										
												<div class="col-xs-8 text-center pl-0 pr-0 data-wrap-left">
												    
												    <div class="fa_size"><i class="fa fa-google-wallet data-right-rep-icon txt-light-grey" aria-hidden="true"></i></div>
												    <span class="weight-500 uppercase-font block font-13">Total Swoco Pending Qunatity</span>
													<span class="txt-dark block counter"><span class="counter-anim"><?php echo $totalswocomarketpen['total']; ?></span>  </span>
													
													
													</div>
												</div>	
							</div>
						</div>
						
				
	</div>	
					</div>
        <!-- Candlestick Multi Level Control Chart -->
      </div>
	  </div>
  </div>
  <?php include('inc/footer.php');?>
 