<?php
session_start();
 if (!isset($_SESSION['user_level'])) {?>
<meta http-equiv="refresh" content="0;URL=login/login_form.html">
<?php exit;}  

$id=$_GET["id"];

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
.style2 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style></head>

<body>
<img src="images/class_cancel_admin.jpg" width="746" height="98"><br>
<table width="746" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td width="827" height="129" valign="top" background="images/shield_back.jpg"><p><br>      
          <font face="Arial, Helvetica, sans-serif"><a href="view_classes.php"><strong>Back
          to View Classes </strong></a> | <strong><a href="add_cancellation.php" class="style8 style9">Add
          Another Class </a>| <a href="login/logout.php" class="style8 style9">Log
          Out </a></strong></font></p>
      <p><span class="style2"><font face="Arial, Helvetica, sans-serif">Professor
            Name: </font></span>
          <?php

 // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
	$query="select * from class_cancel where id = $id";
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
	if ($hour>12) { $hour-=12; $ispm=1; }
	$min = substr($date, 14,2);
	*/
	//Ming 10/09/08 last update
	$c_date=date("m/d/Y",strtotime($date));
	$c_time=date("h:i A",strtotime($date));
	?>
        
          <?php echo $prof_last; ?> , <? echo $prof_first; ?><br>
          <br>
          <span class="style2"><font face="Arial, Helvetica, sans-serif">Course
          Number: </font></span><? echo $course; ?><br>
          <br>
          <span class="style2"><font face="Arial, Helvetica, sans-serif">Course
      Section: </font></span><? echo $section; ?></p>
      <p><span class="style2"><font face="Arial, Helvetica, sans-serif">Course
            Title: </font></span><? echo $title; ?><br>
            <br>
            <span class="style2"><font face="Arial, Helvetica, sans-serif">Room
          Number : </font></span><? echo $room; ?><br>
          <br>
          <span class="style2"><font face="Arial, Helvetica, sans-serif">Date: </font></span><? print $c_date;//$month."/".$day."/".$year; ?><br>
          <br>
          <span class="style2"><font face="Arial, Helvetica, sans-serif">Time: </font></span><? print $c_time;//$hour.":".$min; if ($ispm==1) {echo " PM";}  else echo " AM"; ?>	      <br>
          <br>
          <span class="style2"><font face="Arial, Helvetica, sans-serif">Professor
          Comments: </font></span><? echo $comments; ?><br>
          <br>
          <span class="style2"><font face="Arial, Helvetica, sans-serif">Reason for
          Cancellation: </font></span><? echo $reason; ?><br>
          <br>
            
        <?php 
        }
        // Close the connection
        mysql_close();
        exit
        ?>
      </p>
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
