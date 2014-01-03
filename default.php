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
.style3 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<meta http-equiv="refresh" content="120">
</head>

<body>
<table width="746" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/class_cancel.jpg" width="746" height="98"></td>
  </tr>
  <tr>
    <td width="827" height="105" valign="top" background="images/shield_back.jpg">    <table width="745" border="1" align="left" cellpadding="3" cellspacing="0">
        <tr bgcolor="#FFFFCC">
          <td width="152"><span class="style3">Professor</span></td>
          <td width="176"><span class="style3">Class Information </span></td>
          <td width="72"><span class="style3">Date</span></td>
          <td width="67"><span class="style3">Time</span></td>
          <td width="246"><strong class="style3">Comments</strong></td>
        </tr>
        <?php

 // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
	
	// Delete anything older than the current date.   - Put in by Ryan on 9/18/08
	$queryDelete="delete from class_cancel where date < CURDATE()";
	$queryDelete_result=mysql_query($queryDelete);
	
	
	$query="select * from class_cancel order by prof_last";
	$query_result=mysql_query($query);
	
	while ($row=mysql_fetch_array($query_result,MYSQL_NUM))
	{
		
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
		$min = substr($date, 14,2);
		if($hour>12){
			$hour=$hour-12;
			$ispm=1;
		}
		*/
		//Ming 10/09/08 last update
		$c_date=date("m/d/Y",strtotime($date));
		$c_time=date("h:i A",strtotime($date));
	?>
        <tr valign="top">
          <td><span class="style1"><? echo $prof_last; ?>, <? echo $prof_first; ?></span></td>
          <td><p class="style1"><strong>Room:</strong> <? echo $room; ?><br>
                <strong>Course:</strong> <? echo $course; ?>            <br>
                <strong>Section: </strong><? echo $section; ?><br>
                <strong>Course Title: </strong><? echo $title; ?>                <br>
            </p>          </td>
          <!--<td><span class="style1"><? //print $month."/".$day."/".$year; ?></span></td>-->
		  <td><span class="style1"><? print $c_date; ?></span></td>
          <!--<td><span class="style1"><? //print $hour.":".$min; if ($ispm==1) {echo " PM";}  else echo " AM"; ?></span></td>-->
		  <td><span class="style1"><? print $c_time; ?></span></td>
          <td><span class="style1"><? echo $comments; ?></span></td>
        </tr>
        <?php
        } 
        // Close the connection
        mysql_close();
        exit;
        ?>
      </table>            
    <p>&nbsp;</p>      
    </td>
  </tr>
</table>
<p class="style3">WEATHER INFORMATION</p>
<p class="style1">How do I access the Weather Information Line?</p>
<p class="style1">If you are a campus resident who has their voice mail set up, you will receive an automated message on your voice mail or you may dial extension 7220.</p>
<p class="style1">If you are a commuter student you may dial (508) 767-7220.</p>
<p class="style1">If you are an employee, you may check your voice mail for an automated voice message or you may dial (508) 767-7220.</p>
<p class="style1">If you are a Continuing Education or Graduate Student or a WISE member you may call (508) 767-7360 after 1:00 P.M.</p>
<p><span class="style1">Messages for delays or cancellations will be available by 6:30 A.M. </span><br>
</p>
</body>
</html>
