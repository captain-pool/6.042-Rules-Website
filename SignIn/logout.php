<?php 
session_start();
session_destroy();
unset($_SESSION['six_oh_four_two_id']);
if(isset($_COOKIE['six_oh_four_two_id']))
setcookie('six_oh_four_two_id','',time()-3600);
unset($_COOKIE['six_oh_four_two_id']);
header("location:/");
?>