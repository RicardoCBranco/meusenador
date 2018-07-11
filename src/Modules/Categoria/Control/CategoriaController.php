<?php
namespace Ufrpe\Senadores\Modules\Categoria\Control;
use \Ufrpe\Senadores\Modules\Categoria\Model\CategoriaTable;

class CategoriaController{
    public function __construct(){}

    public function indexAction(){
        $tbl = new CategoriaTable();
        return array('categorias' => $tbl->all());
    }

    public function detailAction(){
        $id = filter_input(INPUT_GET,"id");
        $tbl = new CategoriaTable();
        return array('detailpage' => $tbl->dados($id),'categoria' => $tbl->find($id));
    }   
}