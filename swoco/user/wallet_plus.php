<?php
error_reporting(0);
include('../inc/dbase.php');
if(!isset($_SESSION))
{
	session_start();
}
?>
<?php include('../inc/header.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        
      </div>
      <div class="content-body">
        <div id="crypto-stats-3" class="row">
            
            
             <div class="col-xl-12 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body">
                  <div class="row">
                    
                    <div class="col-12 text-center">
                    <h1 class="success darken-4">
                 Download 
                    </h1>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
         
		  <div class="col-xl-6 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body">
                  <div class="row">
                    
                    <!-- <div class="col-12 text-center">-->
                    <!--<h4></h4>-->
                    <!--</div>-->
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4">
                  <a class="te_wh" href="https://www.swoco.io/#mobile-wallet"><button type="button" class=" btn btn-success  btn-rounded btn-outline"> Mobile Walllet</button></a>
                    </h6>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
         
		  <div class="col-xl-6 col-12 dash_style">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                 <div class="card-body">
                  <div class="row">
                    
                    <!-- <div class="col-12 text-center">-->
                    <!--<h4></h4>-->
                    <!--</div>-->
					
                    <div class="col-12 text-center">
                    <h6 class="success darken-4">
                  <a class="te_wh" href="https://www.swoco.io/#services"><button type="button" class=" btn btn-success  btn-rounded btn-outline">Web Walllet</button></a>
                    </h6>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          
           
          
          <div class="col-xl-12 col-12 dash_style wallet_css">
            <h1><b>Note</b></h1>
             <p> - step 1st : Download  Wallet</p>
              <p>- step 2nd : Copy Your receving address</p>
               <p>- step 3st : come to dashboard and update your swoco wallet address</p>
          </div>
         
          
		   </div>
     </div>
     
     
     
     
     
 
 <!--</div>-->
 <!-- </div>-->
<!--</div>-->

   <?php
 // }
   
      
 ?>
 
         <!--<div class="col-xl-12 col-12 dash_style">-->
         <!--   <div class="ico-counter">-->
         <!--               <div class="counter-down">-->

                          
         <!--                       <div class="conuter-header">-->
                                    <!--<h3 class="text-center">SWOCO I PHASE -->
                                    <!--<span style='color:yellow;'>SALE</span> START-->
                                    <!--</h3>-->
         <!--                           <h2 class="text-center">  DAYS LEFT FOR REWARD  </h2>-->
         <!--                       </div>-->
         <!--                       <div class="counterdown-content">-->
                                  
         <!--                           <div class="count-down titled circled text-center">-->
         <!--                               <div class="simple_timer syotimer timer">-->
         <!--                                   <div class="timer-head-block"></div>-->
         <!--                                   <div class="timer-body-block">-->
         <!--                                       <div class="table-cell day">-->
         <!--                                           <div class="tab-val">0</div>-->
         <!--                                           <div class="tab-metr tab-unit">days</div></div>-->
         <!--                                           <div class="table-cell hour"><div class="tab-val">06</div><div class="tab-metr tab-unit">hours</div></div>-->
         <!--                                           <div class="table-cell minute"><div class="tab-val">00</div><div class="tab-metr tab-unit">minutes</div></div>-->
         <!--                                           <div class="table-cell second"><div class="tab-val" style="opacity: 1;">54</div><div class="tab-metr tab-unit">seconds</div></div></div>-->
         <!--                                           <div class="timer-foot-block"></div></div>-->
         <!--                           </div>-->
                                   
                                   
                             
                                
         <!--                   </div>-->
                            
         <!--               </div>-->
         <!--           </div>-->
            
         <!-- </div>-->
          
          
          
           
           
          
 
</div>


	 </div>
</div>

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