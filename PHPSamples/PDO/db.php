<?php
//PDO = PHP Data Objets

//création d'une classe My_PDO pour créer un PDO à partir d'un fichier .ini qui va contenir tout les paramètres pour la connection (source: http://php.net/manual/fr/class.pdo.php)
class My_PDO extends PDO{
    public function __construct($file){  //$file is a string who indicate .ini file
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
        //le deuxième paramètre de parse_ini_file passé à TRUE crée un tableau multidimentionnel avec les noms sections
            $dns =
            $settings['database']['driver'] .
            ':host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['schema'];

            //to have something like "pgsql:host=localhost;dbname=databaseName"


        parent::__construct($dns, $settings['admin_user']['username'], $settings['admin_user']['password']);

    }
}

//Singleton pour la connexion, ainsi il n'y aura pas plusieurs requêtes en même temps dans la db
class DBConnect{
    private static $_instance = null;
    private $_connect;

    //comme le constructeur est private, il ne peut être appelé que par une méthode statique de la classe (ici par la fonction get_instance() )
    private function __construct($file){
        try{
            $this->_connect = new My_PDO($file);
            $this->_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            echo $e -> getMessage();
        }
    }

    public function get_connection(){
        return $this->_connect;
    }

    public static function get_instance($file = 'connection.ini'){
        if(is_null(self::$_instance)){
            self::$_instance = new DBConnect($file);
        }
        return self::$_instance;
    }
}
