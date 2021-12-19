<?php

class Model_Login extends Model
{

	function insert(array $data)
	{
		$query = 'INSERT INTO users (name, email, password, created_at) VALUES(?, ?, ?, ?)';
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
		return $stmt->execute($data);
	}

	function update(array $data)
	{

		$query = "UPDATE users SET name=:name, email=:email, password=:password WHERE name=:name";
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
        print_r($stmt);
		return $stmt->execute($data);
	}

    function updateHash(array $data, string $hash, string $insip = null)
	{

		$query = "UPDATE users SET user_hash='" . $hash . "' " . $insip . " WHERE id='" . $data['id'] . "'";
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
		return $stmt->execute($data);
	}
	
	

	function getUserByEmail(string $email)
	{
		$query = 'SELECT * FROM users WHERE email = ?';
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
		$stmt->execute([$email]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result) {
			return $result;
		}
		return false;
	}

	function getUsersList()
	{
		$query = 'SELECT * FROM users ORDER BY id DESC';
		$db = parent::get_connection();
		return $db->query($query, PDO::FETCH_ASSOC);
	}

	
    // Соединяемся с БД
	
    
}
