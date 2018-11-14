<?php include('../inc/header.php');?>
<?php
error_reporting(0);
include('../inc/dbase.php');
include('../inc/checker.php');
session_start();
if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}
    ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
       <div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="panel panel-default card-view">
								<!--	<div class="panel-heading">
									<div class="pull-left">
										<p class="text-center"> SWOCO TOKEN</p> 
									</div>
									<div class="clearfix"></div>
								</div>-->
								<div class="panel-wrapper">
									<div class="panel-body">
									    											<div class="row">
										     
											<div class="col-sm-12 col-xs-12">
											   <video width="100%" height="auto" controls="">
  <source src="app-assets/video/swocovideo.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video> 
													
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
  <?php include('../inc/footer.php');?>