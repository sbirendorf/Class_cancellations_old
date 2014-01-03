<? 

/*  Database Information - Required!!  */

/* -- Configure the Variables Below --*/

$dbhost = 'localhost';

$dbusername = 'root';

$dbpasswd = 'sql31408';

$database_name = 'assumptionwww';



/* Database Stuff, do not modify below this line */



$connection = mysql_pconnect("$dbhost","$dbusername","$dbpasswd") 

	or die ("Couldn't connect to server.");

	

$db = mysql_select_db("$database_name", $connection)

	or die("Couldn't select database.");

?>

