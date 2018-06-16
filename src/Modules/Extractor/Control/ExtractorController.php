<?php
namespace Ufrpe\Senadores\Modules\Extractor\Control;

class ExtractorController{
    public function __construct(){}

    public function inserts(){
        $ext = new \Ufrpe\Senadores\Modules\Extractor\Model\Extractor();
        //$ext->insertSenadores();
        $ext->insertGastos();
    }
}