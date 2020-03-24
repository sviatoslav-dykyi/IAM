<?php 
	$firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
	$lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));	
	$role = trim(filter_var($_POST['role'], FILTER_SANITIZE_STRING));
	$status = trim(filter_var($_POST['status'], FILTER_SANITIZE_STRING));

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
	$sql = 'INSERT INTO users_management(firstName, lastName, status, role) VALUES (:f, :l, :s, :r)';
	$query = $db->prepare($sql);
	$query->execute([
		'f' => $firstName,
		'l' => $lastName,
		's' => $status,
		'r' => $role
	]);

	$info = $query->errorInfo();
	if ($info) {
		echo $info[2];
	}


	echo 'Done';
	
	
?>