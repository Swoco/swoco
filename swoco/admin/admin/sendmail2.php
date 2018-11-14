<?php include('inc/header.php');?>
<?php
error_reporting(0);
require("../../PHPMailer/class.phpmailer.php");
include('inc/dbase.php');

if(isset($_SESSION['adm_email']) == '') {
        header("location:log_in.php");
    }  
  $mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPSecure = "ssl";  
$mail->Host='smtp.gmail.com;smtp.mail.yahoo.com;smtp-mail.outlook.com';  
$mail->Port='465;587'; 
$mail->Username = "infoswoco@gmail.com";  // SMTP username
$mail->Password = "Swocotoken"; // SMTP password
$mail->SMTPKeepAlive = true;  
$mail->Mailer = "smtp"; 
$mail->IsSMTP(); // telling the class to use SMTP  
$mail->SMTPAuth   = true;                  // enable SMTP authentication  
$mail->CharSet = 'utf-8';  
$mail->SMTPDebug  = 0;   
$mail->Subject = 'Signup Verification';

// get email addresses from db based on checkboxes posted to us
$query = "select * from signup";

$result = mysqli_query($con,$query);
while( $data = mysqli_fetch_assoc($result) )
{
    // make SURE we are not sending this to each and every recipient incrementally.
    // alternately, you can use $mailer->ClearAllRecipients(); <-- this will clear cc and bcc as well
     // send it to THIS user...
    $mail->ClearAddresses();
$mail->From = $data['email'];
$mail->AddAddress($data['email']);
// set word wrap to 50 characters
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);
$message='<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title></title>
</head>
<body style="font-family:Gotham, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; background-color:#f0f2ea; margin:0; padding:0; color:#333333;">

<table width="100%" bgcolor="#f0f2ea" cellpadding="0" cellspacing="0" border="0" border-spacing="0">
    <tbody>
        <tr>
            <td style="padding:40px 0;">
                <!-- begin main block -->
                <table cellpadding="0" cellspacing="0" width="608" border="0" align="center">
                    <tbody style="
    box-shadow: 10px 10px 10px #00000075;
    border: 1px solid black;
">
                        <tr>
                            <td style="
           background-color: #ffffff;
    border: 4px solid #0f527fa1;
   
">
                                <a href="" style="margin: 0px 0px 0px 10px;">
                                    <img src="http://swoco.io/swoco/user/app-assets/images/logo/logo.png"  style="display: block;
    border: 0;
    margin: 0 auto;
    box-shadow: 10px 10px 10px #0000002b;
    border: 1px solid #e0e0e0fc;">
                                </a>
                                
                                <!-- begin wrapper -->
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody >
                                        <tr>
                                            <td width="8" height="4" colspan="2" style="background:url(shadow-top-left.png) no-repeat 100% 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td height="4" style="background:url(shadow-top-center.png) repeat-x 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="8" height="4" colspan="2" style="background:url(shadow-top-right.png) no-repeat 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td width="4" height="4" style="background:url(shadow-left-top.png) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td colspan="3" rowspan="3" bgcolor="#FFFFFF" style="">
                                                <!-- begin content -->
                                             
                                                
                                                <!-- begin articles -->
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: -webkit-linear-gradient(top, rgba(41, 137, 216, 0.93) 0%,rgba(41, 137, 216, 0.9) 15%,rgba(41,137,216,1) 19%,rgba(41,137,216,1) 50%,rgba(43,128,219,1) 54%,rgb(43, 128, 219) 81%,rgb(43, 128, 219) 85%,rgba(44, 136, 234, 0.9) 100%);">
                                                    <tbody>
													
													
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                               
                                                                <p style="font-size:14px; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px;"></p>
                                                                
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                           
                                                        </tr>
														
														
														<tr><td colspan="3">
                                                               
                                                                <p style="            font-size: 20px;
     text-align: center; 
    line-height: 22px;
    font-weight: bold;
    padding: 20px 40px;
    color: #FFEB3B;
    margin: 4px 0px 0px 0px;">
																Dear User,

																</p>
                                                                
                                                            </td></tr>
															
															<tr><td colspan="3">
                                                               
                                                               
                                                                
                                                            </td></tr>
															
															
															
															
															
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
															
                                                            <td colspan="3">
                                                                
                                                                <p style="    font-size: 16px;
    line-height: 22px;
   text-align: center; 
    font-weight: bold;
    color: #333333;
    padding: 0px 10px;
    margin: 10px 0px 0px 0px;"><a href="" style="color:white; text-decoration:none;">
															Kindly download your Swoco wallet & update your receiving address to get your Swoco coin in your wallet.

 </a></p>
 
 
 <p style="font-size: 14px;
    line-height: 22px;
    /* text-align: center; */
    
    color: #333333;
    padding: 0px 10px;
    /* margin: 0 0 5px; */
    margin: 10px 0px 0px 0px;"><a href="" style="color: #FFEB3B;
    text-decoration: none;
    font-size: 16px;">
																<!--<b>Email ID: <b> '.$signup_email.'-->

 </a></p>
 <p style="font-size: 14px;
    line-height: 22px;
    color: #333333;
	text-align:center;
    padding: 0px 10px;
    margin: 10px 0px 0px 0px;"><a href="" style="color:white; text-decoration:none;">
																 Please click on the following link to download Swoco wallet : 
 </a></p>
 


 
 
 
 
 
 
                                                                
																
																<p style="font-size: 14px;
																text-align:center;
    line-height: 22px;
    color: #333333;
    padding: 0px 10px;
    margin: 10px 0px 0px 0px; color:#FFEB3B;">Best Regards<br>

