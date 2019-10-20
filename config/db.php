<?php
class Database {
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