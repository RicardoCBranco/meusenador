<?php
namespace Ufrpe\Senadores\Modules\Gastos\Control;

use \Ufrpe\Senadores\Modules\Senador\Model\SenadorTable;
use \Ufrpe\Senadores\Modules\Gastos\Model\GastosTable;

class GastosController{
    public function __construct(){}
    
    public function indexAction(){
        $gastos = GastosTable::show(filter_input(INPUT_GET,"id"));
        $senador = SenadorTable::find(filter_input(INPUT_GET,"id"));
        return array('gastos' => $gastos,'senador' => $senador);
    }

    public function showAction(){
        return array('gastos' => GastosTable::all());
    }
}