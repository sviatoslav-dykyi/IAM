<?php 
	$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_STRING));	

	require '../db.php';	

	$db = db_connect();
	$sql = 'SELECT firstName, lastName, status, role FROM users_management WHERE id_user = :id';
	$query = $db->prepare($sql);
	$query->execute([
		'id' => $id_user
	]);

    $user = $query->fetch(PDO::FETCH_OBJ);

	$info = $query->errorInfo();
	if ($info) {
		echo $info[2];
	}

	$backEndData = '';
	
	foreach ($user as $column => $value) {
		$backEndData .= $value . '-@-';
	}

	echo $backEndData;


	//echo $user->firstName;
	
	
?>