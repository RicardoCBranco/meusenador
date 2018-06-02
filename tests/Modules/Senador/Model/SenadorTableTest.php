<?php
namespace Ufrpe\Senadores\Modules\Senador\Model;

use PHPUnit\Framework\TestCase;
/**
 * Description of SenadorTable
 *
 * @author ricardo
 */
class SenadorTableTest extends TestCase{
    
    public function test_get_file(){
  		$senador = new SenadorTable();
  		$this->assertInternalType('array',$senador->all());
    }
}
