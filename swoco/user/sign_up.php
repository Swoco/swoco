<?php
error_reporting(0);
include('../inc/dbase.php');
require("../../PHPMailer/class.phpmailer.php");
if($_SESSION['user_id'] != '')
{
    header('location:'. $root_path_user);
}
if(isset($_GET['p']) && $_GET['p'] != '')
{
    $offer_path = '?p='.$_GET['p'].'&rnd_c='.$_GET['rnd_c'];
    $offer_path_url = '&p='.$_GET['p'].'&rnd_c='.$_GET['rnd_c'];
}
else
{
    $offer_path = '';
    $offer_path_url = '';
}

	if(isset($_POST['submit']))
  {
        $signup_name = mysqli_real_escape_string($con, trim($_POST['name']));
     $signup_lname = mysqli_real_escape_string($con, trim($_POST['lname']));
     $ccode=mysqli_real_escape_string($con,trim($_POST['countryCode']));
     $radio_val=$_POST['ok'];
     $name=$signup_name.' '.$signup_lname;
     $signup_name_mail = ucwords($signup_name.' '.$signup_lname);
     $signup_email = mysqli_real_escape_string($con, trim($_POST['email']));
     $signup_contact = mysqli_real_escape_string($con, trim($_POST['mob']));
     $signup_password_copy = mysqli_real_escape_string($con, trim($_POST['password']));
     $signup_password = mysqli_real_escape_string($con, md5(trim($_POST['cpassword'])));

     $signup_ref_code = mysqli_real_escape_string($con, trim($_POST['ref_code']));
  	if ((!empty($_POST["captcha"])) && ($_SESSION["code"]== $_POST["captcha"])) 
			{
    $reference_id = date('his').rand(0,99999999);
     $signup_name = mysqli_real_escape_string($con, trim($_POST['name']));
     $signup_lname = mysqli_real_escape_string($con, trim($_POST['lname']));
     $radio_val=$_POST['ok'];
     $name=$signup_name.' '.$signup_lname;
     $signup_name_mail = ucwords($signup_name.' '.$signup_lname);
     $signup_email = mysqli_real_escape_string($con, trim($_POST['email']));
     $signup_contact = mysqli_real_escape_string($con, trim($_POST['mob']));
     $signup_password_copy = mysqli_real_escape_string($con, trim($_POST['password']));
     $signup_password = mysqli_real_escape_string($con, md5(trim($_POST['cpassword'])));
$contactd='+'.$ccode.''.$signup_contact;
     $signup_ref_code = mysqli_real_escape_string($con, trim($_POST['ref_code']));
     $refernce_signup_url = $root_path_main.'sign_up.php?refci='.$reference_id;
     $reference_status = 'no';

     $chk_email_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `email`= '".$signup_email."'");

     if(mysqli_num_rows($chk_email_qry) > 0)
     {
      $signup_msg = '<div class="alert alert-danger" role="alert">OOPS! This email Id Already Registered with us</div>';
     }
     else
     {
     	if($_POST['password'] == $_POST['cpassword'])
     {
     $signup_add_date = date('Y-m-d h:i:s');
     $signup_status = "0";
     
     $chk_ref_qry = mysqli_query($con, "SELECT * FROM `milkyway_usersignup` WHERE `reference_id`= '".$signup_ref_code."'");

   
    //   if(mysqli_num_rows($chk_ref_qry) >0)
    //  {
if($signup_ref_code=='')
{
     $signup_sql = "INSERT INTO `milkyway_usersignup` (`reference_id`, `link_reference_id`,`name`, `email`, `contact`, `password`, `rnd_pass`, `signup_via`,`status`, `reference_status`, `reference_url`,`verification`, `date`) VALUES ('$reference_id','02563286649209','$name', '$signup_email', '$contactd', '$signup_password_copy', '$signup_password', 'WEB', '$signup_status', '$reference_status','$refernce_signup_url','true', '$signup_add_date')";
}
if($signup_ref_code!='')
{
      if(mysqli_num_rows($chk_ref_qry) >0)
     {
     $signup_sql = "INSERT INTO `milkyway_usersignup` (`reference_id`, `link_reference_id`,`name`, `email`, `contact`, `password`, `rnd_pass`, `signup_via`,`status`, `reference_status`, `reference_url`,`verification`, `date`) VALUES ('$reference_id','$signup_ref_code','$name', '$signup_email', '$contactd', '$signup_password_copy', '$signup_password', 'WEB', '$signup_status', '$reference_status','$refernce_signup_url','true', '$signup_add_date')";
}
    
}
// }
// else
// {
//   $signup_msg = '<div class="alert alert-danger" role="alert">OOPS! This Reference Id Not Registered with us</div>';  
// }
     $signup_query = mysqli_query($con, $signup_sql);
     if ($signup_query)
          {
          //	header('location:log_in.php');
          	  $signup_msg = '<div class="alert alert-success" role="alert">Register Successfully Done !!!</div>';
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
$mail->Subject = 'Signup Verification | '.$conf_comp_name;
$mail->From = $signup_email;
$mail->AddAddress($signup_email, $signup_name_mail );
// set word wrap to 50 characters
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);
// $email_message =
           // $to      = $signup_email; // Send email to our user
           // $subject = 'Signup Verification | '.$conf_comp_name; // Give the email a subject 
            $message = '<!DOCTYPE html>

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
    /* text-align: center; */
    line-height: 22px;
    font-weight: bold;
    padding: 20px 40px;
    color: #FFEB3B;
    margin: 4px 0px 0px 0px;">
																Dear  '.$signup_name_mail.',

																</p>
                                                                
                                                            </td></tr>
															
															<tr><td colspan="3">
                                                               
                                                                <p style="    font-size: 18px;
    /* text-align: center; */
    line-height: 22px;
    padding: 0px 40px;
    font-weight: bold;
    color: white;
    margin: -15px 0px 0px 0px;">Welcome to Swoco. 
</p>
                                                                
                                                            </td></tr>
															
															
															
															
															
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
															
                                                            <td colspan="3">
                                                                
                                                                <p style="    font-size: 16px;
    line-height: 22px;
    /* text-align: center; */
    font-weight: bold;
    color: #333333;
    padding: 0px 10px;
    margin: 10px 0px 0px 0px;"><a href="" style="color:white; text-decoration:none;">
																Your account has been registered with Swoco.
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
																<b>Email ID: <b> '.$signup_email.'

 </a></p>
 <p style="font-size: 14px;
    line-height: 22px;
    color: #333333;
    padding: 0px 10px;
    margin: 10px 0px 0px 0px;"><a href="" style="color:white; text-decoration:none;">
																 please click on the following link to activate your account: 
 </a></p>
 


 
 
 
 
 
 
                                                                
																
																<p style="font-size: 14px;
    line-height: 22px;
    color: #333333;
    padding: 0px 10px;
    margin: 10px 0px 0px 0px; color:white;">Best Regards<br>

Team SWOCO.   </a></p>
																 <p style="font-size:15px;  color:#333333; text-align:center;">
																 <a href="http://swoco.io/swoco/user/verify.php?uidcode='.md5($signup_email).$offer_path_url.'"" style="
    display: inline-block;
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
       width: 208px;
       background-color: #00bcff;
    text-align: center;
    text-decoration: none;
">Verifiy your Email</a>
																 </p>
																 
																 
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
if($mail->Send())
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html; Charset= iso-8859-1" . "\r\n";
// $headers .= "From: Swoco <info@swoco.io>" . "\r\n"; // Set from headers
                //if(mail($to, $subject, $message, $headers)) // Send our email  
                {
                  echo "<script>window.location.href='success.php?n=".$signup_name.$offer_path_url."'</script>";
                  /*$signup_msg = '<div class="alert alert-success" role="alert">Registered Successfully Please Verify Your Account</div>';*/
                }
                else
                {
                  $signup_msg = '<div class="alert alert-danger captch_blan" role="alert">Registered Unsuccessfully.</div>';
                }
          } 
         else
          {
          $signup_msg = '<div class="alert alert-danger captch_blan" role="alert">OOPS! This Sponsor Id Not Registered with us !</div>';
         }
       }
    
     else
     {
     	  $signup_msg = '<div class="alert alert-danger captch_blan" role="alert">Oops Password mismatch !!!</div>';
     }
    }
  }
   else
   {
    $signup_msg = '<div class="alert alert-danger captch_blan" role="alert">Oops captcha incorrect !!!"</div>';
   	
   }
 }
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Swoco Register</title>
      
        <link rel="stylesheet" href="app-assets/css/bootstrap3.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/user_style_login_signup_form.css">
        <link rel="shortcut icon" href="app-assets/images/ico/apple-icon-120.png">
