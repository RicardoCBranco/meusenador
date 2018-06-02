<?php
namespace Ufrpe\Senadores\Modules\Senador\Control;

use Ufrpe\Senadores\Modules\Senador\Model\SenadorTable;

  class SenadorController  {
      private $table;
      
        public function __construct() {
            $this->table = SenadorTable::all();
        }
  
  	public function indexAction(){
            return array('senadores' => $this->table);
  	}
        
        public function showAction(){
           $codigo = filter_input(INPUT_GET, "parlamentar");
           $parlamentar = $this->table[$codigo];
           return array('parlamentar' => $parlamentar);
        }
        
        public function gastosAction(){
            $nome = filter_input(INPUT_GET, "nome");
            $gastos = SenadorTable::gastos($nome);
            return array('gastos' => $gastos);
        }

  
}

