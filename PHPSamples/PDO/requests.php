<?php
include("db.php");

function SimpleRequest(){
    try{
        $pdo = DBConnect::get_instance('connection.ini');
        $connexion = $pdo->get_connection();
        $requ = "SELECT prenom, nom FROM employes";
        $pdo_statement = $connexion->query($requ);
        $cal =  $pdo_statement->fetchAll(PDO::FETCH_OBJ);

        //itarate over the array $cal
        foreach($cal as $item){
            $line = (array)$item;
            foreach($line as $col){
                echo "  ".$col;
            }
            echo "<br>";
        }
    }catch(PDOException $e){
        echo "requête impossile : ".$e;
    }
}

function ClientRequest(){
    $pdo = DBConnect::get_instance('connection.ini');
    $connexion = $pdo->get_connection();

}
