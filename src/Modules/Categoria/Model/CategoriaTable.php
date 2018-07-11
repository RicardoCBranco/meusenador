<?php
namespace Ufrpe\Senadores\Modules\Categoria\Model;

use \Ufrpe\Senadores\Data\Connection;

class CategoriaTable{
    public function __construct(){}

    public function all(){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM categorias");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function dados($id){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT senador, SUM(valor_reembolsado) as soma 
                                FROM gastos WHERE categoria_gastos LIKE ? AND codigo_parlamentar <> 0 GROUP BY 
                                codigo_parlamentar ORDER BY soma DESC LIMIT 5;");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public function find($id){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM categorias WHERE idcategoria LIKE ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}