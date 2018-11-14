<?php include('inc/header.php');?>
<?php 
include('inc/dbase.php');
if(isset($_SESSION['adm_email']) == '') {
        header("location:index.php");
    }  
 $sql_history = "SELECT * FROM milkyway_swoco_list WHERE 1=1 ORDER BY `id` desc";
  $query = mysqli_query($con, $sql_history);
  if(isset($_POST['submit']))
  {
    $price=$_POST['price'];
     $date = date('Y-m-d h:i:s');
    $sql=mysqli_query($con,"INSERT INTO `milkyway_swoco_list`( `token_price`, `status`, `add_date`, `add_datetime`) VALUES ('".$price."','0','','".$date."')");
    if($sql)
    {
        	//$msg = '<div class="alert alert-success" role="alert">Successfully Insert Purchase Amount.</div>';
        	echo '<script>alert("Successfully Insert Purchase Amount");window.location="manage_purchaseamount.php"</script>';
    }
    else
    {
        	$msg = '<div class="alert alert-danger" role="alert">Unsuccessfully Insert Purchase Amount. </div>';
    }
  }
?>
  </div>  
  <div class="app-content content">
    <div class="content-wrapper">
     
      <div class="row">
     
     <div class="col-md-4">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<p class=" txt-light text-center texte"><b>Manage Purchase Amount</b></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper ">
									<div class="panel-body">
									     										<div class="row">
										
											
											<div class="col-sm-12">
												<div class="form-wrap">
												    	<?php if(!empty($msg)) { echo $msg; } ?>
													<form method="post" action="">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Purchase Amount</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
																<input type="text" class="form-control" id="exampleInputuname_1" placeholder="1236544" name="price"  maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
															</div>															
														</div>
														
														
													<input type="submit" class="btn btn-success" name="submit" value="Update">
													</form>	
												</div>
											</div>
											
													
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						 <div class="col-md-8">
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
                                <th>Purchase Amount</th>
                               <td>Date</td>
                                
							   
                        </tr>
                      </thead>
                      <tbody>
                           <?php 
                           $i=1;
                           while($row=mysqli_fetch_array($query))
                           {?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['token_price'];?></td>
                                <td><?php echo $row['add_datetime'];?></td>
                              
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
						 </div>
						
					 </div>		
						
						
						
    </div>
  </div>
 <?php include('inc/footer.php');?>