</head>
<body>
          <div class="top-content">
        	<div class="header_sign_up">
			  <div class="inner-bg">
			 <div class="container">
                 <div class="row">
                       <div class="col-sm-6">
						 </div>
					    <div class="col-sm-6 text-right">
						<a class="te_wh" href="log_in.php"><button type="button" class=" btn btn-success  btn-rounded btn-outline"> Log in</button></a>
					   </div>
					 </div>
                 </div>	
					</div>		
					</div>		
				 <div class="container">
                  <div class="row">
                        <div class="col-sm-5 col-sm-offset-1 pad-0-add">
						 <div class="form-box Sign_up_style">
						     
						 <img class="img-responsive equal_he" src="app-assets/images/bg_for_signup/log_in.jpg" >
						  </div>	
                         </div>	
                        <div class="col-sm-5 pad-0-add">
                        	
                        	<div class="form-box Sign_up_style">
                        	    	<div class="equal_heig">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
	                            		<p>Fill the form & create your account in Swoco</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
	                            	 <?php if(!empty($signup_msg)) { echo $signup_msg; } ?>
				                    <form role="form" action="" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">First Name</label>
				                        	<input type="text" name="name" placeholder="First Name..." class="form-first-name form-control" id="form-first-name" required="required" value="<?php echo  $signup_name ;?>">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name">Last Name</label>
				                        	<input type="text" name="lname" placeholder="Last Name..." class="form-last-name form-control" id="form-last-name" required="required" value="<?php echo  $signup_lname ;?>">
				                        </div>
										
										 <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email ID
