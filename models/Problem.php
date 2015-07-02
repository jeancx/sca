<?php

namespace models;

use lib\Core;
use PDO;

class Problem
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

        $sql = "SELECT problemas.id as id, problemas.titulo as titulo, problemas.data_hora as data_hora,
            clientes.nome as cliente, categorias.titulo as categoria, usuarios.username as usuario
            FROM problemas
            INNER JOIN clientes ON problemas.cliente_id=clientes.id
            INNER JOIN categorias ON problemas.categoria_id=categorias.id
            INNER JOIN usuarios ON problemas.usuario_id=usuarios.id
            ORDER BY problemas.id DESC";

        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //List
    public function get($qtd=1)
    {
        $r = array();

        $sql = "SELECT problemas.id as id, problemas.titulo as titulo, problemas.data_hora as data_hora,
            clientes.nome as cliente, categorias.titulo as categoria, usuarios.username as usuario
            FROM problemas
            INNER JOIN clientes ON problemas.cliente_id=clientes.id
            INNER JOIN categorias ON problemas.categoria_id=categorias.id
            INNER JOIN usuarios ON problemas.usuario_id=usuarios.id
            ORDER BY problemas.id DESC
            LIMIT $qtd";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }


    //CountByMonth
    public function countByMonth($year,$month)
    {
        $r = array();

        $date = $year.'-'.$month.'-1';
        $begin  = date("Y-m-01", strtotime($date)).' 00:00:00';
        $end = date("Y-m-t", strtotime($begin)).' 23:59:59';


        $sql = "SELECT COUNT(*)
            FROM problemas
            WHERE data_hora >= '$begin' AND data_hora <= '$end'";

        $cols = $this->core->dbh->query($sql)->fetchColumn();

        return $cols;

    }


    //CountByMonth
    public function costByProblem($id)
    {
        $r = array();

        $sql = "SELECT problemas.titulo as titulo,
            topicos.resolvido as resolvido
            FROM problemas
            INNER JOIN clientes ON problemas.cliente_id=clientes.id
            INNER JOIN categorias ON problemas.categoria_id=categorias.id
            INNER JOIN usuarios ON problemas.usuario_id=usuarios.id
            INNER JOIN topicos ON problemas.id=topicos.problema_id
            WHERE problemas.id=$id";

        $cols = $this->core->dbh->query($sql)->fetchAll();

        return $cols;

    }

    //getId
    public function getId($id)
    {
        $r = array();

        $sql = "SELECT * FROM problemas WHERE id=$id ORDER BY id DESC";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = false;
        }
        return $r;
    }

    //getId
    public function query($query)
    {
        $r = array();
        $sql = "SELECT * FROM problemas $query";
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
            $sql = "INSERT INTO problemas (cliente_id, titulo, descricao, categoria_id, data_hora, usuario_id)
					VALUES (:cliente_id, :titulo, :descricao, :categoria_id, :data_hora, :usuario_id)";
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

    }

    // Delete
    public function delete($id)
    {

    }

    public function count()
    {
        $r = array();

        $sql = "SELECT COUNT(*) FROM problemas;";
        $stmt = $this->core->dbh->prepare($sql);

        if ($stmt->execute()) {
            $r = $stmt->fetch(PDO::FETCH_NUM);
        } else {
            $r = 0;
        }
        return $r;
    }


}