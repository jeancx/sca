<?php

namespace models;

use lib\Core;
use PDO;

class Topic
{

    protected $core;

    function __construct()
    {
        $this->core = Core::getInstance();
    }

    //List
    public function getAll()
    {
        $r = array();

        $sql = "SELECT
                topicos.id as id,
                problemas.titulo as problema,
                programadores.nome as programador,
                topicos.titulo as titulo,
                topicos.tempo as tempo,
                topicos.resolvido as resolvido
                FROM topicos
                INNER JOIN problemas ON topicos.problema_id=problemas.id
                INNER JOIN programadores ON topicos.programador_id=programadores.id
                ORDER BY topicos.id DESC";

        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }


    //getbyProblem
    public function getbyProblem($id)
    {
        $r = array();

        $sql = "SELECT
                topicos.id as id,
                problemas.titulo as problema,
                programadores.nome as programador,
                topicos.titulo as titulo,
                topicos.tempo as tempo,
                topicos.resolvido as resolvido
                FROM topicos
                INNER JOIN problemas ON topicos.problema_id=problemas.id
                INNER JOIN programadores ON topicos.programador_id=programadores.id
                WHERE topicos.problema_id=$id
                ORDER BY topicos.id DESC";

        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }


    //List
    public function get($qtd = 1)
    {
        $r = array();

        $sql = "SELECT
                topicos.id as id,
                problemas.titulo as problema,
                programadores.nome as programador,
                topicos.titulo as titulo,
                topicos.tempo as tempo,
                topicos.resolvido as resolvido
                FROM topicos
                INNER JOIN problemas ON topicos.problema_id=problemas.id
                INNER JOIN programadores ON topicos.programador_id=programadores.id
                ORDER BY topicos.id DESC
                LIMIT $qtd";

        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //getId
    public function getId($id)
    {
        $r = array();

        $sql = "SELECT * FROM topicos WHERE id=$id";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //getId
    public function query($query)
    {
        $r = array();
        $sql = "SELECT topicos $query";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    // Insert
    public function insert($data)
    {
        try {
            $sql = "INSERT INTO topicos (problema_id, programador_id, titulo, descricao, tempo, resolvido)
					VALUES (:problema_id, :programador_id, :titulo, :descricao, :tempo, :resolvido)";
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute($data)) {
                return $this->core->dbh->lastInsertId();;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    // Update
    public function update($data)
    {

        try {

            $sql = "UPDATE topicos
                    SET relato=:relato, tempo=:tempo, resolvido=:resolvido
					WHERE id=:id";

            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute($data)) {
                return $this->core->dbh->lastInsertId();;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    // Delete
    public function delete($id)
    {

    }

    // Count
    public function count()
    {

        $sql = "SELECT COUNT(*) FROM topicos;";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetch(PDO::FETCH_NUM);
        } else {
            $r = 0;
        }
        return $r;
    }

}