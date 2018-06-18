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
        return $stmt->fetchAll();
    }

    public static function find($id){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM senadores WHERE codigo_parlamentar LIKE ?");
        $stmt->execute(array($id));
        return $stmt->fetch();
    }
    
    public static function search($nome){
        $query = "SELECT * FROM senadores WHERE nome_parlamentar LIKE '%$nome%'";
        $con = Connection::getInstance();
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetch();

    }
}
