<?php
namespace Ufrpe\Senadores\Modules\Extractor\Control;

class ExtractorController{
    public function __construct(){}

    public function inserts(){
        echo "Inicio do Extractor<br>";
        $ano = 2018;

        $ext = new \Ufrpe\Senadores\Modules\Extractor\Model\Extractor();
        $ext->insertSenadores();
        $ext->deleteGastos();
        for($i = $ano; $i >= $ano - 8; $i--){
            $ext->insertGastos($i);
        }
        $ext->criarTabelaCategorias();
        $ext->atualizaTabelaGastos();

        echo "Fim da Execução do Extractor";
    }
}