<?php
namespace Ufrpe\Senadores\Modules\Premiacao\Control;

use \Ufrpe\Senadores\Modules\Premiacao\PremiacaoTable;

class PremiacaoController{
    public function premioParlamentar($codigo){
        $premio = PremiacaoTable::find($codigo);
        return $premio;
    }
}