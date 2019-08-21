<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();

/* Sets up the classes "Db" and "PMUser" */
require_once('connection.php');

// The User model is not needed unless
// authentication is configured.  
include_once('models/user.php');

  
  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'home';
  }

  if (isset ($_GET['headless'])) {
	require_once ('routes.php');
  }	else { 
	require_once('views/layout.php');
  }
?>