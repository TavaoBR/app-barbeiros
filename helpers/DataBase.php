<?php 

function agendaBarbeiroData(int $fk, string $data)
{
   $db = new \Src\Database\Connection;

   $connect = $db::connect();

   $select = "SELECT * FROM agendabarbeiro WHERE fkBarbeiro = :fk AND data = :data";
   $query = $connect->prepare($select);
   $query->bindParam(":fk", $fk);
   $query->bindParam(":data", $data);
   $query->execute();
   return [$query->rowCount(), $query->fetchAll(\PDO::FETCH_CLASS)];

}

function agendaBarbeiroDataStatus(int $fk, string $data, string $status)
{
   $db = new \Src\Database\Connection;

   $connect = $db::connect();

   $select = "SELECT * FROM agendabarbeiro WHERE fkBarbeiro = :fk AND data = :data AND status = :status";
   $query = $connect->prepare($select);
   $query->bindParam(":fk", $fk);
   $query->bindParam(":data", $data);
   $query->bindParam(":status", $status);
   $query->execute();
   return [$query->rowCount(), $query->fetchAll(\PDO::FETCH_CLASS)];

}

function agendaBarbeiroDataOrderDesc(int $fk, string $data)
{
   $db = new \Src\Database\Connection;

   $connect = $db::connect();

   $select = "SELECT * FROM agendabarbeiro WHERE fkBarbeiro = :fk AND data = :data ORDER BY id DESC";
   $query = $connect->prepare($select);
   $query->bindParam(":fk", $fk);
   $query->bindParam(":data", $data);
   $query->execute();
   return [$query->rowCount(), $query->fetchAll(\PDO::FETCH_CLASS)];

}

function UsuarioagendaBarbeiroData(int $fk, string $data)
{
   $db = new \Src\Database\Connection;

   $connect = $db::connect();

   $select = "SELECT * FROM agendabarbeiro WHERE fkUser = :fk AND data = :data";
   $query = $connect->prepare($select);
   $query->bindParam(":fk", $fk);
   $query->bindParam(":data", $data);
   $query->execute();
   return [$query->rowCount(), $query->fetchAll(\PDO::FETCH_CLASS)];

}

function HistoricoAgendaUsuarioBarbeiro(int $fk)
{
   $db = new \Src\Database\Connection;

   $connect = $db::connect();

   $select = "SELECT * FROM agendabarbeiro WHERE fkUser = :fk";
   $query = $connect->prepare($select);
   $query->bindParam(":fk", $fk);
   $query->execute();
   return [$query->rowCount(), $query->fetchAll(\PDO::FETCH_CLASS)];

}

function horariosAtendimentoBarbeiro(int $fk)
{

    $db = new \Src\Database\Connection;

    $connect = $db::connect();

    $select = "SELECT * FROM horariosatendimentobarbeiro WHERE fk = :fk";
    $query = $connect->prepare($select);
    $query->bindParam(":fk", $fk);
    $query->execute();
    return [$query->rowCount(), $query->fetchAll(\PDO::FETCH_CLASS)];
    
}


function pesquisa(string $nome)
{
      $db = new \Src\Database\Connection;

      $connect = $db::connect();

    $select = "SELECT * FROM perfilbarbeiro WHERE nomeBarbeiro like :nome ORDER BY nomeBarbeiro ASC";
    $query = $connect->prepare($select);
    $query->bindValue(":nome", "%$nome%");
    $query->execute();
    return [$query->rowCount(), $query->fetchAll(\PDO::FETCH_CLASS)];

}


function codigoGeradoAgendamento(string $codigo)
{
   $db = new \Src\Database\Connection;

   $connect = $db::connect();

   $select = "SELECT * FROM agendabarbeiro WHERE codigo = :codigo";
   $query = $connect->prepare($select);
   $query->bindParam(":codigo", $codigo);
   $query->execute();
   return [$query->rowCount(), $query->fetch(\PDO::FETCH_OBJ)];
}