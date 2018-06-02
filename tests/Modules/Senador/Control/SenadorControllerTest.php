<?php
namespace Ufrpe\Senadores\Modules\Senador\Control;

use PHPUnit\Framework\TestCase;

  class SenadorControllerTest extends TestCase {
  
  	public function test_indexAction(){
  		$senador = new SenadorController();
  		$this->assertInternalType("array",$senador->indexAction());

  	}
}

