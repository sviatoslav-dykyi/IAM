<?php	

	$action_id = trim(filter_var($_POST['action_id'], FILTER_SANITIZE_STRING));
	$actionUsers = trim(filter_var($_POST['actionUsers'], FILTER_SANITIZE_STRING));	

	require '../db.php';
	$db = db_connect();
	
	$id_users = explode(",", $actionUsers);
	



	switch ($action_id) {
    case 1:
    	foreach ($id_users as $id_user) {
    		$count = $id_user;
    		$sql = 'UPDATE users_management SET status = :s WHERE id_user = :id';
			$query = $db->prepare($sql);
			$query->execute([ 
				's' => 'active',
				'id' => $id_user
			]);
			$info = $query->errorInfo();
    	}
    	break;	        
			        
    case 2:
    	foreach ($id_users as $id_user) {
    		$count = $id_user;
    		$sql = 'UPDATE users_management SET status = :s WHERE id_user = :id';
			$query = $db->prepare($sql);
			$query->execute([ 
				's' => 'not-active',				
				'id' => $id_user
			]);
			$info = $query->errorInfo();
    	}
        break;
    case 3:
        foreach ($id_users as $id_user) {
        	$count = $id_user;
    		$sql = 'DELETE FROM users_management WHERE id_user = :id';
			$query = $db->prepare($sql);
			$query->execute([ 								
				'id' => $id_user
			]);
			$info = $query->errorInfo();
    	}
	}
	

	$info = $query->errorInfo();
	if ($info) {
		echo $info[2];
	}


	echo 'Done';

?>