Team SWOCO.   </a></p>



<div style="text-align:center;">
<a href="https://www.swoco.io/#services" style="font-size: 14px;
    display:inline-block;
    line-height: 22px;
    color: #333333;
    padding: 0px 10px;
    margin: 10px 0px 0px 0px; color:white; "><img src="https://www.swoco.io/swoco/admin/app-assets/images/6.jpg" style="box-shadow: 10px 10px 10px #0000002b;">
	<p style="
   
    font-family: Open Sans;
    font-size: 18px;
    border: 1px solid;
    color: white;
    padding: 4px 0;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    -ms-border-radius: 20px;
    -o-border-radius: 20px;
    border-radius: 20px;
      
       background-color: #db70db;
    text-align: center;
    text-decoration: none;
"> Download </p>
	</a>

<a href="https://www.swoco.io/#services" style="font-size: 14px;
      display:inline-block;
    line-height: 22px;
    color: #333333;
    padding: 0px 10px;float:left;
    margin: 10px 0px 0px 0px; color:white; "><img src="https://www.swoco.io/swoco/admin/app-assets/images/5.jpg" style="box-shadow: 10px 10px 10px #0000002b;">
	
	<p style="
     font-family: Open Sans;
    font-size: 18px;
    border: 1px solid;
    color: white;
    padding: 4px 0;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    -ms-border-radius: 20px;
    -o-border-radius: 20px;
    border-radius: 20px;
      
       background-color: #db70db;
    text-align: center;
    text-decoration: none;
"> Download </p>
	</a>
</div>







																
																 
                                                            </td>
															
															
														
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- /end articles -->
                                               
                                               
                                                <!-- end content --> 
                                            </td>
                                            <td width="4" height="4" style="background:url(shadow-right-top.png) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td width="4" style="background:url(shadow-left-center.png) repeat-y 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" style="background:url(shadow-right-center.png) repeat-y 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        <tr> 
                                            <td width="4" height="4" style="background:url(shadow-left-bottom.png) repeat-y 100% 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(shadow-right-bottom.png) repeat-y 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                 
                                        <tr>
                                            <td width="4" height="4" style="background:url(shadow-bottom-corner-left.png) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(shadow-bottom-left.png) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td height="4" style="background:url(shadow-bottom-center.png) repeat-x 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(shadow-bottom-right.png) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(shadow-bottom-corner-right.png) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- end wrapper-->
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end main block -->
            </td>
        </tr>
    </tbody>
</table>


</body></html>';
$mail->Body    = $message;
$mail->AltBody = $message;
 print ($mail->Send()) ? "Message sent to: " : "Message <b>not</b> sent to: ";
    print $data["email"]."<br />\n";
  
}
          
           
?>