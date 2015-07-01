<?php

namespace models;
use lib\Core;
use PDO;
use lib\Bcrypt;
use lib\Config;

class User {

	protected $core;

	function __construct() {
		$this->core = Core::getInstance();
	}
	
	// GetAll
	public function getAll() {
		$r = array();		

		$sql = "SELECT * FROM usuarios";
		$stmt = $this->core->dbh->prepare($sql);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);		   	
		} else {
			$r = false;
		}		
		return $r;
	}

    // GetByID
	public function getById($id) {
		$r = array();		
		
		$sql = "SELECT * FROM usuarios WHERE id=$id";
		$stmt = $this->core->dbh->prepare($sql);

		if ($stmt->execute()) {
			$r = $stmt->fetch(PDO::FETCH_ASSOC);
		} else {
			$r = false;
		}		
		return $r;
	}

    // GetByLogin
	public function getByLogin($username,$password) {

		$r = array();		
		
		$sql = "SELECT * FROM usuarios WHERE username=:username";
		$stmt = $this->core->dbh->prepare($sql);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$r = $stmt->fetch(PDO::FETCH_ASSOC);
            if(Bcrypt::checkPassword($password.Config::read('salt'), $r['password'])){
                unset($r['password']);
                $_SESSION['user'] = $r;
                $r = true;
            }else{
                $r = false;
            }
		} else {
			$r = false;
		}

		return $r;
	}

    // Insert
	public function insert($data) {

        $data['password'] = $this->hash($data['password']);

		try {
			$sql = "INSERT INTO usuarios (nome, username, password)
					VALUES (:nome, :username, :password)";
			$stmt = $this->core->dbh->prepare($sql);
			if ($stmt->execute($data)) {
				return $this->core->dbh->lastInsertId();;
			} else {
				return '0';
			}
		} catch(PDOException $e) {
        	return $e->getMessage();
    	}
		
	}

    // Update
	public function update($data) {

        $data['password'] = $this->hash($data['password']);

        try {
            $sql = "UPDATE usuarios
                    SET nome=:nome, username=:username, password=:password
					WHERE id=:id";
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute($data)) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            return $e->getMessage();
        }
		
	}

    // Delete
	public function delete($id) {
		
	}

    // Count
    public function count()
    {
        $r = array();

        $sql = "SELECT COUNT(*) FROM usuarios;";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetch(PDO::FETCH_NUM);
        } else {
            $r = 0;
        }
        return $r;
    }

    public function hash($password){
        return Bcrypt::hashPassword($password.Config::read('salt'));
    }

}