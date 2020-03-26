<?php 
	$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
	$role = trim(filter_var($_POST['role'], FILTER_SANITIZE_STRING));
	$status = trim(filter_var($_POST['status'], FILTER_SANITIZE_STRING));
	$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_STRING));	

	require '../db.php';	

	$db = db_connect();
	$sql = 'UPDATE users_management SET name = :n, status = :s, role = :r WHERE id_user = :id';
	$query = $db->prepare($sql);
	$query->execute([
		'n' => $name,
		's' => $status,
		'r' => $role,
		'id' => $id_user
	]);

	$info = $query->errorInfo();
	if ($info[2]) {
		echo $info[2];
	}


	echo 'Done';
	
	
?>