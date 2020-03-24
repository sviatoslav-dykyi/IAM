<?php	
	$id_user = trim(filter_var($_POST['id_user'], FILTER_SANITIZE_STRING));
		

	require '../db.php';	

	$db = db_connect();
	$sql = 'DELETE FROM users_management WHERE id_user = :id';
	$query = $db->prepare($sql);
	$query->execute([ 'id' => $id_user ]);

	$info = $query->errorInfo();
	if ($info) {
		echo $info[2];
	}


	echo 'Done';
	
	
?>