<?php 

namespace Src\Database;

use PDO;
class Connection {

    
    private static $host = "127.0.0.1";

    private static $db = "mysql";

    private static $dbname = "psicologo";

    private static $user = "root";

    private static $password = "";

    private static $port = 3306;

     private static $connection = null;

     public static function connect(){

        if(!self::$connection){
            self::$connection = new PDO(self::$db.":host=".self::$host.";port=".self::$port.";dbname=".self::$dbname, self::$user, self::$password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }

        return self::$connection;

     }

}