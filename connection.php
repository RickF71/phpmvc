<?php

class Db {
	private static $instance = NULL;

	private function __construct() {}

	private function __clone() {}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			self::$instance = new PDO('mysql:host=localhost;dbname=phpmvcdb', 'root', '', $pdo_options);
		}
		return self::$instance;
	}
}

class PMLogin {
  private static $instance = NULL;
		
	private function __construct() {}
		
	private function __clone() {}
		
	public static function getInstance() {
		if (!isset($_SESSION['PMUser']) || $_SESSION['PMUser']==null) {
			//return null;
      $_SESSION['PMUser']['id']=0;  //anonymous
		}

		if (!isset(self::$instance)) {
			self::$instance = new User($_SESSION['PMUser']['id']);
		}
		
		return self::$instance;
	}
}		
?>