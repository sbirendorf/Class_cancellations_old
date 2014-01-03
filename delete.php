<?php

session_start();

 if (!isset($_SESSION['user_level'])) {?>

<meta http-equiv="refresh" content="0;URL=login/login_form.html">

<?php

exit;}  

?>

<?php









//echo "update it in the db";



$idnum=$_GET["id"];





$query="delete from class_cancel where id=$idnum";

 // Connect to the WWW database. 

	require_once('../../PhpConnections/AssumptionWWWConnect.php');



mysql_query($query);





	?>

<meta http-equiv="refresh" content="0;URL=view_classes.php?">

<?php

// Close the connection

mysql_close();

exit;



?>