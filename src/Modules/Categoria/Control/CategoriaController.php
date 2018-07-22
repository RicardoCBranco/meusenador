<?php
namespace Ufrpe\Senadores\Modules\Categoria\Control;
use \Ufrpe\Senadores\Modules\Categoria\Model\CategoriaTable;

class CategoriaController{
    public function __construct(){}

    public function indexAction(){
        return array('categorias' => CategoriaTable::all());
    }

    public function detailAction(){
       $ids = unserialize(filter_input(INPUT_GET,"id"));
       $array = array();
       foreach($ids as $id){
            $array = array_merge(CategoriaTable::gastosParlamentar($id),$array);
        }
        return array('detailpage' => $array); 
    }
}