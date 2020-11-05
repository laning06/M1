<?php
namespace f3il;

    /**ici c'est le fichier de configuration */
class Configuration{ //ici on creer une nouvelle classe
        
        private static $_instance = null; // on mets $_ car ce sont les propriétes des classes
        private static $_inifile =null;
        private $data;

        private function __construct()
        {
            if(is_null(self::$_inifile))
            {
                die("fichier ini non renseigné");
            }
            if(!is_readable(self::$_inifile))
            {
                die("Fichier ini non lisible");
            }
            $this->data=parse_ini_file(self::$_inifile);
            if (!$this->data){
                die("Erreur lecture fichier ini");
            }
        }
    

        public static function setConfigurationFile($inifile)
        {
            self::$_inifile=$inifile;
        }

        Public static function getInstance()
        {
            if(is_null(self::$_instance)){
                self::$_instance =new Configuration();
            }
            return self::$_instance;
        }

        public function __get($item)
        {
            if(!isset($this->data[$item])){
                die("Erreur de configuration: $item n'existe");
            }
            return $this->data[$item];
        }

        public function __set($item,$value)
        {
            die('il est interdit de modifier la configuration');
        }

        public function __isset($item){
            return isset($this->data[$item]);
        }


    }

?>
