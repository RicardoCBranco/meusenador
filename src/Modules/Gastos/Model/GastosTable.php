<?php
namespace Ufrpe\Senadores\Modules\Gastos\Model;

class GastosTable{
    private function __construct(){}

    public static function all(){
        $conn = \Ufrpe\Senadores\Data\Connection::getInstance();
        $stmt = $conn->prepare("SELECT codigo_parlamentar, senador, ano, SUM(valor_reembolsado)
         as soma FROM gastos WHERE codigo_parlamentar <> 0 GROUP BY gastos.codigo_parlamentar 
         ORDER BY soma DESC LIMIT 10;");
         $stmt->execute();
         return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}