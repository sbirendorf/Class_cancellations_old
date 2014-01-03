<?Php
session_start();
 if (!isset($_SESSION['user_level'])) {?>
<meta http-equiv="refresh" content="0;URL=login/login_form.html">
<?Php 
exit;
}  
if($_SESSION['user_level'] != 2){?>
<meta http-equiv="refresh" content="0;URL=view_classes.php">
<?Php exit;} 

if (!isset($_GET["continue"])){
?>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>


<span class="style1">Are you sure you want to purge the database?</span><br>
<Br>

<span class="style1"><a href="purge.php?continue=1">YES</a> | <a href="purge.php?continue=2">NO</a></span>

<?Php 
exit;
}

if ($_GET["continue"]==1){


//echo "update it in the db";

$idnum=$_GET["id"];


 // Connect to the WWW database. 
	require_once('../../PhpConnections/AssumptionWWWConnect.php');
mysql_select_db("assumptionwww");

mysql_query($query);

?>
<meta http-equiv="refresh" content="0;URL=print_classes.php">
<?Php
}

else {
?>
<meta http-equiv="refresh" content="0;URL=print_classes.php">

<?Php

}
mysql_close();
exit();
?>