<?
session_start();
 if (!isset($_SESSION['user_level'])) {?>
<meta http-equiv="refresh" content="0;URL=login/login_form.html">
<? exit;}  
?>
<?




//echo "update it in the db";

$idnum=$_GET["id"];


$query="delete from cancel_general where id=$idnum";
$db_connection=mysql_connect("localhost","root","");
mysql_select_db("assumptionwww");

mysql_query($query);


	?>
<meta http-equiv="refresh" content="0;URL=view_classes.php?">
<?
exit;



?>