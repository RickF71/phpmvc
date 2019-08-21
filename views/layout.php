<?php


?><!DOCTYPE html>
<html>
  <head>
	<title>PHP MVC Template <?php 
		if (isset($_GET['controller']))
			echo ucfirst($_GET['controller']);
	?></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/overrides.css">
	<?php if (isset($_GET['controller'])) {
		if (file_exists("css/".$_GET['controller'].".css")) { ?>
			<link rel="stylesheet" type="text/css" href="css/<?=$_GET['controller'];?>.css">
	<?php } } ?>
	
  </head>
  <body>
    <div class="jumbotron">
			<h2 class="">PHP MVC Template</h2>
  	  <a class="btn btn-primary" href='./'>Home</a>
			<a class="btn btn-primary" href='?controller=pages&action=about'>About</a>
    </div>

		<div class="container">
			<?php require_once('routes.php'); ?>
		</div>

    <footer class="footer pt-3" id="footer">
			<div class="container border-top border-dark">
				<span class="text-muted float-right">Email: rickf71@gmail.com</span>
			</div>
		</footer>
  <body>
<html>
