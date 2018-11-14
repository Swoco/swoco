<?php
include('dbase.php');
if(isset($_POST['email']))
{
	$email=$_POST['email'];
	$sql = "SELECT email FROM milkyway_usersignup WHERE email = '$email'";
	$select = mysqli_query($con,$sql);
	if(mysqli_num_rows($select)>0)
	{
		echo "This User Email Id Already registered !!!";
	}


}
?>