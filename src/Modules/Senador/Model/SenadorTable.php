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
        $stmt = $conn->prepare("SELECT senadores.codigo_parlamentar, senadores.nome_parlamentar, 
        senadores.url_foto_parlamentar, senadores.url_pagina_parlamentar,
        senadores.email_parlamentar, senadores.sigla_partido_parlamentar, senadores.uf_parlamentar, 
        senadores.nome_completo_parlamentar, (SELECT SUM(valor_reembolsado) FROM gastos WHERE 
        gastos.codigo_parlamentar LIKE senadores.codigo_parlamentar) as total,
        (SELECT SUM(valor_reembolsado)/DATEDIFF(MAX(data),MIN(data)) FROM gastos WHERE
        gastos.codigo_parlamentar LIKE senadores.codigo_parlamentar) as gastos 
        FROM senadores WHERE codigo_parlamentar LIKE ?");
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

    public static function getEstado($sigla){
        $con = Connection::getInstance();
        $stmt = $con->prepare("SELECT senadores.codigo_parlamentar, senadores.nome_parlamentar, senadores.url_foto_parlamentar, senadores.url_pagina_parlamentar,
        senadores.email_parlamentar, senadores.sigla_partido_parlamentar, (SELECT SUM(valor_reembolsado)/DATEDIFF(MAX(data),MIN(data)) FROM gastos WHERE
        gastos.codigo_parlamentar LIKE senadores.codigo_parlamentar) as gastos FROM senadores WHERE senadores.uf_parlamentar LIKE ? 
        ORDER BY gastos DESC;");
        $stmt->execute(array($sigla));
        return $stmt->fetchAll();
    }
}
