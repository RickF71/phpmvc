<h1>Home Page Content</h1>

<h2>Database Stats</h2>
<?php 

$db = DB::getInstance();
$attributes = array(
    "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
    "ORACLE_NULLS", "PERSISTENT", /*"PREFETCH",*/ "SERVER_INFO", "SERVER_VERSION" /*,
    "TIMEOUT"*/
);

foreach ($attributes as $val) {
		echo '<br>';
    echo "PDO::ATTR_$val: ";
    echo $db->getAttribute(constant("PDO::ATTR_$val")) . "\n";
		echo '';
}

 ?>