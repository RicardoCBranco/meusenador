<?php
namespace Ufrpe\Senadores\Modules\Gastos\Model;

use \Ufrpe\Senadores\Data\Connection;
use \Ufrpe\Senadores\Modules\Categoria\Model\CategoriaTable;

class GastosTable{
    private function __construct(){}

    public static function top($limit){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT gastos.codigo_parlamentar, senador, ano, 
        SUM(valor_reembolsado)/DATEDIFF(MAX(data),MIN(data)) as soma,  nome_parlamentar,
         sigla_partido_parlamentar, uf_parlamentar, (SUM(valor_reembolsado)) as total 
         FROM gastos INNER JOIN senadores ON (gastos.codigo_parlamentar = senadores.codigo_parlamentar)
          WHERE gastos.codigo_parlamentar <> 0 GROUP BY gastos.codigo_parlamentar 
         ORDER BY soma DESC LIMIT $limit;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function all(){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT gastos.codigo_parlamentar, senadores.nome_parlamentar, ano, sigla_partido_parlamentar,
        uf_parlamentar, 
        SUM(valor_reembolsado)/DATEDIFF(MAX(data),MIN(data)) as soma 
        FROM senadores 
        LEFT JOIN gastos ON (senadores.codigo_parlamentar = gastos.codigo_parlamentar) 
        WHERE senadores.codigo_parlamentar <> 0 GROUP BY senadores.codigo_parlamentar 
         ORDER BY soma DESC;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function show($id){
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM gastos WHERE codigo_parlamentar LIKE ? ORDER BY ano,mes DESC");
        $stmt->bindParam(1, $id, \PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getTopCategorias(){
        $script = null;
        $i = 1;
        foreach(CategoriaTable::all() as $cat){
            $script .= "<div class='col-md-6'>";
            $script .= "<h5>$i. ".$cat['tipo_despesa']."</h5>";
            $script .= "<table class='table table-striped table-condensed'>";
            $script .= "<thead class='thead-dark'><tr><th>Senador</th><th>Gastos</th></tr></thead>";
            $script .= "<tbody>";

            $con = Connection::getInstance();
            $stmt = $con->prepare("SELECT categoria_gastos, senador, SUM(valor_reembolsado) as soma 
            FROM gastos 
            WHERE categoria_gastos LIKE ? AND codigo_parlamentar <> 0
            GROUP BY codigo_parlamentar 
            ORDER BY soma DESC LIMIT 5");
            $stmt->execute([$cat['idcategoria']]);
            foreach($stmt->fetchAll() as $row){
                $script .= "<tr>";
                $script .= "<td>".$row['senador']."</td>";
                $script .= "<td>".number_format($row['soma'],2,',','.')."</td>";
                $script .= "</tr>";
            }            
            $script .= "</tbody>";
            $script .= "</table>";
            $script .= "</div>";
            $i++;
        }
        return $script;
    }
}