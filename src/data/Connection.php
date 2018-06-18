<?php
namespace Ufrpe\Senadores\Data;

include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../app/config.php";
/**
 * Implementação da classe Connection utilizando o design pattern
 * Singleton.
 */
class Connection{
    private static $instance;

    private function __construct(){

    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new \PDO("mysql:host=".HOST.";dbname=".DBNAME,USER,PSWD);                    
        }
        return self::$instance;
    }
}