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