<?php 

 function db_connect() {
 	$db = $db ?? null;

 	if ($db === null) {
 		$db = new PDO('mysql:host=localhost;dbname=testing', 'root', '');
 	}
 	return $db; 	
 }

