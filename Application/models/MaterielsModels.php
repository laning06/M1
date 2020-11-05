<?php

namespace app\models;

class MaterielsModels{
    //fonction de lecture
    public static function getAll() {
        $pdo = \f3il\Database::getInstance();
        $req = $pdo->prepare ("SELECT * FROM materiels ORDER BY descriptions");
        try{
            $req-> execute();
            $data = $req->fetchAll();
        }
        catch(\PDOException $ex){
            Error ("Erreur SQL". $ex->getMessage());
        }
        return $data;
    }
//fonction d'insertion
    public static function insert( array $data)
    {
        if(!isset($data['descriptions']))
        {
            Error("'descriptions' manquante");
        }
        if(!isset($data['ip']))
        {
            Error("'ip' manquante");
        }
        
        $pdo = \f3il\Database::getInstance();
        $req = $pdo->prepare("INSERT INTO materiels (descriptions, ip)". "VALUES (:descriptions, :ip)");


        
try{
    $req->bindValue(':descriptions', $data['descriptions']);
    $req->bindValue(':ip', $data['ip']);
    $req-> execute();
}catch(\PDOException $ex){
    Error("Erreur SQL".$ex->getMessage());
}
return $pdo->LastInsertId();
}


// //fonction d'insertion
// public static function insert(array $data)
// {
//     $expectedKeys = ['descriptions', 'ip'];
//     $missingKeys = array_diff($expectedKeys, array_keys($data));
//     foreach($missingKeys as $K)
//     {
//         die("'$K' ne figure pas dans les données transmises pour insert");
//     }
//     $pdo= \f3il\Database::getInstance();

//     $req = $pdo->prepare("INSERT INTO materiels (descriptions, ip)". "VALUES (:descriptions, :ip)");
        
// try{
//     $req->bindValue(':descriptions', $data['descriptions']);
//     $req->bindValue(':ip', $data['ip']);
//     $req-> execute();
// }catch(\PDOException $ex){
//     die("Erreur SQL".$ex->getMessage());
// }
   
// } 
   
}





?>