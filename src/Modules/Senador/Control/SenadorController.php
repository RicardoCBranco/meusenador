<?php
namespace Ufrpe\Senadores\Modules\Senador\Control;

use \Ufrpe\Senadores\Modules\Senador\Model\SenadorTable;

  class SenadorController  {
      private $table;
      
        public function __construct() {
            
        }
  
  	    public function indexAction(){
              return array("senadores" => SenadorTable::all());
  	    }
        
        public function showAction(){
           $codigo = filter_input(INPUT_GET, "parlamentar");
           $parlamentar = SenadorTable::find($codigo);
           return array('parlamentar' => $parlamentar);
        }
        
        public function gastosAction(){
            $gastos = SenadorTable::gastos(filter_input(INPUT_GET,"nome"));
            return array('gastos' => $gastos);
        }

  
}

