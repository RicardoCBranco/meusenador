<?php
namespace Ufrpe\Senadores\Modules\Gastos\Model;

class GastosTable{
    private function __construct(){}

    public static function top($limit){
        $conn = \Ufrpe\Senadores\Data\Connection::getInstance();
        $stmt = $conn->prepare("SELECT gastos.codigo_parlamentar, senador, ano, 
        (SUM(valor_reembolsado)/COUNT(DISTINCT data)) as soma,  nome_parlamentar,
         sigla_partido_parlamentar, uf_parlamentar, (SUM(valor_reembolsado)) as total 
         FROM gastos INNER JOIN senadores ON (gastos.codigo_parlamentar = senadores.codigo_parlamentar)
          WHERE gastos.codigo_parlamentar <> 0 GROUP BY gastos.codigo_parlamentar 
         ORDER BY soma DESC LIMIT $limit;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function all(){
        $conn = \Ufrpe\Senadores\Data\Connection::getInstance();
        $stmt = $conn->prepare("SELECT gastos.codigo_parlamentar, senador, ano, sigla_partido_parlamentar,
        uf_parlamentar, 
        (SUM(valor_reembolsado)/COUNT(DISTINCT data)) as soma 
        FROM gastos 
        INNER JOIN senadores ON (senadores.codigo_parlamentar = gastos.codigo_parlamentar) 
        WHERE gastos.codigo_parlamentar <> 0 GROUP BY gastos.codigo_parlamentar 
         ORDER BY soma DESC;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function show($id){
        $conn = \Ufrpe\Senadores\Data\Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM gastos WHERE codigo_parlamentar LIKE ? ORDER BY ano,mes DESC");
        $stmt->bindParam(1, $id, \PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll();
    }
}