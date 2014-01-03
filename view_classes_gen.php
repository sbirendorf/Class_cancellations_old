<?Php
session_start();
 if (!isset($_SESSION['user_level'])) {?>
<meta http-equiv="refresh" content="0;URL=login/login_form.html">
<? exit;}  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Assumption College: Class Cancellations</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
.style1 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.style8 {font-size: 12px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: #000000; }
.style10 {color: #FF0099}
-->
</style></head>

<body>
<table width="746" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/class_cancel_admin.jpg" width="746" height="98"></td>
  </tr>
  <tr>
    <td width="827" height="129" valign="top" background="images/shield_back.jpg"><p><br>      
          <font face="Arial, Helvetica, sans-serif"><a href="add_cancellation.php"><strong>Add
              a Cancelled Class</strong></a></font> <font face="Arial, Helvetica, sans-serif">| <a href="login/logout.php"><strong>Log
              out </strong></a></font><br>      
      </p>
      <table width="400" border="1" cellspacing="0" cellpadding="2">
        <tr bgcolor="#FFCC66">
          <td width="120"><span class="style8">General Annoucement </span></td>
          <td width="61"><span class="style8">Date</span></td>
          <td width="80"><span class="style8">Time</span></td>
          <td width="113"><span class="style8">Commands</span></td>
        </tr>
        <?Php


     // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
	$query="select * from cancel_general order by general";
	$query_result=mysql_query($query);
	while ($row=mysql_fetch_array($query_result,MYSQL_NUM)) {
		
	
	$id=$row[0];
    $general=$row[1];
	
    $year = substr($date,0,4);
	$day = substr($date, 8,2);
	$month = substr($date, 5,2);
	$ispm=0;
	$hour = substr($date, 11,2);
	if ($hour>12) { $hour-=12; $ispm=1; }
	$min = substr($date, 14,2);
	?>
        <tr>
          <td><?Php echo $general; ?></td>
          <td><?Php print $month."/".$day."/".$year; ?></td>
          <td><?Php print $hour.":".$min; if ($ispm==1) {echo " PM";}  else echo " AM"; ?></td>
          <td><div align="center"><a href="delete_general.php?id=<? echo $id; ?>">[Delete Record]</a><br>
            </div></td>
        </tr>
        <?Php
        }
        mysql_close();
        exit;
        ?>
      </table>
    <p>&nbsp;</p>      <p align="center">&nbsp;</p>    </td>
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
</body>
</html>

