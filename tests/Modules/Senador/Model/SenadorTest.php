<?php
namespace Ufrpe\Senadores\Modules\Senador\Model;

use PHPUnit\Framework\TestCase;






  class SenadorTest extends TestCase {
      
      public function test_codigoParlamentar(){
          $senador = new Senador();
          $senador->setCodigoParlamentar(1);
          $this->assertInternalType("int", $senador->getCodigoParlamentar());
      }
  
}

