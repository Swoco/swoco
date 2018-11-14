<?php include('inc/header.php');?>
<?php

error_reporting(0);
$conn = mysqli_connect('localhost', 'swoco_coin', 'swoco_coin@123', 'swoco_app')or mysqli_error();  
if(isset($_POST['submit']))
{
    $value=$_POST['svalue'];
    $price=$_POST['price'];
    $date=date('Y-m-d h:i:s');
    $status='1';
    $sql=mysqli_query($conn,"INSERT INTO `fcccoins`(`fccvalue`, `fccinusd`, `status`, `created_by`, `created`) VALUES ('".$value."','".$price."','".$status."','1','".$date."')");
    if($sql)
    {
        	echo '<script>alert("Successfully Change Manage Phase");window.location="manage_app.php"</script>';
    }
    else
    {
        $msg = '<div class="alert alert-danger" role="alert">Unsuccessfully Insert Manage Phase. </div>';
    }
}

?>
   


     
        <div class="app-content content">
    <div class="content-wrapper">
     
      <div class="row">
     
     <div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<p class=" txt-light text-center texte"><b>Manage Phase</b></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper ">
									<div class="panel-body">
									     										<div class="row">
										
											
											<div class="col-sm-8">
												<div class="form-wrap">
												    	<?php if(!empty($msg)) { echo $msg; } ?>
													<form method="post" action="">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Swoco Value</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="SWOCO VALUE" name="svalue"  maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
															</div>															
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Swoco Price</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="SWOCO Price" name="price"  maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
															</div>															
														</div>
														
														
													<input type="submit" class="btn btn-success" name="submit" value="Update">
													</form>	
												</div>
											</div>
											</div>
												<div class="row">
										
											
											<div class="col-sm-12">
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
                                <th>Swoco Value</th>
                               <td>Swoco Price</td>
                               <td>Date</td>
                                
							   
                        </tr>
                      </thead>
                      <tbody>
                           <?php 
                           $query=mysqli_query($conn,"select * from fcccoins");
                           $i=1;
                           while($row=mysqli_fetch_array($query))
                           {?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['fccvalue'];?></td>
                                <td><?php echo $row['fccinusd'];?></td>
                                 <td><?php echo $row['created'];?></td>
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
									</div>
								</div>
							</div>
						</div>
      </div>
    </div>
  </div>
 <?php include('inc/footer.php');?>
 