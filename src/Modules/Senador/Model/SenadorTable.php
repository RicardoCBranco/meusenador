<?php

namespace Ufrpe\Senadores\Modules\Senador\Model;

class SenadorTable {

    private function __construct() {
        
    }

    public static function all() {
        $array = array();
        try {
            $file = simplexml_load_file("http://legis.senado.leg.br/dadosabertos/senador/lista/atual");
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
        $lista = $file->Parlamentares;

        foreach ($lista->Parlamentar as $xml) {
            $senador = new Senador();
            $senador->setClass($xml->IdentificacaoParlamentar);
            $array[$senador->getCodigoParlamentar()] = $senador;
        }
        return $array;
    }

    public static function gastos($nome) {
        $tabGastos = self::tabelaGastos();
        return array_values(array_filter($tabGastos, function($arrayValue) 
                use ($nome){return $arrayValue[2] == $nome;}));
    }
    
    private static function tabelaGastos(){
        $i = 0;
        $handle = fopen("http://www.senado.gov.br/transparencia/LAI/verba/2018.csv", "r");
        while (($data = fgetcsv($handle,0,";")) != FALSE){
            if(count($data) == 10){
             $csv[$i] = $data;
             $i++;   
            }
        }
        return $csv;
    }

}
