<?php

class Model_Main extends Model
{

    public $db;
	function __construct()
    {
        $this->db = parent::get_connection();
    }
	
    function selectUser($cookieId){

        $query = "SELECT * FROM users WHERE `id` = :id LIMIT 1";
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
        $stmt->execute($cookieId);
		return $stmt->fetch(PDO::FETCH_LAZY);
    }

    function insert(array $data)
	{

		$query = 'INSERT INTO files 
		(user_id,  name , comment,file, created_at) 
		VALUES(:user_id,:name,:comment,:file,:created_at)';
		$db = parent::get_connection();
		$stmt = $db->prepare($query);

		return $stmt->execute($data);
	}
    function delete($data){
        print_r($data);
        $query = "DELETE FROM files WHERE id= :id and user_id= :user_id";
        $db = parent::get_connection();
        $stmt = $db->prepare($query);
        return $stmt->execute($data);

    }

	function deleteComment(array $data)
	{

		$query = "UPDATE files SET comment='' WHERE id='" . $data['id'] . "' AND user_id = '" . $data['user_id'] . "'";
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
		return $stmt->execute($data);;
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

    function getComment(){
        $query = 'SELECT * FROM files LEFT JOIN users 
        ON (files.user_id=users.id) ';
		$db = parent::get_connection();
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if ($result) {
			return $result;
		}
		return false;
    }
}
