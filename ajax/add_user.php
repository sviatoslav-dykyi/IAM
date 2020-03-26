<?php 
	$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));	
	$role = trim(filter_var($_POST['role'], FILTER_SANITIZE_STRING));
	$status = trim(filter_var($_POST['status'], FILTER_SANITIZE_STRING));		

	require '../db.php';	

	$db = db_connect();
	$sql = 'INSERT INTO users_management(name, status, role) VALUES (:n, :s, :r)';
	$query = $db->prepare($sql);
	$query->execute([
		'n' => $name,
		's' => $status,
		'r' => $role
	]);

	$info = $query->errorInfo();
	if ($info) {
		echo $info[2];
	}


	echo 'Done';
	
	
?>