</label>
				                        	<input type="email" name="email" placeholder="Email ID" class="form-email form-control" id="form-email" required="required" value="<?php echo  $signup_email ;?>">
				                        </div>
										
										<div class="form-group" style='position:relative;'style="
    padding: 0px 0px 0px 60px;
"> 
										
										<div class="form-group">
<select name="countryCode" class="sel_style_new" >
	<option data-countryCode="GB" value="44" Selected>UK (+44)</option>
	<option data-countryCode="US" value="1">USA (+1)</option>
	<optgroup label="Other countries">
	  
		<option data-countryCode="DZ" value="213">Algeria (+213)</option>
		<option data-countryCode="AD" value="376">Andorra (+376)</option>
		<option data-countryCode="AO" value="244">Angola (+244)</option>
		<option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
		<option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
		<option data-countryCode="AR" value="54">Argentina (+54)</option>
		<option data-countryCode="AM" value="374">Armenia (+374)</option>
		<option data-countryCode="AW" value="297">Aruba (+297)</option>
		<option data-countryCode="AU" value="61">Australia (+61)</option>
		<option data-countryCode="AT" value="43">Austria (+43)</option>
		<option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
		<option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
		<option data-countryCode="BH" value="973">Bahrain (+973)</option>
		<option data-countryCode="BD" value="880">Bangladesh (+880)</option>
		<option data-countryCode="BB" value="1246">Barbados (+1246)</option>
		<option data-countryCode="BY" value="375">Belarus (+375)</option>
		<option data-countryCode="BE" value="32">Belgium (+32)</option>
		<option data-countryCode="BZ" value="501">Belize (+501)</option>
		<option data-countryCode="BJ" value="229">Benin (+229)</option>
		<option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
		<option data-countryCode="BT" value="975">Bhutan (+975)</option>
		<option data-countryCode="BO" value="591">Bolivia (+591)</option>
		<option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
		<option data-countryCode="BW" value="267">Botswana (+267)</option>
		<option data-countryCode="BR" value="55">Brazil (+55)</option>
		<option data-countryCode="BN" value="673">Brunei (+673)</option>
		<option data-countryCode="BG" value="359">Bulgaria (+359)</option>
		<option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
		<option data-countryCode="BI" value="257">Burundi (+257)</option>
		<option data-countryCode="KH" value="855">Cambodia (+855)</option>
		<option data-countryCode="CM" value="237">Cameroon (+237)</option>
		<option data-countryCode="CA" value="1">Canada (+1)</option>
		<option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
		<option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
		<option data-countryCode="CF" value="236">Central African Republic (+236)</option>
		<option data-countryCode="CL" value="56">Chile (+56)</option>
		<option data-countryCode="CN" value="86">China (+86)</option>
		<option data-countryCode="CO" value="57">Colombia (+57)</option>
		<option data-countryCode="KM" value="269">Comoros (+269)</option>
		<option data-countryCode="CG" value="242">Congo (+242)</option>
		<option data-countryCode="CK" value="682">Cook Islands (+682)</option>
		<option data-countryCode="CR" value="506">Costa Rica (+506)</option>
		<option data-countryCode="HR" value="385">Croatia (+385)</option>
		<option data-countryCode="CU" value="53">Cuba (+53)</option>
		<option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
		<option data-countryCode="CY" value="357">Cyprus South (+357)</option>
		<option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
		<option data-countryCode="DK" value="45">Denmark (+45)</option>
		<option data-countryCode="DJ" value="253">Djibouti (+253)</option>
		<option data-countryCode="DM" value="1809">Dominica (+1809)</option>
		<option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
		<option data-countryCode="EC" value="593">Ecuador (+593)</option>
		<option data-countryCode="EG" value="20">Egypt (+20)</option>
		<option data-countryCode="SV" value="503">El Salvador (+503)</option>
		<option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
		<option data-countryCode="ER" value="291">Eritrea (+291)</option>
		<option data-countryCode="EE" value="372">Estonia (+372)</option>
		<option data-countryCode="ET" value="251">Ethiopia (+251)</option>
		<option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
		<option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
		<option data-countryCode="FJ" value="679">Fiji (+679)</option>
		<option data-countryCode="FI" value="358">Finland (+358)</option>
		<option data-countryCode="FR" value="33">France (+33)</option>
		<option data-countryCode="GF" value="594">French Guiana (+594)</option>
		<option data-countryCode="PF" value="689">French Polynesia (+689)</option>
		<option data-countryCode="GA" value="241">Gabon (+241)</option>
		<option data-countryCode="GM" value="220">Gambia (+220)</option>
		<option data-countryCode="GE" value="7880">Georgia (+7880)</option>
		<option data-countryCode="DE" value="49">Germany (+49)</option>
		<option data-countryCode="GH" value="233">Ghana (+233)</option>
		<option data-countryCode="GI" value="350">Gibraltar (+350)</option>
		<option data-countryCode="GR" value="30">Greece (+30)</option>
		<option data-countryCode="GL" value="299">Greenland (+299)</option>
		<option data-countryCode="GD" value="1473">Grenada (+1473)</option>
		<option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
		<option data-countryCode="GU" value="671">Guam (+671)</option>
		<option data-countryCode="GT" value="502">Guatemala (+502)</option>
		<option data-countryCode="GN" value="224">Guinea (+224)</option>
		<option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
		<option data-countryCode="GY" value="592">Guyana (+592)</option>
		<option data-countryCode="HT" value="509">Haiti (+509)</option>
		<option data-countryCode="HN" value="504">Honduras (+504)</option>
		<option data-countryCode="HK" value="852">Hong Kong (+852)</option>
		<option data-countryCode="HU" value="36">Hungary (+36)</option>
		<option data-countryCode="IS" value="354">Iceland (+354)</option>
		<option data-countryCode="IN" value="91">India (+91)</option>
		<option data-countryCode="ID" value="62">Indonesia (+62)</option>
		<option data-countryCode="IR" value="98">Iran (+98)</option>
		<option data-countryCode="IQ" value="964">Iraq (+964)</option>
		<option data-countryCode="IE" value="353">Ireland (+353)</option>
		<option data-countryCode="IL" value="972">Israel (+972)</option>
		<option data-countryCode="IT" value="39">Italy (+39)</option>
		<option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
		<option data-countryCode="JP" value="81">Japan (+81)</option>
		<option data-countryCode="JO" value="962">Jordan (+962)</option>
		<option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
		<option data-countryCode="KE" value="254">Kenya (+254)</option>
		<option data-countryCode="KI" value="686">Kiribati (+686)</option>
		<option data-countryCode="KP" value="850">Korea North (+850)</option>
		<option data-countryCode="KR" value="82">Korea South (+82)</option>
		<option data-countryCode="KW" value="965">Kuwait (+965)</option>
		<option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
		<option data-countryCode="LA" value="856">Laos (+856)</option>
		<option data-countryCode="LV" value="371">Latvia (+371)</option>
		<option data-countryCode="LB" value="961">Lebanon (+961)</option>
		<option data-countryCode="LS" value="266">Lesotho (+266)</option>
		<option data-countryCode="LR" value="231">Liberia (+231)</option>
		<option data-countryCode="LY" value="218">Libya (+218)</option>
		<option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
		<option data-countryCode="LT" value="370">Lithuania (+370)</option>
		<option data-countryCode="LU" value="352">Luxembourg (+352)</option>
		<option data-countryCode="MO" value="853">Macao (+853)</option>
		<option data-countryCode="MK" value="389">Macedonia (+389)</option>
		<option data-countryCode="MG" value="261">Madagascar (+261)</option>
		<option data-countryCode="MW" value="265">Malawi (+265)</option>
		<option data-countryCode="MY" value="60">Malaysia (+60)</option>
		<option data-countryCode="MV" value="960">Maldives (+960)</option>
		<option data-countryCode="ML" value="223">Mali (+223)</option>
		<option data-countryCode="MT" value="356">Malta (+356)</option>
		<option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
		<option data-countryCode="MQ" value="596">Martinique (+596)</option>
		<option data-countryCode="MR" value="222">Mauritania (+222)</option>
		<option data-countryCode="YT" value="269">Mayotte (+269)</option>
		<option data-countryCode="MX" value="52">Mexico (+52)</option>
		<option data-countryCode="FM" value="691">Micronesia (+691)</option>
		<option data-countryCode="MD" value="373">Moldova (+373)</option>
		<option data-countryCode="MC" value="377">Monaco (+377)</option>
		<option data-countryCode="MN" value="976">Mongolia (+976)</option>
		<option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
		<option data-countryCode="MA" value="212">Morocco (+212)</option>
		<option data-countryCode="MZ" value="258">Mozambique (+258)</option>
		<option data-countryCode="MN" value="95">Myanmar (+95)</option>
		<option data-countryCode="NA" value="264">Namibia (+264)</option>
		<option data-countryCode="NR" value="674">Nauru (+674)</option>
		<option data-countryCode="NP" value="977">Nepal (+977)</option>
		<option data-countryCode="NL" value="31">Netherlands (+31)</option>
		<option data-countryCode="NC" value="687">New Caledonia (+687)</option>
		<option data-countryCode="NZ" value="64">New Zealand (+64)</option>
		<option data-countryCode="NI" value="505">Nicaragua (+505)</option>
		<option data-countryCode="NE" value="227">Niger (+227)</option>
		<option data-countryCode="NG" value="234">Nigeria (+234)</option>
		<option data-countryCode="NU" value="683">Niue (+683)</option>
		<option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
		<option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
		<option data-countryCode="NO" value="47">Norway (+47)</option>
		<option data-countryCode="OM" value="968">Oman (+968)</option>
		<option data-countryCode="PW" value="680">Palau (+680)</option>
		<option data-countryCode="PA" value="507">Panama (+507)</option>
		<option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
		<option data-countryCode="PY" value="595">Paraguay (+595)</option>
		<option data-countryCode="PE" value="51">Peru (+51)</option>
		<option data-countryCode="PH" value="63">Philippines (+63)</option>
		<option data-countryCode="PL" value="48">Poland (+48)</option>
		<option data-countryCode="PT" value="351">Portugal (+351)</option>
		<option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
		<option data-countryCode="QA" value="974">Qatar (+974)</option>
		<option data-countryCode="RE" value="262">Reunion (+262)</option>
		<option data-countryCode="RO" value="40">Romania (+40)</option>
		<option data-countryCode="RU" value="7">Russia (+7)</option>
		<option data-countryCode="RW" value="250">Rwanda (+250)</option>
		<option data-countryCode="SM" value="378">San Marino (+378)</option>
		<option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
		<option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
		<option data-countryCode="SN" value="221">Senegal (+221)</option>
		<option data-countryCode="CS" value="381">Serbia (+381)</option>
		<option data-countryCode="SC" value="248">Seychelles (+248)</option>
		<option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
		<option data-countryCode="SG" value="65">Singapore (+65)</option>
		<option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
		<option data-countryCode="SI" value="386">Slovenia (+386)</option>
		<option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
		<option data-countryCode="SO" value="252">Somalia (+252)</option>
		<option data-countryCode="ZA" value="27">South Africa (+27)</option>
		<option data-countryCode="ES" value="34">Spain (+34)</option>
		<option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
		<option data-countryCode="SH" value="290">St. Helena (+290)</option>
		<option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
		<option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
		<option data-countryCode="SD" value="249">Sudan (+249)</option>
		<option data-countryCode="SR" value="597">Suriname (+597)</option>
		<option data-countryCode="SZ" value="268">Swaziland (+268)</option>
		<option data-countryCode="SE" value="46">Sweden (+46)</option>
		<option data-countryCode="CH" value="41">Switzerland (+41)</option>
		<option data-countryCode="SI" value="963">Syria (+963)</option>
		<option data-countryCode="TW" value="886">Taiwan (+886)</option>
		<option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
		<option data-countryCode="TH" value="66">Thailand (+66)</option>
		<option data-countryCode="TG" value="228">Togo (+228)</option>
		<option data-countryCode="TO" value="676">Tonga (+676)</option>
		<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
		<option data-countryCode="TN" value="216">Tunisia (+216)</option>
		<option data-countryCode="TR" value="90">Turkey (+90)</option>
		<option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
		<option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
		<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
		<option data-countryCode="TV" value="688">Tuvalu (+688)</option>
		<option data-countryCode="UG" value="256">Uganda (+256)</option>
		<!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
		<option data-countryCode="UA" value="380">Ukraine (+380)</option>
		<option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
		<option data-countryCode="UY" value="598">Uruguay (+598)</option>
		<!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
		<option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
		<option data-countryCode="VU" value="678">Vanuatu (+678)</option>
		<option data-countryCode="VA" value="379">Vatican City (+379)</option>
		<option data-countryCode="VE" value="58">Venezuela (+58)</option>
		<option data-countryCode="VN" value="84">Vietnam (+84)</option>
		<option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
		<option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
		<option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
		<option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
		<option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
		<option data-countryCode="ZM" value="260">Zambia (+260)</option>
		<option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
	</optgroup>
