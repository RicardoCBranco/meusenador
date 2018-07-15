<?php
namespace Ufrpe\Senadores\Modules\Gastos\Control;

use \Ufrpe\Senadores\Modules\Senador\Model\SenadorTable;
use \Ufrpe\Senadores\Modules\Gastos\Model\GastosTable;
use \Ufrpe\Senadores\Modules\Premiacao\Model\PremiacaoTable;

class GastosController{
    public function __construct(){}
    
    public function indexAction(){
        $id = filter_input(INPUT_GET,"id");
        $gastos = GastosTable::show($id);
        $senador = SenadorTable::find($id);
        $premios = PremiacaoTable::find($id);

        return array('gastos' => $gastos,'senador' => $senador,'premios' => $premios);
    }

    public function showAction(){
        return array('gastos' => GastosTable::all());
    }
}