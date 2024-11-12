<?php
session_start();

$_SESSION = [];

session_destroy();

header("Location: http://localhost/testonline/login.html");
exit;
?>
