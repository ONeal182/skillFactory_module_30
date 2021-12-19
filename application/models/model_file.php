<?php

class Model_File extends Model
{

	function insert(array $data)
	{

		$query = 'INSERT INTO files 
		(user_id,  name , comment,file, created_at) 
		VALUES(:user_id,:name,:comment,:file,:created_at)';
		$db = parent::get_connection();
		// print_r($db->prepare($query));
		$stmt = $db->prepare($query);
		print_r($data);
		return $stmt->execute($data);
	}

	function getUserById(string $id)
	{
		$query = 'SELECT * FROM users WHERE id = ?';
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
		$stmt->execute([$id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
			return $result;
		}
		return false;
	}
	
    
}
