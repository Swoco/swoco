<?php include('../inc/header.php');?>
<?php
include '../inc/dbase.php';
$select_ticket_number = mysqli_query($con,"select * from `create_ticket` where `ticket_number`='" . @$_REQUEST['ticket-number'] . "'");
$display_ticket123 = mysqli_fetch_array($select_ticket_number);
mysqli_query($con,"update `ticket_reply` set `notification_status`='1' where `ticket_number`='" . @$_REQUEST['ticket-number'] . "' and notification_status='0'");
$select_user = mysqli_query($con,"select * from `user_register` where `agent_id`='" . $display_ticket123['agent_id'] . "'");
$display_username = mysqli_fetch_array($select_user);

if (@$_POST['open_ticket']) {
  //  mysql_query("SET autocommit=FALSE", $dbh1);
    $date = date('Y-m-d G:i:s');
    @$image1 = $_FILES['attachments']['name'];
    if (@$image1 != '') {
        $image = time() . $_FILES['attachments']['name'];
        $path = "img/create_ticket/" . $image;
        move_uploaded_file($_FILES['attachments']['tmp_name'], $path);
    }
    $reply_ticket = mysqli_query($con,"insert into `ticket_reply`(`ticket_id`,`ticket_number`,`agent_id`,`subject`,`message`,`attachments`,`status`,`date`,`notification_status`,`reply_name`)values('" . $display_ticket123['ticket_id'] . "','" . $display_ticket123['ticket_number'] . "','" . $display_ticket123['user_id'] . "','" .$display_ticket123['subject'] . "','" .$_POST['txtmsg'] . "','" . @$image . "','1','" . $date . "','2','')") or die(mysqli_error());
    $update_status = mysqli_query($con,"update `create_ticket` set `reply_status`='0',last_update_date='" . $date . "' where `ticket_number`='" . @$_REQUEST['ticket-number'] . "'");
    // mysql_query("update `ticket_reply` set ``='2' where `ticket_number`='" . @$_REQUEST['ticket-number'] . "'");

    if ($reply_ticket && $update_status) {
       
        echo "<script>alert('Reply Successfully Send !');  window.location='user_support_history.php'; </script>";
    } else {
       
        echo "<script>alert('Some problem please try again later !');window.location='user_support_history.php'</script>";
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
										<p class="text-center">View Ticket</p>
									</div>
									<div class="pull-right">
									<p class="text-muted txt-light text-center texte" style="font-size: 15px; text-decoration: underline;"><a href="user_support_history.php" target="_blank" style="color:#ffffff;">View Support History</a></p>
									</div>
									
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper">
									<div class="panel-body">
																				<div class="row">
											<!--<form class="full_width_all" method="post" action="" enctype="multipart/form-data">-->
											  <div class="col-sm-4 col-xs-12">
                        <div class="ticket-info">
                            <h2>Ticket Information</h2>
                            <ul>
                                <li><h5>#<?php echo $display_ticket123['ticket_number']; ?></h5></li>
                                <li>
                                    <span><b>Subject</b></span>
                                    <span><?php echo $display_ticket123['subject']; ?></span>
                                </li>

                                <li>
                                    <span><b>Submitted</b></span>
                                    <span><?php echo $display_ticket123['generate_date']; ?></span>
                                </li>
                                <li>
                                    <span><b>Last Updated</b></span>
                                    <span ><?php echo $display_ticket123['last_update_date']; ?></span>
                                </li>
                                <li>
                                    <span><b>Status</b></span>
                                    <span>
<?php
if ($display_ticket123['close_ticket'] == '1') {
    echo "<span style='color:green;'>Closed </span>";
} else if ($display_ticket123['reply_status'] == '0') {
    echo "<span style='color:red;'>Pending</span>";
} else if ($display_ticket123['reply_status'] == '1') {
    echo "<span style='color:green;'>Answered </span>";
}
?>

                                    </span>
                                </li>
                            </ul>
<?php
if ($display_ticket123['close_ticket'] == '0') {
    ?>      
                                <h4><button style="width: 100%;margin: 8px 8px 2px 0px;" class="btn btn-success btn-reply" onclick="show_form();"><i class="fa fa-reply"></i> Reply</button></h4>
                                <?php
                            } else {
                                ?>
                                <h4><button style="background-color: #999;width: 100%;margin: 8px 8px 2px 0px;" disabled class="btn btn-success btn-reply" onclick="show_form();"><i class="fa fa-reply"></i> Reply</button></h4>

    <?php
}
?>

                        </div>
                    </div>
						       <div class="col-sm-6 col-xs-12">
                        <div class="">
<?php
$select_username= mysqli_query($con,"select * from `milkyway_usersignup` where id='" . $_SESSION['user_id'] . "'");
$username=mysqli_fetch_array($select_username);
$select_all_reply = mysqli_query($con,"select * from `ticket_reply` where `ticket_number`='" . $_REQUEST['ticket-number'] . "'");
while ($display_all_reply = mysqli_fetch_array($select_all_reply)) {
    $select_username_reply = mysqli_query($con,"select * from `milkyway_usersignup` where id='" . $display_all_reply['agent_id'] . "'");
    $display_reply_username = mysqli_fetch_array($select_username_reply);

    $select_username_reply1 = mysqli_query($con,"select * from `milkyway_usersignup` where id='" . $display_all_reply['reply_name'] . "'");
    $display_reply_username1 = mysqli_fetch_array($select_username_reply1);
    ?>
                                <div class="main-me"> 
                                    <div class="message-title">
                                        <div class="row">                               
                                            <div class="col-sm-6 col-xs-12">
                                                <h3 >
    <?php
    if ($display_all_reply['reply_name'] == '') {
        echo "<span class=''>" . $display_reply_username['name'] . " (Client)</span>";
    } else {
        echo "<span class='staff143'>SWOCO Support</span>";
    }
    ?>

                                                </h3>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 text-right">
                                                <span><?php echo $display_all_reply['date']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-body">
                                        <p><?php
                                                if ($display_all_reply['reply_name']=='') {
                                                    ?>
                                                Dear,<?php
                                                echo $display_reply_username['name'];
                                            }
                                            ?><br>
                                            <br>
                                            <?php echo $display_all_reply['message']; ?>
                                            <br><br>
                                            <?php
                                            if ($display_all_reply['reply_name']=='') {
                                                ?>

                                                Thanks You<br>
                                                Swoco Support

        <?php
    }
    ?></p><br/>
                                        <p>
                                            <?php
                                            if ($display_all_reply['attachments'] != "") {
                                                ?>
                                                <a href="app-assets/images/Create_ticket/<?php echo $display_all_reply['attachments']; ?>" download="<?php echo $display_all_reply['attachments']; ?>" style="text-decoration: underline;color:#337ab7" target="_blank">Click here Download file Attachment</a>

                                            </p>
        <?php
    }
    ?>
                                    </div>
                                </div>
    <?php
}
?>
  <?php
                            if ($display_ticket123['close_ticket'] == '0') {
                                ?>

                                <div id="open_form">
                                    <button class="ticket-btn-reply" onclick="show_form();" style="margin-top: 20px"><i class="fa fa-reply"></i> Reply</button>
                                </div>

    <?php
}
?>

                          
                        </div>

</div>
</div>
	<div class="row">
<div class="col-md-12" >
                        <div id="reply_from" style="display:none;" class="panel panel-default card-view">
                            	<div class="panel-heading">
									<div class="pull-left">
										<p class="text-center">Reply Your Ticket</p>
									</div>
									<div class="pull-right">
								 <button class="ticket-btn-reply" onclick="close_form();" ><i  class="fa fa-times" aria-hidden="true"></i> </button>
	</div>
									
									<div class="clearfix"></div>
								</div>
                            <div class="panel-body">
                                <form method="post" enctype="multipart/form-data"  name="ticket_form">
                                    <div class="boxmain" style="margin-top: 20px">

                                        <div class="row">

                                          
                                            <div class="col-sm-6">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">FULL NAME</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
																  <input type="text" class="form-control readonly" readonly value="<?php echo $username['name']; ?>">
                                           
															</div>															
														</div>
												</div>
												</div>
                                              <div class="col-sm-6">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Subject</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
																  <input type="text" value="#<?php echo $display_ticket123['ticket_number']; ?> - <?php echo $display_ticket123['subject']; ?>" readonly name="subject" class="form-control readonly" id="subject">
                                           
															</div>															
														</div>
												</div>
												</div>
                                            <div class="col-sm-6">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Attachments</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
																  <input type="file" name="attachments" class="form-control">
																
															</div>															
														</div>
												</div>
												</div>
                                           <div class="col-sm-6">
												<div class="form-wrap">
												
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputuname_1">Your Message</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
																<textarea class="form-control" name="txtmsg" cols="10" rows="10" placeholder="Enter Message here *" required></textarea>
																
															</div>															
														</div>


														
												   
												</div>  
												 <input type="submit" value="Submit" name="open_ticket" class="btn btn-success mr-10 pull-right">
                                        </div>

                                       
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>				
										<!--</form>-->
										</div>
									</div>
								</div>
							</div>
						</div>

					
									
			
			<!-- Footer -->
			
			<!-- /Footer -->
			
		</div>
    </div>
  </div>
 <?php include('../inc/footer.php');?>
 <script>
            function show_form()
            {
                $("#reply_from").show();
                $("#close_form").show();
                $("#open_form").hide();
                // $("#reply_from").hide();
            }
            function close_form()
            {
                $("#reply_from").hide();
                $("#close_form").hide();
                $("#open_form").show();
                // $("#reply_from").hide();
            }
        </script>