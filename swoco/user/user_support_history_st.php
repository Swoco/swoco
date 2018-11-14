<?php
error_reporting(0);
include('../inc/dbase.php');

$user_date = date('Y-m-d h:i:s');

if($_SESSION['user_id'] == '')
{
    header('location:index.php');
}

if(isset($_GET['idrt']) && $_GET['idrt'] !='')
{

  $token_id = $_GET['idrt'];
  $query = mysqli_query($con, trim("SELECT * FROM `milkyway_usersupport` Where `ticket_no`='".$token_id."' and status='1'"));
  if(mysqli_num_rows($query) > 0)
  {
    $result = mysqli_fetch_array($query);
    $re_ticket = $result['ticket_no'];
    $re_sub = $result['subject'];
    $re_msg = $result['msg'];
    $re_response_msg = $result['response_msg'];
    $re_response_date = $result['response_adddate'];
  }
  else
  {
    echo "<script>alert('Something Went Wrong Contact To Solacegold team !!!!'); window.location='index.php';</script>";
  }


  if(isset($_POST['user_support_submit_reply']))
{
 $userr_id = $_SESSION['user_id'];
 $re_token = mysqli_real_escape_string($con, trim($_POST['reply_token']));
 $re_subject = mysqli_real_escape_string($con, trim($_POST['reply_subject']));
 $re_msg = mysqli_real_escape_string($con, trim($_POST['reply_msg']));

 $support_insert_qry = mysqli_query($con, "INSERT INTO `milkyway_usersupport` (`user_id`,`ticket_no`,`subject`,`msg`,`support_status`,`status`,`user_add_date`) VALUES ('".$userr_id."','".$re_token."', '".$re_subject."', '".$re_msg."', 'pending', '1', '".$user_date."')");
 if($support_insert_qry) 
 {
  $re_support_msg = '<div class="alert alert-success" role="alert">Message Sent Successfully</div>';
 }
 else
 {
  $re_support_msg = '<div class="alert alert-danger" role="alert">Oops Unable to Generate Ticket Please try Again !!!!</div>';
 }

}

?>
<?php include('../inc/header.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">SUPPORT TICKET HISTORY</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Support Ticket</a>
                </li>
                <li class="breadcrumb-item active">Support Ticket History
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
       <!-- Complex headers table -->
        <section id="headers">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"></h4>
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
                     <?php if(!empty($re_support_msg)) { echo $re_support_msg; } ?>
                                          <form method="post" action="" id="user-support-reply-form">

                                            <div class="col-sm-12 col-xs-12">
                                                <div class="form-wrap">
                                                
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="exampleInputuname_1">Token No</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon"><i class="fa fa-book" aria-hidden="true"></i></div>
                                                              <input type="text" class="form-control" value="<?php echo $re_ticket; ?>" readonly="readonly" name="reply_token">
                                                            </div>                                                            
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                        
                                            
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="form-wrap">
                                                    
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="exampleInputuname_1">Subject</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></div>
                                                               <input type="text" class="form-control" value="<?php echo $re_sub; ?>" readonly="readonly" name="reply_subject" >
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        
                                                    
                                                </div>
                                            </div>

                                        
                                         
                                            
                                            
                                            <div class="col-sm-12">
                                                <div class="form-wrap">
                                                
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="exampleInputuname_1">Your Message (Reply)</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
                                                              <textarea class="form-control" cols="10" rows="10" name="reply_msg" ></textarea>
                                                                
                                                            </div>                                                            
                                                        </div>

                                                         <input type="submit" value="Submit" name="user_support_submit_reply" class="btn btn-success mr-10"> 

                                                        
                                                        
                                             
                                                </div>
                                            </div>
                                                
                                        </form>
                                     
                
                </div>
                 <div class="card-body card-dashboard">
                 
                 <?php 

$supp_query = mysqli_query($con, trim("SELECT * FROM `milkyway_usersupport` Where `ticket_no`='".$token_id."' and status='1' order by id desc"));
while($supp_result = mysqli_fetch_array($supp_query))
{ 
?>    

<?php if(($supp_result['support_status'] == 'complete') || ($supp_result['support_status'] == 'close')) { ?>   

                        
<div class="panel panel-default ">
  <div class="panel-heading">
  <div class="row">
  <div class="col-xs-6"><i class="fa fa-user"></i>  Swoco</div>
  <div class="col-xs-6 text-right"><?php echo date('l, F d y h:i:s', strtotime($supp_result['response_adddate'])); ?></div>
  </div>
  </div>
  <div class="panel-body supportcnt">
  <p> <?php echo $supp_result['response_msg']; ?></p>
  
  <address style="color:#3354ff;">Regards,<br> Swoco Team | <b>Status</b>-
  <?php 
  if( $row['support_status']=='complete')
  {
      ?>
 <span style='color:green;'><?php echo $supp_result['support_status'];?></span>
 <?php  }
  else
  { ?>
<span style='color:green;'><?php echo $supp_result['support_status'];?></span>
 <?php
  }
  
  ?></address>
  </div>
</div>

<?php } ?>      

<div class="panel panel-default ">
  <div class="panel-heading">
  <div class="row">
  <div class="col-xs-6"><i class="fa fa-user"></i><?php echo ucwords($_SESSION['name']); ?></div>
  <div class="col-xs-6 text-right"><?php echo date('l, F d y h:i:s', strtotime($supp_result['user_add_date'])); ?></div>
  </div>
  </div>
  <div class="panel-body supportcnt">
   <p>
        <?php echo $supp_result['msg']; ?>
   </p>
  </div>
</div>

<?php } ?>
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
 <script>
 $(function(){
    $('#user-support-reply-form').validate({
            rules: {
                reply_msg : "required",
            },
            messages: {
                 reply_msg : "Please Enter Message !!!",
            },
            submitHandler : function(form){
                form.submit();
            }
        });
});
</script>

 <?php
} 
else { 
	header('location:index.php');
}
?>