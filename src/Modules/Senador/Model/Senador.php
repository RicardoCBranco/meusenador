<?php
namespace Ufrpe\Senadores\Modules\Senador\Model;

class Senador{
    private $codigoParlamentar;
    private $emailParlamentar;
    private $nomeParlamentar;
    private $nomeCompletoParlamentar;
    private $siglaPartidoParlamentar;
    private $ufParlamentar;
    private $urlFotoParlamentar;
    private $urlPaginaParlametar;

    public function __construct(){}

    public function getCodigoParlamentar(){
        return $this->codigoParlamentar;
    }

    public function getEmailParlamentar(){
        return $this->emailParlamentar;
    }

    public function getNomeParlamentar(){
        return $this->nomeParlamentar;
    }

    public function getNomeCompletoParlamentar(){
        return $this->nomeCompletoParlamentar;
    }

    public function setCodigoParlamentar($codigoParlamentar){
        $this->codigoParlamentar = $codigoParlamentar;
    }
}