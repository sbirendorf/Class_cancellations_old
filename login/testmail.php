<?php
$to = 'christomurr@gmail.com';
$subject = 'PHP mail tester';
$message = 'Yay!! This message was sent via PHP!' . PHP_EOL .
           'Some other message text.' . PHP_EOL . PHP_EOL .
           '-- signature' . PHP_EOL;
$headers = 'From: "From Name" <c.murray@assumption.edu>' . PHP_EOL .
           'Reply-To: c.murray@assumption.edu' . PHP_EOL .
           'Cc: "CC Name" <c.murray@assumption.edu>' . PHP_EOL .
           'X-Mailer: PHP/' . phpversion();
           
if (mail($to, $subject, $message, $headers)) {
  echo 'mail() Success!';
}
else {
  echo 'mail() Failed!';
}
?>

