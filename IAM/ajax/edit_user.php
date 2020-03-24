<?php 
	$firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
	$lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));	
	$role = trim(filter_var($_POST['role'], FILTER_SANITIZE_STRING));
	$status = trim(filter_var($_POST['status'], FILTER_SANITIZE_STRING));
	$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_STRING));

	$error = '';
	if (strlen($firstName) < 3) {
		$error = 'First name is too short!';
	}
	elseif (strlen($lastName) < 3) {
		$error = 'Last name is too short!';
	}
	elseif (!$status) {
		$error = 'Status is not given!';
	}
	 

	if ($error) {
		echo $error;
		exit();
	}	

	require '../db.php';	

	$db = db_connect();
	$sql = 'UPDATE users_management SET firstName = :f, lastName = :l, status = :s, role = :r WHERE id_user = :id';
	$query = $db->prepare($sql);
	$query->execute([
		'f' => $firstName,
		'l' => $lastName,
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