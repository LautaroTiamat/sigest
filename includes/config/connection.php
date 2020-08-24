<?php
$dbhost = getenv('VAR_HOST');
$dbuser = getenv('VAR_USER');
$dbpass = getenv('VAR_PASS');
$dbname = getenv('VAR_DB');

try {
	$conexion = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $conexion;
	
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}
?>
