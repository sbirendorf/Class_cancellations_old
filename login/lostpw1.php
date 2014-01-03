<?Php
// Title: lostpw1.php
// Description:  This script recovers a lost password to the class cancelation site given the user's email address.
//
//
// Connect to the WWW database. 
include 'db.php';

if (isset($_POST['email_address']))
{	
		recover_pw($_POST['email_address']);
}
else
{
		recover_pw("Null");
}


// This function actually makes the password.
function makeRandomPassword() 
{
  		$salt = "abchefghjkmnpqrstuvwxyz0123456789";
  		srand((double)microtime()*1000000); 
	  	$i = 0;
	  	while ($i <= 7) 
	  	{
	    		$num = rand() % 33;
	    		$tmp = substr($salt, $num, 1);
	    		if (isset($pass))
	    		{
	    			$pass = $pass . $tmp;
	    		}
	    		else
	    		{
	    			$pass = $tmp;
	    		}
	    		$i++;
	  	}
	  	return $pass;
	  	
} // end makeRandomPassword()


function recover_pw($email_address)
{
	if ($email_address == "Null")
	{
		echo "You forgot to enter your Email address.";
		include 'lost_pw1_form.php';
		exit();
	}
	else
	{
		// quick check to see if record exists	
		$sql_check = mysql_query("SELECT * FROM users WHERE email_address='$email_address'");
		$sql_check_num = mysql_num_rows($sql_check);
		if($sql_check_num == 0)
		{
			echo "No records found matching your email address<br />";
			include 'lost_pw1_form.php';
			exit();
		}
  	  else
  	  {
			// Everything looks ok, generate password, update it and send it!
			$random_password = makeRandomPassword();
			$db_password = md5($random_password);
	
			$sql = mysql_query("UPDATE users SET password='$db_password' WHERE email_address='$email_address' AND activated='1'");
	
			$subject = "Your Password at the AC Class Cancellation System!";
			$message = "<p>Hi, we have reset your password. <br>
	
			New Password: $random_password <br>
			http://www.assumption.edu/cancel/login/login.php </p>
			<p> Thanks! </br>
			Web Staff </p>
			<p> This is an automated response, please do not reply! </p>";
	//////////////////////////////////////////////////////////////////////////////
			
			$headers = "Content-type: text/html; charset=iso-8859-1" . PHP_EOL; 
			$headers .= 'From: "Web Staff" <webstaff@assumption.edu>' . PHP_EOL .
		        'Reply-To: webstaff@assumption.edu' . PHP_EOL .
           		'Cc: "CC Name" <webstaff@assumption.edu>' . PHP_EOL .
           		'X-Mailer: PHP/' . phpversion();

			$from="webstaff@assumption.edu";
			$namefrom="Web Staff";

			$nameto=$email_address;
			mail($email_address,$subject,$message,$headers);
			
			echo "Your password has been sent! Please check your email!<br />";
			include 'login_form1.php';
		} // end else $swl_check_num ==0	
	} // end else (!email_address)
} // end function recover_pw


?>
