<?php

namespace models;
use lib\Core;
use PDO;

class Programmer {

    protected $core;

    function __construct() {
        $this->core = Core::getInstance();
    }

    //List
    public function getAll($by='id',$order='DESC') {
        $r = array();

        $sql = "SELECT * FROM programadores ORDER BY $by $order";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //List
    public function get($qtd=1) {
        $r = array();

        $sql = "SELECT * FROM programadores ORDER BY id DESC LIMIT $qtd";
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

        $sql = "SELECT * FROM programadores WHERE id=$id";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //getId
    public function query($query) {
        $r = array();
        $sql = "SELECT * FROM programadores $query";
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
            $sql = "INSERT INTO programadores (nome, valor_hora)
					VALUES (:nome, :valor_hora)";
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

    }

    // Delete
    public function delete($id) {

    }

    public function count()
    {
        $r = array();

        $sql = "SELECT COUNT(*) FROM programadores;";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetch(PDO::FETCH_NUM);
        } else {
            $r = 0;
        }
        return $r;
    }

}