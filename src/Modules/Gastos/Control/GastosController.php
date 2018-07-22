<?php
namespace Ufrpe\Senadores\Modules\Gastos\Control;

use \Ufrpe\Senadores\Modules\Senador\Model\SenadorTable;
use \Ufrpe\Senadores\Modules\Gastos\Model\GastosTable;
use \Ufrpe\Senadores\Modules\Premiacao\Model\PremiacaoTable;
use \Ufrpe\Senadores\Modules\Categoria\Model\CategoriaTable;

class GastosController{
    public function __construct(){}
    
    public function indexAction(){
        $id = filter_input(INPUT_GET,"id");
        $gastos = GastosTable::show($id);
        $senador = SenadorTable::find($id);
        $premios = PremiacaoTable::find($id);
        $detalhe = CategoriaTable::gastosParlamentar($id);

        return array('gastos' => $gastos,'senador' => $senador,'premios' => $premios,
        'detailpage' => $detalhe);
    }

    public function showAction(){
        if(filter_input(INPUT_SERVER,"REQUEST_METHOD") == 'POST'){
             $dados = filter_input_array(INPUT_POST);
             header("location:/categorias/?id=".serialize($dados['id']));
        }
        return array('gastos' => GastosTable::all());
    }

    public function getTopCategorias($idCategoria){
        return GastosTable::getTopCategorias($idCategoria);
    }
}