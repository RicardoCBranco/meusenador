<?php
namespace Ufrpe\Senadores\Modules\Categoria\Model;

use \Ufrpe\Senadores\Data\Connection;

class CategoriaTable{
    private function __construct(){}

    public static function all(){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM categorias");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function dados($inicio){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT senador, SUM(IF(categoria_gastos = 1, valor_reembolsado,0)) as aluguel,
        SUM(IF(categoria_gastos = 2, valor_reembolsado,0)) as passagens,
        SUM(IF(categoria_gastos = 3, valor_reembolsado,0)) as divulgacao,
        SUM(IF(categoria_gastos = 4, valor_reembolsado,0)) as contratos,
        SUM(IF(categoria_gastos = 5, valor_reembolsado,0)) as combustiveis,
        SUM(IF(categoria_gastos = 6, valor_reembolsado,0)) as material,
        SUM(IF(categoria_gastos = 7, valor_reembolsado,0)) as seguranca
        FROM gastos WHERE codigo_parlamentar <> 0 GROUP BY codigo_parlamentar 
        ORDER BY senador LIMIT 4 OFFSET $inicio;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function gastosParlamentar($codigoParlamentar){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT senador, SUM(IF(categoria_gastos = 1, valor_reembolsado,0)) as aluguel,
        SUM(IF(categoria_gastos = 2, valor_reembolsado,0)) as passagens,
        SUM(IF(categoria_gastos = 3, valor_reembolsado,0)) as divulgacao,
        SUM(IF(categoria_gastos = 4, valor_reembolsado,0)) as contratos,
        SUM(IF(categoria_gastos = 5, valor_reembolsado,0)) as combustiveis,
        SUM(IF(categoria_gastos = 6, valor_reembolsado,0)) as material,
        SUM(IF(categoria_gastos = 7, valor_reembolsado,0)) as seguranca
        FROM gastos WHERE codigo_parlamentar LIKE ?;");
        $stmt->execute([$codigoParlamentar]);
        return $stmt->fetchAll();
    }

    public static function totalDeRegistros(){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT COUNT(IF(codigo_parlamentar <> 0,1,0)) as total FROM senadores");
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function find($id){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM categorias WHERE idcategoria LIKE ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}