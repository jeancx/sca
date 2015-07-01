<?php

namespace models;
use lib\Core;
use PDO;

class Category {

    protected $core;

    function __construct() {
        $this->core = Core::getInstance();
    }

    //List
    public function getAll($by='id',$order='DESC') {
        $r = array();

        $sql = "SELECT * FROM categorias ORDER BY $by $order";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //get
    public function get($qtd=1) {
        $r = array();

        $sql = "SELECT * FROM categorias ORDER BY id DESC LIMIT $qtd";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //getId
    public function getId($id) {
        $r = array();

        $sql = "SELECT * FROM categorias WHERE id=$id";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //custom Query
    public function query($query) {
        $r = array();
        $sql = "SELECT categorias $query";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    // Insert
    public function insert($data) {
        try {
            $sql = "INSERT INTO categorias (titulo)
					VALUES (:titulo)";
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute($data)) {
                return $this->core->dbh->lastInsertId();;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            return $e->getMessage();
        }

    }

    // Update
    public function update($data) {

        try {
            $sql = "UPDATE categorias
                    SET titulo=:titulo
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

        try {
            $sql = "DELETE FROM categorias WHERE id=$id";
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            return $e->getMessage();
        }

    }

    // Count users
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

}