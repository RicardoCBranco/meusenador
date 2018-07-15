<?php
namespace Ufrpe\Senadores\Modules\Premiacao\Model;

use \Ufrpe\Senadores\Data\Connection;
class PremiacaoTable{
    public static function find($id){
        $con = Connection::getInstance();
        $stmt = $con->prepare("SELECT * FROM premiacao INNER JOIN categorias ON (categoria_gastos = idcategoria) 
        WHERE premiacao.codigo_parlamentar LIKE ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}