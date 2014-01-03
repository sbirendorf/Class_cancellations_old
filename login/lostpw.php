<?Php
// Title: lostpw.php
// Description:  This script recovers a lost password to the class cancelation site given the user's email address.
//
// :ast updated:  3/6/08 by Ryan Desroches
//



// Connect to the WWW database. 
require_once('../../../PhpConnections/AssumptionWWWConnect.php');

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
		include 'lost_pw.html';
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
			include 'lost_pw.html';
			exit();
		}
  	  else
  	  {
			// Everything looks ok, generate password, update it and send it!
			$random_password = makeRandomPassword();

			$db_password = md5($random_password);
	
			$sql = mysql_query("UPDATE users SET password='$db_password' WHERE email_address='$email_address'");
	
			$newLine = "\r\n"; //var just for nelines in MS
			$subject = "Your Password at the AC Class Cancellation System!";
			$message = "<p>Hi, we have reset your password. <br>
	
			New Password: $random_password <br>
	
			http://www.assumption.edu/cancel/login/login.php </p>
	
			<p> Thanks! </br>
			Web Staff </p>
	
			<p> This is an automated response, please do not reply! </p>";
	
			//$headers = 'From: WebStaff <webstaff@assumption.edu>' . "\r\n";
			//$headers .= "Reply-To: Web Staff <webstaff@assumption.edu>" . "\r\n";

			$headers = "Content-type: text/html; charset=iso-8859-1" . PHP_EOL; 
			$headers .= 'From: "Web Staff" <webstaff@assumption.edu>' . PHP_EOL .
		        'Reply-To: webstaff@assumption.edu' . PHP_EOL .
           		'Cc: "CC Name" <webstaff@assumption.edu>' . PHP_EOL .
           		'X-Mailer: PHP/' . phpversion();

			$from="webstaff@assumption.edu";
			$namefrom="Web Staff";

			$nameto=$email_address;
			authMail($nameto, $subject, $message, $headers);
			
			echo "Your password has been sent! Please check your email!<br />";
			include 'login_form.html';
		} // end else $swl_check_num ==0	
	} // end else (!email_address)
} // end function recover_pw

function authMail($to, $subject, $message, $headers)
{
mail($to, $subject, $message, $headers);
			echo "Your password has been sent! Please check your email!<br />";
exit;
/*  your configuration here  */

$smtpServer = "localhost"; //ip accepted as well
$port = "25"; // should be 25 by default
$timeout = "30"; //typical timeout. try 45 for slow servers
$username = ""; //the login for your smtp
$password = ""; //the pass for your smtp
$localhost = "127.0.0.1"; //this seems to work always
$newLine = "\r\n"; //var just for nelines in MS
$secure = 0; //change to 1 if you need a secure connect
  
/*  you shouldn't need to mod anything else */

//connect to the host and port
$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
$smtpResponse = fgets($smtpConnect, 4096);
if(empty($smtpConnect))
{
   $output = "Failed to connect: $smtpResponse";
   return $output;
}
else
{
   $logArray['connection'] = "Connected to: $smtpResponse";
}

//say HELO to our little friend
fputs($smtpConnect, "HELO $localhost". $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['heloresponse'] = "$smtpResponse";

//start a tls session if needed 
if($secure)
{
   fputs($smtpConnect, "STARTTLS". $newLine);
   $smtpResponse = fgets($smtpConnect, 4096);
   $logArray['tlsresponse'] = "$smtpResponse";

   //you have to say HELO again after TLS is started
   fputs($smtpConnect, "HELO $localhost". $newLine);
   $smtpResponse = fgets($smtpConnect, 4096);
   $logArray['heloresponse2'] = "$smtpResponse";
}

//request for auth login
fputs($smtpConnect,"AUTH LOGIN" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authrequest'] = "$smtpResponse";

//send the username
fputs($smtpConnect, base64_encode($username) . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authusername'] = "$smtpResponse";

//send the password
fputs($smtpConnect, base64_encode($password) . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['authpassword'] = "$smtpResponse";

//email from
fputs($smtpConnect, "MAIL FROM: $from" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['mailfromresponse'] = "$smtpResponse";

//email to
fputs($smtpConnect, "RCPT TO: $to" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['mailtoresponse'] = "$smtpResponse";

//the email
fputs($smtpConnect, "DATA" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['data1response'] = "$smtpResponse";

//construct headers
$headers = "MIME-Version: 1.0" . $newLine;
$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
//$headers .= "To: $nameto <$to>" . $newLine;
//$headers .= "From: $namefrom <$from>" . $newLine;

//observe the . after the newline, it signals the end of message
fputs($smtpConnect, "From: $namefrom<$from>\r\nTo: $nameto<$to>\r\nSubject: $subject\r\n$headers\r\n\r\n$message\r\n.\r\n");
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['data2response'] = "$smtpResponse";

// say goodbye
fputs($smtpConnect,"QUIT" . $newLine);
$smtpResponse = fgets($smtpConnect, 4096);
$logArray['quitresponse'] = "$smtpResponse";
$logArray['quitcode'] = substr($smtpResponse,0,3);
fclose($smtpConnect);
//a return value of 221 in $retVal["quitcode"] is a success 
return($logArray);
}



?>
