<?

include 'db.php';

// Define post fields into simple variables
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$username = $_POST['username'];
$info = $_POST['info'];

/* Let's strip some slashes in case the user entered
any escaped characters. */

$first_name = stripslashes($first_name);
$last_name = stripslashes($last_name);
$email_address = stripslashes($email_address);
$username = stripslashes($username);
$info = stripslashes($info);


/* Do some error checking on the form posted fields */

if((!$first_name) || (!$last_name) || (!$email_address) || (!$username)){
	echo 'You did not submit the following required information! <br />';
	if(!$first_name){
		echo "First Name is a required field. Please enter it below.<br />";
	}
	if(!$last_name){
		echo "Last Name is a required field. Please enter it below.<br />";
	}
	if(!$email_address){
		echo "Email Address is a required field. Please enter it below.<br />";
	}
	if(!$username){
		echo "Desired Username is a required field. Please enter it below.<br />";
	}
	include 'join_form.html'; // Show the form again!
	/* End the error checking and if everything is ok, we'll move on to
	 creating the user account */
	exit(); // if the error checking has failed, we'll exit the script!
}
	
/* Let's do some checking and ensure that the user's email address or username
 does not exist in the database */
 
 $sql_email_check = mysql_query("SELECT email_address FROM users WHERE email_address='$email_address'");
 $sql_username_check = mysql_query("SELECT username FROM users WHERE username='$username'");
 
 $email_check = mysql_num_rows($sql_email_check);
 $username_check = mysql_num_rows($sql_username_check);
 
 $sql_email_second_check = mysql_query("SELECT email FROM allowed_emails WHERE email='$email_address'");
 $email_second_check = mysql_num_rows($sql_email_second_check); 
 
 
 
 if(($email_check > 0) || ($username_check > 0) || (!$email_second_check)){
 	echo "Please fix the following errors: <br />";
 	if($email_check > 0){
 		echo "<strong>Your email address has already been used by another member in our database. Please submit a different Email address!<br />";
 		unset($email_address);
 	}
	
	if($email_second_check < 1){
		echo "<strong>Your email address is not on the allow access list. Please email ahoffman@assumption.edu<br />";
 		unset($email_address);
 	}
	
 	if($username_check > 0){
 		echo "The username you have selected has already been used by another member in our database. Please choose a different Username!<br />";
 		unset($username);
 	}
 	include 'join_form.html'; // Show the form again!
 	exit();  // exit the script so that we do not create this account!
 }
 
/* Everything has passed both error checks that we have done.
It's time to create the account! */

/* Random Password generator. 
http://www.phpfreaks.com/quickcode/Random_Password_Generator/56.php

We'll generate a random password for the
user and encrypt it, email it and then enter it into the db.
*/

function makeRandomPassword() {
  $salt = "abchefghjkmnpqrstuvwxyz0123456789";
  srand((double)microtime()*1000000); 
  	$i = 0;
  	while ($i <= 7) {
    		$num = rand() % 33;
    		$tmp = substr($salt, $num, 1);
    		$pass = $pass . $tmp;
    		$i++;
  	}
  	return $pass;
}

$random_password = makeRandomPassword();

$db_password = md5($random_password);

