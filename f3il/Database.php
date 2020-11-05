<?php
namespace f3il;
//print_r($conf)
//die()

require_once "f3il/Configuration.php";
require_once "f3il/Database.php";



class Database
{
    private static $_pdo=null;
    private function __construct()
    {
    
        $conf=Configuration::getInstance();
        
        if(!isset($conf->db_driver))
        {
            throw new Error('Database: driver non reseigné');
        }
        switch($conf->db_driver)
        {
            case 'pdo_mysql':
                $this->makePDOMySQL($conf);
            break;
             case 'pdo_sqlite':
                 $this->makePDOSQLite($conf);
            break;
            default:
            throw new Error("Database : driver non pris en compte");
        }
    }
    
    public function makePDOMySQL($conf)
    {
        $expectedKeys = ['db_host', 'db_login', 'db_password', 'db_base'];
        foreach($expectedKeys as $key)
        {
            if(!isset($conf->$key))
            {
                throw new Error('Database : $key manquant dans la configuration');
            }
        }
        try{

            self::$_pdo =new \PDO(
                "mysql:host={$conf->db_host}; dbname={$conf->db_base};charset=utf8",
                $conf->db_login,
                $conf->db_password
            );

        }catch(\PDOException $ex)
        {
            throw new Error("Database : erreur de connexion à MySQL". $ex->getMessage());
        }
    }

    public function makePDOSQLite($conf)
    {
        $expectedKeys = ['db_host', 'db_login', 'db_password', 'db_base'];
        foreach($expectedKeys as $key)
        {
            if(!isset($conf->$key))
            {
                throw new Error('Database : $key manquant dans la configuration');
            }
        }
        try{

            self::$_pdo =new \PDO(
                "sqlite:{$conf->db_file}");

        }catch(\PDOException $ex)
        {
            throw new Error("Database : erreur de connexion à SQLite". $ex->getMessage());
        }
        self::$_pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        self::$_pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
    }


    public static function getInstance()
    {
        if(is_null(self::$_pdo))
        {
            new Database();
        }
        return self::$_pdo;
    }
   
}


?>