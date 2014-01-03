<?Php
session_start();
 if (!isset($_SESSION['user_level'])) {?>
<meta http-equiv="refresh" content="0;URL=login/login_form.html">
<?PhP exit;}  
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
      <table width="758" border="1" cellspacing="0" cellpadding="2">
        <tr bgcolor="#FFCC66">
          <td width="120"><span class="style8">Professor</span></td>
          <td width="108"><span class="style8">Course Number</span></td>
          <td width="122"><span class="style8">Course Title</span></td>
          <td width="110"><span class="style8">Room Number </span></td>
          <td width="61"><span class="style8">Date</span></td>
          <td width="80"><span class="style8">Time</span></td>
          <td width="113"><span class="style8">Commands</span></td>
        </tr>
        <?Php


     // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
	$query="select * from class_cancel order by prof_last";
	$query_result=mysql_query($query);
	while ($row=mysql_fetch_array($query_result,MYSQL_NUM)) {
		
	
	$id=$row[0];
	$prof_last=$row[3];
	$prof_first=$row[2];
	$course=$row[5];
	$section=$row[6];	
	$title=$row[7];
	$date=$row[1];	
	$room=$row[4];
	$comments=$row[8];
	$reason=$row[9];
	/*
    $year = substr($date,0,4);
	$day = substr($date, 8,2);
	$month = substr($date, 5,2);
	$ispm=0;
	$hour = substr($date, 11,2);
	if ($hour>11) { $hour-=12; $ispm=1; }
	if ($hour<1) { $hour=12; }
	$min = substr($date, 14,2);
	*/
	//Ming 10/09/08 last update
	$c_date=date("m/d/Y",strtotime($date));
	$c_time=date("h:i A",strtotime($date));
	?>
        <tr>
          <td><?Php echo $prof_last; ?> , <? echo $prof_first; ?></td>
          <td><?Php echo $course; ?></td>
          <td><?Php echo $title; ?></td>
          <td><?Php echo $room; ?></td>
          <td><?Php print $c_date;//$month."/".$day."/".$year; ?></td>
          <td><?Php print $c_time;//$hour.":".$min; if ($ispm==1) {echo " PM";}  else echo " AM"; ?></td>
          <td><div align="center"><a href="delete.php?id=<? echo $id; ?>">[Delete Record]</a><br>
            <a href="details.php?id=<? echo $id; ?>">[View Details] </a></div></td>
        </tr>
        <?Php }
        mysql_close();
        exit;
        ?>
      </table>
    <p>&nbsp;</p>      <p align="center">&nbsp;</p>    </td>
  </tr>
  <tr>
    <td><div align="center" class="style1"></div></td>
  </tr>
</table>
</body>
</html>
