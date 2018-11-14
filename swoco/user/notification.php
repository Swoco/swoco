<?php include('../inc/header.php'); ?>
<?php
error_reporting(0);
include('../inc/dbase.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}
$notification_up_qry = mysqli_query($con, "SELECT * FROM `milkyway_usernotification` WHERE id='1'");
$result_notification_rec= mysqli_fetch_array($notification_up_qry);

?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">Notification </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                 <li class="breadcrumb-item active"> Notification & Updates
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
         <!-- File export table -->
        <section id="buy_History-plus">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Notification</h4>
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
             <div class="col-lg-12 col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<p class="text-muted txt-light text-center texte text-white">Notification and Updates</p>

								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper ">
								<div class="panel-body">
								<div id="newsupdate">
									<!-- <p><img src="https://i.froala.com/download/662f87a68cd5cdba27a5b54bc73a4bed5398c110.png?1519033244" style="width: 300px;" class="fr-fic fr-dib"></p> -->
                                <marquee behavior="scroll" direction="up" scrollamount="3" height="280px" onmouseover="this.stop();" onmouseout="this.start();">
                                <p><?php echo $result_notification_rec['content']; ?>
                               </p>
                                </marquee>
                                </div>	
                                    
                                    
                                    
									
								</div>
							</div>
							
						</div>
					</div>

                  
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