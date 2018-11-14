<?php include('inc/header.php');?>
<?php
include 'inc/dbase.php';

$select_ticket_number = mysqli_query($con,"select * from `create_ticket` where `ticket_number`='" . @$_REQUEST['ticket-number'] . "'");
$display_ticket123 = mysqli_fetch_array($select_ticket_number);
$select_user = mysqli_query($con,"select * from `milkyway_usersignup` where `id`='" . $display_ticket123['user_id'] . "'");
$display_username = mysqli_fetch_array($select_user);
$fullname = $display_username['name'];
$agent_id = $display_username['id'];
$email_id = $display_username['email'];
if (@$_POST['open_ticket']) {
    mysql_query("SET autocommit=FALSE");
    $date = date('Y-m-d G:i:s');
    @$image1 = $_FILES['attachments']['name'];
    if (@$image1 != '') {
        $image = time() . $_FILES['attachments']['name'];
        $path = "img/create_ticket/" . $image;
        move_uploaded_file($_FILES['attachments']['tmp_name'], $path);
    } else {
        $image = '';
    }
    $update_status = mysqli_query($con,"update `ticket_reply` set `notification_status`='1' where `ticket_number`='" . @$_REQUEST['ticket-number'] . "'");
    $reply_ticket = mysqli_query($con,"insert into `ticket_reply`(`ticket_id`,`ticket_number`,`agent_id`,`subject`,`message`,`attachments`,`status`,`date`,`reply_name`,`notification_status`)values('" . $display_ticket123['ticket_id'] . "','" . $display_ticket123['ticket_number'] . "','" . $display_ticket123['user_id'] . "','" .$_POST['subject'] . "','" . $_POST['txtmsg'] . "','" . @$image . "','1','" . $date . "','" . $register_id . "','0')") or die(mysql_error());
    $update_status1 = mysqli_query($con,"update `create_ticket` set `reply_status`='1',last_update_date='" . $date . "' where `ticket_number`='" . @$_REQUEST['ticket-number'] . "'");

    // mysql_query("update `ticket_reply` set `notification_status`='0' where `ticket_number`='" . @$_REQUEST['ticket-number'] . "'");


    if ($reply_ticket && $update_status && $update_status1) {
        $email = $display_username['email'];
        $fullname = $display_username['name'];
        $agent_id = $display_username['user_id'];
        $password = $display_username['password'];
        $to = $email;
        $subject = "You have receive reply of ticket number-" . $_REQUEST['ticket-number']; // Your subject
        $messages = "<!doctype html>";
        $messages .= "<html>";
        $messages .= "<head>";
        $messages .= "<meta charset='utf-8'>";
        $messages .= "<title>Swoco</title>";
        $messages .= '<style>
.pro{
	 position:relative;
	 text-align:center;
	 border-right:2px solid;
	 

}
.pro h3{position:absolute;

}
.blog{ background-size:100% 100%;}
li{ list-style:none;}
.name{
	background-color: #f0c731;
    color: #000;
    display: inline-block;
    font-family: lato;
    font-size: 20px;
    font-weight: bold;
    height: 28px;
    margin-left: 20px;
    padding-left: 16px;
    padding-right: 15px;
    padding-top: 3px;
    position: relative;
    text-transform: uppercase;
	}
.name::after {
    background-color: #f0c731;
    content: "";
    display: block;
    height: 22px;
    left: -12px;
    position: absolute;
    top: 5px;
    transform: rotate(45deg);
    width: 23px;
}
.name-d {
    font-family: lato;
    font-size: 18px;
    line-height: 26px;
    margin-top: 15px;
    position: relative;
    text-transform: uppercase;
}
.name-d span{
	color:#f0c731;
	}	
</style>';

        $messages .= "</head>";

        $messages .= "<body style='background-color:#2A2939;'>";
        $messages .= "<div class='wapper' style='margin:0 auto;'>";
        $messages .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#2A2939;">';

        $messages .= "<tr>";
        $messages .= '<td align="center" valign="top">';
        $messages .= '<table class="bg_img" width="100%" border="0" align="top" cellpadding="0" cellspacing="0">';
        $messages .= "<tr>";
        $messages .= "<td>";
        $messages .= '<table width="100%" border="0" align="top" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #eaeceb;background-color:#2A2939; ">';
        $messages .= '<tr>';

        $messages .= '<td style="text-align:center;padding: 15px;border-bottom: 1px solid #fff;"><img style="width:120px;" src="https://www.cryptobulls.net/img/logo.png"></td>';

        $messages .= '</tr>';
        $messages .= '<tr>';


        $messages .= '<td valign="top"><h1 style="font-size:20px;margin-top:30px;margin-bottom:0px;  text-align:center; font-weight:600;  color:#fff;text-shadow: -4px 10px 3px rgba(0, 0, 0, 0.1); font-family:Times New Roman;">Ticket Reply-' . $_REQUEST['ticket-number'] . '</h1>
							 </td>';

        $messages .= " </tr>";
        $messages .= "<tr>";

        $messages .= '<td valign="top" style="padding:10px 0 30px 30px; width:65%">';
        $messages .= '<ul style="margin-top:20px; padding-left:0px;">';
        $messages .= '<li style="width:100%; float:left; margin-bottom:15px;">';
        $messages .= '<p style="color:#FFF; font-size:14px; line-height:24px; font-family:lato; float:left; margin:0;">
<b>Dear ' . $fullname . '</b><br>
     ' . $_POST['txtmsg'] . '

                                        </p>';
        $messages .= "</li>";

        $messages .= "</ul>";


        $messages .= '<ul style="margin-top:20px; padding-left:0px;">';
        $messages .= '<li style="width:100%; float:left; margin-bottom:15px;">';
        $messages .= '<p style="color:#FFF; font-size:14px; line-height:24px; font-family:lato; float:left; margin:0;"><b>Happy working,</b><br>
                                        	The Cryptobulls Crew
                                        </p>';
        $messages .= "</li>";
        $messages .= "</ul>";
        $messages .= "</td>";


        $messages .= " </tr>";

        $messages .= "</table>";
        $messages .= "</td>";
        $messages .= "</tr>";

        $messages .= " <tr>";
        $messages .= "<td>";
        $messages .= "<tr>";






        $messages .= "</tr>";
        $messages .= "</table>";
        $messages .= "</td>";

        $messages .= "</tr>";
        $messages .= "<tr>";
        $messages .= "<td>";

        $messages .= "</td>";
        $messages .= "</tr>";
        $messages .= "</table>";
        $messages .= "</td>";
        $messages .= "</tr>";

        $messages .= "</table>";
        $messages .= "</div>";
        $messages .= "</body>";
        $messages .= "</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html; Charset= iso-8859-1" . "\r\n";
$headers .= "From: Swoco <info@swoco.io>" . "\r\n"; // Set from headers
 $sentmail = mail($to, $subject, $messages, $headers);
        //include '../smtp/script/class.phpmailer.php';
       echo "<script>alert('Reply Successfully Send');  window.location='all_view_support_ticket.php?ticket-number=" . $_REQUEST['ticket-number'] . "'; </script>";
    } else {
        echo "<script>alert('Process not completed. Please try again!');window.location='all_view_support_ticket.php?ticket-number=" . $_REQUEST['ticket-number'] . "';</script>";
    }
}
if (@$_REQUEST['close-ticket-number']) {
    $date = date('y-m-d h:i:s');
    $close_ticket = mysqli_query($con,"update `create_ticket` set `close_ticket`='1',`close_date`='" . $date . "' where `ticket_number`='" . @$_REQUEST['close-ticket-number'] . "'");
    if ($close_ticket) {
       
        echo "<script>alert('Ticket Successfully Close');window.location='all-ticket.php?status=Open'</script>";
    } else {
        echo "<script>alert('Process not completed. Please try again!');window.location='all_view_support_ticket.php?ticket-number=" . $_REQUEST['ticket-number'] . "';</script>";
    }
} else if (@$_REQUEST['open-ticket-number']) {
    $open_ticket = mysqli_query($con,"update `create_ticket` set `close_ticket`='0' where `ticket_number`='" . @$_REQUEST['open-ticket-number'] . "'");
    if ($open_ticket) {
        echo "<script>alert('Ticket Successfully Open');window.location='all-ticket.php?status=Close'</script>";
    } else {
        echo "<script>alert('Process not completed. Please try again!');window.location='all_view_support_ticket.php?ticket-number=" . $_REQUEST['ticket-number'] . "';</script>";
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
                                                <div class="row">
                                                    <div class="col-sm-6 col-sx-12">
                                                        <button class="btn-reply" onclick="show_form();" style="color: #fff;margin: 5px;"><i class="fa fa-reply"></i> Reply</button>
                                                    </div>
                                                    <div class="col-sm-6 col-sx-12">
                                                        <a style="color: #fff;float: right;margin: 5px;" href="all-view-support-ticket.php?close-ticket-number=<?php echo $_REQUEST['ticket-number']; ?>&ticket-number=<?php echo $_REQUEST['ticket-number']; ?>" onclick="return confirm('Are you sure close this ticket?')" class="btn-reply close-ticket" ><i class="fa fa-close"></i> Close</a>
                                                    </div>
                                                </div>
                                                <?php
                                            } else if ($display_ticket123['close_ticket'] == '1') {
                                                ?>
                                                <div class="row">
                                                    <div class="col-xs-12">


                                                        <a href="all-view-support-ticket.php?open-ticket-number=<?php echo $_REQUEST['ticket-number']; ?>&ticket-number=<?php echo $_REQUEST['ticket-number']; ?>" onclick="return confirm('Are you sure open this ticket?')" style="width: 100%;margin: 8px 8px 2px 0px;background-color: green; float: inherit;color: #fff" class="btn-reply" ><i class="fa fa-reply"></i> Open</a>
                                                    </div>
                                                </div>
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
                                                    <button class="ticket-btn-reply" onclick="show_form();"  ><i class="fa fa-reply"></i> Reply</button>
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
																  <input type="text" class="form-control readonly" readonly value="<?php echo $display_username['name']; ?>">
                                           
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