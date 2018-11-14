<?php  include('../inc/header.php');?>
<?php
include '../inc/dbase.php';
 $user = $_SESSION['ref_idsignup'];
// $user_token=mysqli_query($con,"select sum(total_price)as price,phase_mode from milkway_userpay_list where user_id='".$_SESSION['user_id']."'");
// $user_token_price=mysqli_fetch_array($user_token);
// $price=$user_token_price['price']*10/100;

$purchase=mysqli_query($con,"SELECT sum(total_price)as token,sum(qnty) as amount FROM `milkway_userpay_list` where user_rf_id='".$user."' and status='success' and remarks in('Buy Token','Pay By Admin','Reinvestment')");
$purchase_amount=mysqli_fetch_array($purchase);

$purchase1=mysqli_query($con,"SELECT sum(total_price)as token,sum(qnty) as amount FROM `milkway_userpay_list` where user_id='".$_SESSION['user_id']."' and remarks='SELL MARKET'");
$purchase_amount1=mysqli_fetch_array($purchase1);

$return_sell=mysqli_query($con,"SELECT sum(total_price)as token,sum(qnty) as amount FROM `milkway_userpay_list` where user_id='".$_SESSION['user_id']."' and remarks='RETURN SELL MARKET'");
$return_sell_amount=mysqli_fetch_array($return_sell);

$user_token1=mysqli_query($con,"select * from milkway_userpay_list where user_id='".$_SESSION['user_id']."' and remarks='Buy Token' and status='success'");
$user_token_price1=mysqli_fetch_array($user_token1);

$buy_phase=$user_token_price1['phase_mode'];

$sell_percent=mysqli_query($con,"select * from sell_percent");
$sell_per_value=mysqli_fetch_array($sell_percent);

