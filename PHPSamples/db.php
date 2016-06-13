<?php
//PDO = PHP Data Objets

//création d'une classe My_PDO pour créer un PDO à partir d'un fichier .ini qui va contenir tout les paramètres pour la connection (source: http://php.net/manual/fr/class.pdo.php)
class My_PDO extends PDO{
    public function __construct($file = 'my_setting.ini'){
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
        $dns = $settings['database']['driver'] .
            ':host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['schema'];

        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);

    }
}

//Singleton pour la connexion, ainsi il n'y aura pas plusieurs requêtes en même temps dans la db
class DBConnect{
    private static $_instance = null;
    private $_connect;
    private $_server = "pgsql:host=localhost;dbname=shalendar";

    //comme le constructeur est private, il ne peut être appelé que par une méthode statique de la classe (ici par la fonction get_instance() )
    private function __construct($login, $pwd){
        try{
            $this->_connect = new PDO($this->_server, $login, $pwd);
            $this->_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOEXEPTION $e){
            echo $e -> getMessage();
        }
    }

    public function get_connection(){
        return $this->_connect;
    }

    public static function get_instance($login, $pwd){
        if(is_null(self::$_instance)){
            self::$_instance = new DBConnect($login, $pwd);
        }
        return self::$_instance;
    }
}



//Utilisation requête simple
try{
    $pdo = DBConnect::get_instance("postgres", "postgres");
    $connexion = $pdo->get_connection();
    $requ = "SELECT * FROM calendars";
    $pdo_statement = $connexion->query($requ);
    $cal =  $pdo_statement->fetch(PDO::FETCH_OBJ);
    print_r($cal);

}catch(PDOException $e){
    echo $e;
}


?>