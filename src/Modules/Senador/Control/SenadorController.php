<?php
namespace Ufrpe\Senadores\Modules\Senador\Control;

use \Ufrpe\Senadores\Modules\Senador\Model\SenadorTable;
use \Ufrpe\Senadores\Modules\Gastos\Model\GastosTable;
use \Ufrpe\Senadores\Modules\Premiacao\Model\PremiacaoTable;
use \Ufrpe\Senadores\Modules\Categoria\Model\CategoriaTable;

  class SenadorController  {
      private $table;
      
        public function __construct() {
            
        }
  
  	    public function indexAction(){

          return array("senadores" => SenadorTable::all(), "gastos" => GastosTable::top(5),
            'categorias' => CategoriaTable::all(),'tabelas' => $this->montaTabelas());
  	    }
        
        public function showAction(){
           $codigo = filter_input(INPUT_GET, "parlamentar");
           $parlamentar = SenadorTable::find($codigo);
           $premios = PremiacaoTable::find($codigo);
           return array('parlamentar' => $parlamentar,'premios' => $premios);
        }

        public function estadosAction(){
          $sigla = filter_input(INPUT_GET,"uf");
          return array("senadores" => SenadorTable::getEstado($sigla));
        }

        private function montaTabelas(){
          return GastosTable::getTopCategorias();
        }
  
}