$show_phase=mysqli_query($con,"SELECT * FROM `milkyway_icocoin` where status='1'");
$show_phase_value=mysqli_fetch_array($show_phase);
$phase_val=$show_phase_value['unit_coin_prc'];
$activedate=$show_phase_value['start'];
$percent=$sell_per_value['percent'];
function howDays($from, $to) {
    $first_date = strtotime($from);
    $second_date = strtotime($to);
    $offset = $second_date-$first_date; 
    return floor($offset/60/60/24);
}
if(isset($_POST['sell_token'])){
      $discount=$_POST['token_dis'];
      if($discount=='')
      {
          $msg='<div class="alert alert-danger" id="market">please select swoco transaction list!</div>';   
      }
      else
      {
    $sell_token_phase=mysqli_query($con,"select * from sell_token where sell_phase='".$show_phase_value['id']."' and buy_phase='".$_POST['phase']."' and user_id='".$_SESSION['user_id']."' and order_id='".$_POST['mylist']."' and sell_status='0' limit 1");
    if(mysqli_num_rows($sell_token_phase) >0 )
    {
    $msg='<div class="alert alert-danger" id="market">10% sell has been done on this phase</div>';
    }
    else
    {
    $date = date('Y-m-d G:i:s');
    $per=$_POST['percent'];
    $pur_date=$_POST['purchase_date'];
    $buy_phase1=$_POST['phase'];
    $sell_phase=$show_phase_value['id'];
    $order_id=$_POST['mylist'];
    $discount=$_POST['token_dis'];
    $total_token=$discount*10;;
    $gt_total_prc=$discount*$phase_val;
    $sell_price=$_POST['sell_price'];
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
  $newdate = date('Y-m-d G:i:s', strtotime('1 months', strtotime($pur_date))); 
//   echo "INSERT INTO `sell_token`(`order_id`,`user_id`,`user_ref_id`,`token_percent`, `sell_phase`,`buy_phase`, `total_token`, `token_per_amount`, `sell_token`,`update_sell_token`, `status`,`sell_date`,`day`,`sell_status`) VALUES ('".$order_id."','".$_SESSION['user_id']."','".$_SESSION['ref_idsignup']."','".$per."','".$sell_phase."','".$buy_phase1."','".$total_token."','".$discount."','".$discount."','".$discount."','pending','".$date."','".howDays($newdate,$date)."','0')";
           $sql=mysqli_query($con,"INSERT INTO `sell_token`(`order_id`,`user_id`,`user_ref_id`,`token_percent`, `sell_phase`,`buy_phase`, `total_token`, `token_per_amount`, `sell_token`,`update_sell_token`, `status`,`sell_date`,`day`,`sell_status`) VALUES ('".$order_id."','".$_SESSION['user_id']."','".$_SESSION['ref_idsignup']."','".$per."','".$sell_phase."','".$buy_phase1."','".$total_token."','".$discount."','".$discount."','".$discount."','pending','".$date."','".howDays($newdate,$date)."','0')");
   if($sql)
   {
        $insert_pay_record_qry = mysqli_query($con, "INSERT INTO `milkway_userpay_list` (`se_id`,`rd_id`,`user_id`,`user_rf_id`,`mode`,`user_email`,`verify_number`,`ord_id`,`qnty`,`unit_price`,`total_price`,`commission_percent`,`grand_total_amt`,`phase_mode`,`inv_type`,`inv_type_amt`,`user_percent_status`,`userpercent_done_dtime`,`temp_add`,`added_date`,`status`,remarks,`pay_via_panel`,`pay_datetime`) 
      	VALUES ('".$gt_se_id."','','".$gt_user_id."','".$user."','".$login_ck."','".$gt_user_email."','','".$order_id."','".$discount."','".$phase_val."','".$gt_total_prc."', '', '','". $sell_phase."','".$gt_inv_type."','".$gt_inv_type_amt."','unpaid','','".$gt_temp_date."','".$gt_add_date."','success','SELL MARKET','','$gt_add_date')");
//   //   $sql=mysqli_query($con,"UPDATE `milkway_userpay_list` SET `qnty`=`qnty`-'$discount' where user_id='".$_SESSION['user_id']."' and phase_mode='".$buy_phase1."' and ord_id='".$order_id."' limit 1");
      $msg='<div class="alert alert-success" id="market">Sell transaction Successfully done</div>'; 
   }
   else
   {
               $msg='<div class="alert alert-danger" id="market">You have Not Sell!</div>';  
   }
   }
 }
}
?>
  <div class="app-content content">
    <div class="content-wrapper">
       <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Swoco Market </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item"><a href="Swoco_Market.php">Swoco Market</a>
                </li>
               
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
        <!-- eCommerce statistic -->
        
    <div class="row">
     <!--<div class="col-xl-3 col-lg-6 col-12 offset-lg-3" >-->
   <!--         <div class="card pull-up">-->
   <!--           <div class="card-content">-->
   <!--             <div class="card-body"  id="buymarket">-->
   <!--               <div class="media d-flex">-->
   <!--                 <div class="media-body text-left">-->
   <!--                  <a href="sell_History.php"><button type="button" class="btn btn-info btn-block">BUY</button></a>-->
   <!--                  </div>-->
                    
   <!--               </div>-->
                  
   <!--             </div>-->
   <!--           </div>-->
   <!--         </div>-->
   <!--       </div>-->
    
    
    
    
     <div class="col-xl-4 col-lg-6 col-12 offset-lg-4">
         
         
           <h1 class="text-center sell_bt">SELL</h1> 
            <!--<div class="card pull-up"> 
              <div class="card-content">
              
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                  
                         
                    </div>
                   
                  </div>
                 
                </div> 
                 
              </div>
            </div> -->
            
          </div>
    
     </div>
    
    
    
    
      <?php if(!empty($msg)) { echo $msg; } ?>
  
    
    
    <div class="font_wrap" id="sell_market" >
    <div class="row">
    
    <div class="col-xl-3 col-lg-6 col-md-12">
         <form action="" id="purc-coin-form" method="post">
             <input type="hidden" name="purchase_date" id="purchase_date">
               <div class="card text-center">
                <div class="card-header">
                  <h4 class="card-title">% of sell Swoco</h4>
                </div>
                <div class="card-block">
                  <div class="card-body">
                    <fieldset class="form-group">
                      <input type="text" class="form-control" id="basicInput" readonly value="<?php echo $percent;?>" name="percent">
                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
      <input type="hidden" name="phase" id="phase">
      
          <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="card text-center">
                <div class="card-header">
                  <h4 class="card-title">Swoco Phase</h4>
                </div>
                <div class="card-block">
                  <div class="card-body">
          
          
                    <div class="form-group">
                      
                      <select class="select2 form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" id="myphase" name="myphase">
                        <option value="AK">-------</option>
                        <?php 
                        $sql_phase=mysqli_query($con,"select id,status,phase from milkyway_icocoin");
                        while($sql_phase_name=mysqli_fetch_array($sql_phase))
                        {
                        ?>
                          <option value='<?php echo $sql_phase_name['id'];?>' name="myphase"  <?php if($sql_phase_name['status']== '1') {echo 'disabled=""';} ?>><?php echo $sql_phase_name['phase'];?></option>
                       <?php }
                       //}
                       ?>
                      </select>
                    </div>
          
          
                  </div>
                </div>
              </div>
            </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="card text-center">
                <div class="card-header">
                  <h4 class="card-title">Swoco Trasnaction List</h4>
                </div>
                <div class="card-block">
                  <div class="card-body">
          
          
                    <div class="form-group">
                      
                      <select class="select2 form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" id="mylist" name="mylist" required>
                        <option value="EMPTY">-------</option>
                        
                        
                      </select>
                    
                    </div>
          
          
                  </div>
                </div>
              </div>
            </div>
      
      
          <!--<div class="col-xl-3 col-lg-6 col-md-12">-->
          <!--    <div class="card text-center">-->
          <!--      <div class="card-header">-->
          <!--        <h4 class="card-title">Total Swoco</h4>-->
          <!--      </div>-->
          <!--      <div class="card-block">-->
          <!--        <div class="card-body">-->
          <!--          <fieldset class="form-group">-->
          <!--            <input type="text" class="form-control" placeholder="0.8" id="qunty" readonly name="total_token">-->
          <!--          </fieldset>-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
            <div class="col-xl-3 col-lg-6 col-md-12">
              <div class="card text-center">
                <div class="card-header">
                  <h4 class="card-title">10 % Swoco Amount</h4>
                </div>
                <div class="card-block">
                  <div class="card-body">
                    <fieldset class="form-group">
                      <input type="text" class="form-control" placeholder="100" id="token_dis" readonly name="token_dis" required>
                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
            
    <!--<div class="col-xl-3 col-lg-6 col-md-12">-->
    <!--          <div class="card text-center">-->
    <!--            <div class="card-header">-->
    <!--              <h4 class="card-title">Sell Swoco Amount</h4>-->
    <!--            </div>-->
    <!--            <div class="card-block">-->
    <!--              <div class="card-body">-->
    <!--                <fieldset class="form-group">-->
    <!--                  <input type="text" class="form-control" placeholder="100" id="sell_price" name="sell_price" required oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">-->
    <!--                </fieldset>-->
    <!--              </div>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->
            
        </div>
        <div class="row">
     <div class="col-xl-4 col-lg-6 col-12 offset-lg-4">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      
                        <center> <span class="alert alert-danger" id="error1" style="display:none;text-align:center;">You do not have the Swoco on this phase </span>
                        <!--<span class="alert alert-danger" id="error" style="display:none;text-align:center;">Don't have sell Current token Phase!</span>-->
                        </center> 
                        <button type="submit" class="btn btn-success btn-block"  name="sell_token" id="sell_btn" onclick="if (!confirm('Are you sure you want to sell?')) { return false }">SELL</button>
                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
     </div>
        </div>
        
        <!--/ eCommerce statistic -->
  
  
      
        <div class="col-xl-6 col-lg-6 col-12 offset-xl-3">
         
         
           <h1 class="text-center sell_bt_new">Swoco Sell  Market</h1> 
           
            
          </div>
      
      
      
      <div class="row">
    
    <div class="col-xl-4 offset-xl-2 col-lg-4 col-md-12">
         <form action="" id="purc-coin-form" method="post">
               <div class="card text-center">
                <!--<div class="card-header">-->
                <!--  <h4 class="card-title">% of sell Swoco</h4>-->
                <!--</div>-->
                <div class="card-block">
                  <div class="card-body">
                   Total Swoco: <?php 
                   $sql=mysqli_query($con,"SELECT sum(sell_token)as totalswoco FROM `sell_token`");
                   $a= mysqli_fetch_array($sql);
                     echo  number_format($a['totalswoco'], 2, '.' ,'');
                     ?> 
                   <!--Token:- 45454$-->
                  </div>
                </div>
              </div>
            </form></div>
            <div class="col-xl-4 col-lg-4 col-md-12">
         <form action="" id="purc-coin-form" method="post">
               <div class="card text-center">
                <!--<div class="card-header">-->
                <!--  <h4 class="card-title">% of sell Swoco</h4>-->
                <!--</div>-->
                <div class="card-block">
                  <div class="card-body">
                   Total Balance Swoco: <?php 
                    $a=$purchase_amount['amount']-$purchase_amount1['amount']+$return_sell_amount['amount'];
                    
                    //+$reinvest_income['token'];  
                   echo number_format($a, 2, '.' ,'');
                     ?> 
                   <!--Token:- 45454$-->
                  </div>
                </div>
              </div>
            </form></div>
     
            
        </div>
      </form>
      
      

 </div>
</div>
 </div>
 <?php include('../inc/footer.php');?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
          $(document).ready(function(){
               $('#sellmarket1').click(function(){
                    $('#sell_market').show();
                    $('#buymarket').hide();
               });
             
          });
            $(document).ready(function(){
                  $('#sell_btn').attr('disabled',true);
            $('#myphase').change(function(){
                //  $('#mylist').empty();
                 $("#mylist").empty().append('<option value="">-Select one-</option>');
                //  $('#token_dis').empty();
            //   $('#token_dis').val('');
                //   $('#idofdropdown').trigger("chosen:updated");
                          
                //Selected value
                var inputValue = $(this).val();
                $.post(
                    'demo.php',
                    { 
                        token_v: inputValue 
                    }, 
                    function(data){
                   if(data=='[]')
                  {
                    $('#sell_btn').hide(); 
                    $('#market').hide();
                    $('#error1').show(); 
                       $('#token_dis').val('');
                  }
                  
                var obj=JSON.parse(data);
                $.each(obj,function(index,value){
                $("<option value="+value.orderid+">"+value.token+"</option>").appendTo('#mylist');
                var phase=$('#phase').val(value.mode);
                $('#purchase_date').val(value.date);
                var dis= parseInt(value.token);
                  $('#error1').hide();
                  $('#market').hide();
                    $('#sell_btn').show();
              });
             });
            });
            $("#mylist").change(function() {
             var dis=$('option:selected', $(this)).text();
            //  alert(dis);
              $('#token_dis').val(dis*10/100);
                 $('#sell_btn').attr('disabled',false);
            
        });
   });
       
        </script>