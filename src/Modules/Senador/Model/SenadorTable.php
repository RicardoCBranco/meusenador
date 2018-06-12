<?php

namespace Ufrpe\Senadores\Modules\Senador\Model;

use \Ufrpe\Senadores\Data\Connection;

class SenadorTable {

    private function __construct() {
        
    }

    public static function all() {
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM senadores ORDER BY nome_parlamentar");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function find($id){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM senadores WHERE codigo_parlamentar LIKE ?");
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
    
    public static function gastos($nome){
        
    }
}
