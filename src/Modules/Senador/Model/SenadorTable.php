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
    
    public static function gastos($nome){
        $csv = fopen("http://www.senado.gov.br/transparencia/LAI/verba/2018.csv",'r');
        $array = [];
        while (($lin = fgetcsv($csv,4096,";")) !== FALSE){
            if(count($lin) == 10 && mb_strtoupper(utf8_encode($lin[2])) == mb_strtoupper($nome))  {
                $array[] = $lin;
            }
        }
        fclose($csv);
        array_shift($array);
        return $array;
    }
}
