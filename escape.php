<?

// use this function on any get, post, cookie value to make sure it doesn't
// have magic_quotes slashes in it
function strip_magic_quotes($string){
  if(get_magic_quotes_gpc()){
    return stripslashes($string);
  }
  else {
    return $string;
  }
}

// escape a mysql literal to be put into a mysql field.
// escapes quotes, puts single quotes around the value
// if not_null is set to false, then if the value = '', then will return
// 'NULL' without single quotes around it, which allows for null values 
function esc_mysql($value,$not_null = true){
  $value = mysql_escape_string($value);
  if($value == '' && !$not_null){
    $value = 'NULL';
  }
  else {
    $value = "'$value'";
  }
  return $value;
}

?>
