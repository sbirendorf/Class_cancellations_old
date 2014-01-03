<?Php
session_start();
 if (!isset($_SESSION['user_level'])) {?>
<meta http-equiv="refresh" content="0;URL=login/login_form.html">
<?PhP exit;}  
if($_SESSION['user_level'] != 2 && $_SESSION['user_level'] != 1){?>
<?Php exit;} ?>
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
.style8 {font-size: 12px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; color: #000000; }
.style1 {	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.style9 {
	font-size: 16px;
	color: #0000CC;
}
.style10 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
-->
</style></head>

<body>
<table width="746" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="827" height="129" valign="top"><p><br>      
          <font face="Arial, Helvetica, sans-serif"><!-- <a href="purge.php"><strong>Purge
          the Database </strong></a></font>| --><a href="add_cancellation.php" class="style8 style9">Add
          Another Class </a>| <a href="login/logout.php" class="style8 style9">Log
         Out </a><br>
    </p>
      <p class="style10">Note: You must print this screen in landscape!</p>      
      <table width="867" border="1" cellspacing="0" cellpadding="2">
        <tr bgcolor="#CCCCCC">
          <td width="151"><span class="style8">Professor</span></td>
          <td width="97"><span class="style8">Class Information </span></td>
          <td width="85"><span class="style8">Date</span></td>
          <td width="72"><span class="style8">Time</span></td>

          <td width="203" class="style8">Reason for Cancellation</td>
        </tr>
        <?Php


   // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
	$query="select * from print_classes order by id DESC";
	$query_result=mysql_query($query);
	while ($row=mysql_fetch_array($query_result,MYSQL_NUM)) {
		
	
	$id=$row[0];
	$prof_last=$row[3];
	$prof_first=$row[2];
	$course=$row[5];
	$section=$row[6];	
	$date=$row[1];	
	$room=$row[4];
	$title=$row[7];
	$reason=$row[9];
	/*
    $year = substr($date,0,4);
	$day = substr($date, 8,2);
	$month = substr($date, 5,2);
	$ispm=0;
	$hour = substr($date, 11,2);
	if ($hour>12) { $hour-=12; $ispm=1; }
	$min = substr($date, 14,2);
	*/
	//Ming 10/09/08 last update
	$c_date=date("m/d/Y",strtotime($date));
	$c_time=date("h:i A",strtotime($date));
	?>
        <tr valign="top">
          <td><?Php echo $prof_last; ?> , <? echo $prof_first; ?></td>
          <td><span class="style1"><strong>Room:</strong> <? echo $room; ?><br>
              <strong>Course:</strong> <? echo $course; ?> <br>
              <strong>Section: </strong><? echo $section; ?><br>
              <strong>Course Title: </strong><? echo $title; ?>              <br>
          </span></td>
          <td><?Php print $c_date;//$month."/".$day."/".$year; ?>
            <div align="center"></div></td>
          <td><?PhP print $c_time;//$hour.":".$min; if ($ispm==1) {echo " PM";}  else echo " AM"; ?></td>

          <td><span class="style1"><? echo $reason; ?></span></td>
        </tr>
        <?Php
        }
        mysql_close();
        exit;
        ?>
      </table>
    <p>&nbsp;</p>      <p align="center">&nbsp;</p>    </td>
  </tr>
</table>
</body>
</html>
