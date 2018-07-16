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
        $inicio = !is_null(filter_input(INPUT_GET,"start"))?filter_input(INPUT_GET,"start"):0;
        $tbl = new CategoriaTable();

        return array('detailpage' => $tbl->dados($inicio),
         'contador' => $tbl->totalDeRegistros());
    }   
}