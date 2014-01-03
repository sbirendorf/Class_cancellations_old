<?Php
session_start();

echo "Welcome ". $_SESSION['first_name'] ." ". $_SESSION['last_name'] ."! You have made it to the admin area!<br /><br />";


if($_SESSION['user_level'] == 1){

if ($_POST['email']){
//code to add the email goes here
$email=$_POST['email'];

	 // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
	$query="insert into allowed_emails (email) values 
('$email')";
	mysql_query($query);
	?>
	<meta http-equiv="refresh" content="0;URL=useradmin.php">

	<?Php
}
else {

Echo "Currently allowed emails:<br><Br>";


	$query="select * from allowed_emails order by email";
	$query_result=mysql_query($query);
	?> 
	          <title>Assumption College: Class Cancellation Site</title><font face="Arial, Helvetica, sans-serif"><a href="../view_classes.php"><strong>View
	          Canceled Classes</strong></a> | <a href="logout.php"><strong>Log
	          out </strong></a></font><br>
	          <br>
	<table>
	<?Php
	while ($row=mysql_fetch_array($query_result,MYSQL_NUM)) {
		
	
	$id=$row[0];
	$email=$row[1];
		
    	?>
        <tr>
          <td><?Php echo $email; ?></td>
          <td><a href="delete.php?&id=<? echo $id; ?>">[Delete Record]</a></td>
        </tr>
        <?Php
        }
        mysql_close();
        exit;
        ?>
    </table>
    <p>&nbsp;</p>      
    <form name="form1" method="post" action="useradmin.php">
      <p>Add an email: 
        <input name="email" type="text" id="email">
</p>
      <p>
        <input type="submit" name="Submit" value="Submit">    
      </p>
    </form>
    <p align="left">&nbsp;</p>    
    </td>
  </tr>
  <tr>
    <td><div align="center" class="style1"><a href="http://www.assumption.edu/default.html">Home</a> | <a href="http://www.assumption.edu/about/default.html">About
            Assumption</a> | <a href="http://www.assumption.edu/acad/default.html">Academics</a> | <a href="http://www.assumption.edu/alums/default.html">Alumni/Development</a> | <a href="http://www.assumption.edu/dept/Athletics/sportsinfo.html">Athletics</a><br>
          <a href="http://www.assumption.edu/stulife/default.html">Campus Life</a> | <a href="http://www.assumption.edu/gradce/conted/default.html">Continuing
          Education</a> | <a href="http://www.assumption.edu/gradce/grad/default.html">Graduate
          Studies</a> | <a href="http://www.assumption.edu/dept/Library/libraryindex.html">Library</a><br>
              <a href="http://www.assumption.edu/news/default.html">News and
              Events</a> | <a href="http://www.assumption.edu/admiss/udefault.html">Undergraduate
    Studies</a></div></td>
  </tr>
</table>
<?
}
}
else {
echo "You do not have access to this page.";
}



echo "<br /><a href=logout.php>Logout</a>";

?>