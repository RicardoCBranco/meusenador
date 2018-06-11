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
            $options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => CHARSET);

            self::$instance = new \PDO(sprintf("%s:host=%s;dbname=%s",
                    DRIVER,  HOST , DBNAME), USER,PSWD,$options);
        }
        return self::$instance;
    }
}