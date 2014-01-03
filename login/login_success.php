<?
session_start();

echo "Welcome ". $_SESSION['first_name'] ." ". $_SESSION['last_name'] ."! You have made it to the members area!<br /><br />";

echo "Your user level is ". $_SESSION['user_level']." which enables you access to the following areas: <br />";

if($_SESSION['user_level'] == 0){

//meta to main section goes here
?>

<meta http-equiv="refresh" content="0;URL=../add_cancellation.php">

<?
}
if($_SESSION['user_level'] == 2){

//meta to main section goes here
?>

<meta http-equiv="refresh" content="0;URL=../print_classes.php">

<?
}
if($_SESSION['user_level'] == 1){

//meta refresh to user admin goes here
?>


<meta http-equiv="refresh" content="0;URL=useradmin.php">

<?


}

echo "<br /><a href=logout.php>Logout</a>";

?>