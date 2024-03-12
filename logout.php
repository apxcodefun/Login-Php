<?php
session_start();
$_SESSION =[];
session_unset();
session_destroy();

setcookie('id','',time()-9000);
setcookie('key','',time()-9000);

header('location:login.php');
exit;
?>