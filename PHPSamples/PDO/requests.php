<?php
include("db.php");

function SimpleRequest(){
    try{
        $pdo = DBConnect::get_instance('connection.ini');
        $connexion = $pdo->get_connection();
        $requ = "SELECT prenom, nom FROM employes";
        $pdo_statement = $connexion->query($requ);
        $cal =  $pdo_statement->fetch(PDO::FETCH_OBJ);
        print_r($cal);

    }catch(PDOException $e){
        echo "requête impossile : ".$e;
    }
}