</select>
										    
										<!--<select class="sel_style_new">-->
          <!--                              <option value="91">91</option>-->
          <!--                              <option value="42">42</option>-->
          <!--                              <option value="45">45</option>-->
          <!--                              <option value="46">46</option>-->
          <!--                              </select>-->
				                    		<label class="sr-only" for="form-Contact-No">Contact No</label>
				                        	<input type="text" name="mob" placeholder="Contact No..." class="form-first-name form-control input_new_style" id="form-contact" required="required" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php echo  $signup_contact ;?>" >
				                        </div>
										
										
										
										<div class="form-group">
				                    	<div class="Sponser_id"> <b>Do you have Sponsor ID ?</b></div>
				                        </div>
										<?php if(isset($_GET['refci']) && $_GET['refci'] != '') { ?>
                          <div class="form-group">
                          <input type="text" class="form-control" placeholder="Referral code *" name="ref_code" autocomplete="off" readonly="readonly" value="<?php echo $_GET['refci']; ?>">
                        </div>
                          <?php }
                          else
                          {?>
										
										<div class="form-group label_margin">
										 <label class="radio-inline te_wh yes_Sponser_id" >
                                 <input type="radio" value="yes" name="ok" >Yes
                                 </label>
                                  <label class="radio-inline te_wh no_Sponser_id " >
                                 <input type="radio" value="no"  name="ok" checked>No
                                    </label>
                                        </div>
	                                   <div class="form-group">
				                    		<label class="sr-only" for="form-Contact-No"> Sponser id</label>
				                        	<input type="text" name="ref_code" placeholder="Entre Your Sponser id" class="form-first-name form-control Sponser_id_show_off" id="form-sponsor" value="<?php echo  $signup_ref_code ;?>">
				                        </div>
				                        <?php }?>
										<label class="sr-only" for="form-Contact-No">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-first-name form-control" id="form-password" required="required">
				                        </div>
										<div class="form-group">
				                    		<label class="sr-only" for="form-Contact-No">Confirm Password</label>
				                        	<input type="password" name="cpassword" placeholder="Confirm Password..." class="form-first-name form-control" id="form-cpassword" required="required" >
				                        </div>
										<!-- <div class="form-group">
				                        	<label class="sr-only" for="form-about-yourself">About yourself</label>
				                        	<textarea name="form-about-yourself" placeholder="About yourself..." 
				                        				class="form-about-yourself form-control" id="form-about-yourself"></textarea>
				                        </div> -->
									
											<div class="form-group"><div id="imgdiv"><img id="img" src="captch.php"  /><img id="reload" src="app-assets/images/reload.png" /></div></div>
												<div class="form-group">
				                    		<label class="sr-only" for="form-Contact-No">captch</label>
				                        	<input type="text" name="captcha" placeholder="captch" class="form-captcha form-control captch_blan" id="form-captcha" autocomplete="off">
				                        </div>
				                        <button type="submit" class=" btn btn-success  btn-rounded btn-outline" name="submit"><a class="te_wh" >Join Now</a></button>
				                    </form>
			                    </div>
			                     </div>
                        	</div>
                       </div>
                    </div>
                 </div>
            </div>
         </div>
<!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script src="app-assets/js/scripts/script.js"></script>
      <script>
$(document).ready(function(){ 
  $('.yes_Sponser_id').click(function(){
 $('.Sponser_id_show_off').show()
   var divHeight = $('.equal_heig').height(); 
        $('.equal_he').css('height', divHeight+'px');
})

 
$(document).ready(function(){
 $('.no_Sponser_id').click(function(){
  $('.Sponser_id_show_off').hide()
    $('.equal_he').height('614px');
    
    if($('.captch_blan') == '' )
    
    { $('.equal_he').height('609px'); }
    
  })
 })
})


$(document).ready(function(){ 
  $('.Sign_up_style .alert-danger').fadeOut(4000)
})     
    

</script>
	
</body>
</html>