// Enter info into the Database.
$info2 = htmlspecialchars($info);
$sql = mysql_query("INSERT INTO users (first_name, last_name, email_address, username, password, info, signup_date)
		VALUES('$first_name', '$last_name', '$email_address', '$username', '$db_password', '$info2', now())") or die (mysql_error());

if(!$sql){
	echo 'There has been an error creating your account. Please contact the webmaster.';
} else {
	$userid = mysql_insert_id();
	// Let's mail the user!
	$subject = "Welcome to the AC Class Cancelation System!";
	$message = "Dear $first_name $last_name,<br>
	Thank you for register to be an administrator for our class cancelation web site, http://www.assumption.edu/class/!
	
	<br>You are two steps away from logging in and accessing our exclusive members area.
	
	<br>To activate your membership, please click here: 
	
	<br><a href='http://www.assumption.edu/cancel/login/activate.php?id=$userid&code=$db_password'>http://www.assumption.edu/cancel/login/activate.php?id=$userid&code=$db_password</a>
	
	<br>Once you activate your memebership, you will be able to login with the following information:
	<br>Username: $username
	<br>Password: $random_password
	
	<br>Thanks!
	
	
	<br><b>This is an automated response, please do not reply!</b>";
	
	//another_mail($email_address, $subject, $message);
	$headers .= 'From: Ming Sun <msun@assumption.edu>' . "\r\n";
	$headers .= "Reply-To: Ming Sun<msun@assumption.edu>" . "\r\n";
	// Mail it
	//mail($to, $subject, $confirmmsg, $headers);
	
	$from="msun@assumption.edu";
	$namefrom="Ming Sun";
	//$to="mingsun001@yahoo.com";
	$nameto=$email_address;
	//$subject="Colloquium Registration";
	//$message="OK";
	authMail($from, $namefrom, $email_address, $nameto, $subject, $message);
	echo "$subject <br> $message<br>";
	
	echo '<br>Your membership information has been mailed to your email address! Please check it and follow the directions!';
}

function authMail($from, $namefrom, $to, $nameto, $subject, $message)
{

/*  your configuration here  */

$smtpServer = "exchangefe.assumption.edu"; //ip accepted as well
$port = "25"; // should be 25 by default
$timeout = "30"; //typical timeout. try 45 for slow servers
$username = "colloquiumreg"; //the login for your smtp
$password = "creg2007"; //the pass for your smtp
$localhost = "127.0.0.1"; //this seems to work always
$newLine = "\r\n"; //var just for nelines in MS
$secure = 1; //change to 1 if you need a secure connect
  
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

/****************************************************************
 * another_mail() the function that actually sends the mail	*
 ****************************************************************/
function another_mail($to,$subject,$message)
{
// Could get this from the php ini?
$headers="";
//if ($_POST['email']==""){
$from="msun@assumption.edu";
//else $from=$_POST['email'];
list($me,$mydomain) = split("@",$from);

// Now look up the mail exchangers for the recipient
list($user,$domain) = split("@",$to,2);
if(getmxrr($domain,$mx,$weight) == 0) return FALSE;
// Try them in order of lowest weight first
array_multisort($mx,$weight);
$success=0;

foreach($mx as $host) {
 // Open an SMTP connection
 $connection = fsockopen ($host, 25, $errno, $errstr, 1);
 if (!$connection)
continue;

 $res=fgets($connection,256);
if(substr($res,0,3) != "220") break;


 // Introduce ourselves
 fputs($connection, "HELO $mydomain\n");
$res=fgets($connection,256);
 if(substr($res,0,3) != "250") break;


 // Envelope from
 fputs($connection, "MAIL FROM: $from\n");
 $res=fgets($connection,256);
if(substr($res,0,3) != "250") break;



 // Envelope to
 fputs($connection, "RCPT TO: $to\n");
$res=fgets($connection,256);
 if(substr($res,0,3) != "250") break;

 // The message
 fputs($connection, "DATA\n");
 $res=fgets($connection,256);
if(substr($res,0,3) != "354") break;


 // Send To:, From:, Subject:, other headers, blank line, message, and finish
 // with a period on its own line.
 fputs($connection, "To: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");
$res=fgets($connection,256);
 if(substr($res,0,3) != "250") break;

 // Say bye bye
fputs($connection,"QUIT\n");
$res=fgets($connection,256);
 if(substr($res,0,3) != "221") break;


 // It worked! So break out of the loop which tries all the mail exchangers.
 $success=1;
 break;
}
// Debug for if we fall over - uncomment as desired
// print $success?"Mail sent":"Failure: $res\n";
if($connection) {
 if($success==0) fputs($connection, "QUIT\n");
 fclose ($connection);
}
return $success?TRUE:FALSE;
}
?>