<?php session_start();

if (isset($_SESSION['data'])) unset($_SESSION['data']);

$_SESSION['unSuccess'] = 1;
header('Location: ' . $_SERVER['REQUEST_URI']);
exit;
