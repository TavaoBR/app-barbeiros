<?php 

namespace Src\Database;

use PDO;
class Connection {

    
    private static $host = '193.203.175.94';

    private static $db = 'mysql';

    private static $dbname = 'u736474566_dataBase';

    private static $user = 'u736474566_dataBase';

    private static $password = 'rF2E0L0|';

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