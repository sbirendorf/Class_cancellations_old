<?
require("escape.php");
session_start();
 if (!isset($_SESSION['user_level'])) {?>
<meta http-equiv="refresh" content="0;URL=login/login_form.html">
<? exit;}  
?>
<?
if (!($_GET["prof_last"])) {
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<style type="text/css">
<!--
.style4 {color: #FF0000}
-->
</style>
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
</style></head>

<body>

<img src="images/class_cancel_admin.jpg" width="746" height="98"><br>
<table width="746" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td width="827" height="129" valign="top" background="images/shield_back.jpg"><p><font face="Arial, Helvetica, sans-serif"><a href="view_classes.php?password=lettuce"><strong>View
              Canceled Classes</strong></a> | <a href="login/logout.php"><strong>Log out </strong></a></font></p>
      <form name="form1" method="get" action="add_general_announcement.php">
			<p class="style1"><strong>          <strong>General Announcement (Use
              this field to announce entire school closing):<br>
            <span class="style3">
            <textarea name="general" cols="50" rows="3" id="general">(No General Announcement at this Time)</textarea>
            </span> </strong></strong><strong> </strong></p>
        <p class="style3">The school closing will extend through (mm/dd/yyyy):
            <select name="month" id="month">
              <option value="01" selected>01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
    /
    <select name="day" id="day">
      <option value="01" selected>01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
      <option value="06">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
    </select>
    /
    <select name="year" id="year">
      <option value="2006">2006</option>
      <option value="2007">2007</option>
      <option value="2008">2008</option>
      <option value="2009">2009</option>
    </select>
        </p>
        <p class="style3"><span class="style1">
          <input type="submit" name="Submit" value="Submit">
        </span> </p>
      </form>
	        <p>&nbsp;          </p>
      <p align="center">&nbsp;</p>    </td>
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

<?Php
	
}

else

{
	$general=esc_mysql($_GET["general"]);
    $month=$_GET["month"];
	$day=$_GET["day"];
	$year=$_GET["year"];
	$hour=$_GET["hour"];
	$minute=$_GET["minute"];
	$ampm=$_GET["ampm"];
	$ip=$_SERVER['REMOTE_ADDR']; 
  
    if ($ampm=="PM") { $hour+=12; }
	
  // This is for the daily purged database
	 // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
	$query="insert into cancel_general (general, date, ip) values 
($general, '$year-$month-$day $hour:$minute:00', '$ip')";
	mysql_query($query);
	
	// echo $query2;
	
?>
<meta http-equiv="refresh" content="0;URL=view_classes_gen.php">
<?Php
}  
// close the connection
mysql_close();
exit;
?>

