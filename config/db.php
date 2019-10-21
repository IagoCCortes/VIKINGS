<?php
class Database {
    /*******************************************************************
     * Classe singleton responsável pela conexão com o banco de dados
     ******************************************************************/
    private static $bdd = null;
    private function __construct() {
    }
    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO('mysql:dbname=vikings;host=localhost', 'ragnar', 'teste0209');
        }
        return self::$bdd;
    }
}
?>