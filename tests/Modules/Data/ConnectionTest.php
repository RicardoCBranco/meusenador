<?php
namespace Ufrpe\Senadores\Data;

use PHPUnit\DBUnit\TestCase;

class ConnectionTest extends TestCase{

    public function getConnection(){
        $conn = Connection::getInstance();
        return $this->createDefaultDBConnection($conn);
    }
}