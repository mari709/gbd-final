<?php
session_start();
unset($_SESSION['status']);
header('Location:./login.php');

?>