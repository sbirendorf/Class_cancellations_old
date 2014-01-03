<?Php

session_start();



if($_SESSION['user_level'] != 1){ ?>

<meta http-equiv="refresh" content="0;URL=login.php">

<?Php }  ?>

<?Php









//echo "update it in the db";



$idnum=$_GET["id"];





$query="delete from allowed_emails where id=$idnum";

// Connect to the WWW database. 

require_once('../../../PhpConnections/AssumptionWWWConnect.php');



mysql_query($query);





	?>

<meta http-equiv="refresh" content="0;URL=useradmin.php">

<?Php

mysql_close;

exit;







?>