<?php

namespace Ufrpe\Senadores\Modules\Senador\Model;

class Senador {

    private $codigoParlamentar;
    private $nomeParlamentar;
    private $nomeCompletoParlamentar;
    private $sexoParlamentar;
    private $urlFotoParlamentar;
    private $emailParlamentar;
    private $siglaPartidoParlamentar;
    private $ufParlamentar;

    public function __construct() {
        
    }

    public function getCodigoParlamentar() {
        return $this->codigoParlamentar;
    }

    public function getNomeParlamentar() {
        return $this->nomeParlamentar;
    }

    public function getNomeCompletoParlamentar() {
        return $this->nomeCompletoParlamentar;
    }

    public function getSexoParlamentar() {
        return $this->sexoParlamentar;
    }

    public function getUrlFotoParlamentar() {
        return $this->urlFotoParlamentar;
    }

    public function getEmailParlamentar() {
        return $this->emailParlamentar;
    }

    public function getSiglaPartidoParlamentar() {
        return $this->siglaPartidoParlamentar;
    }

    public function getUfParlamentar() {
        return $this->ufParlamentar;
    }

    public function setCodigoParlamentar($codigoParlamentar) {
        $this->codigoParlamentar = $codigoParlamentar;
        return $this;
    }

    public function setNomeParlamentar($nomeParlamentar) {
        $this->nomeParlamentar = $nomeParlamentar;
        return $this;
    }

    public function setNomeCompletoParlamentar($nomeCompletoParlamentar) {
        $this->nomeCompletoParlamentar = $nomeCompletoParlamentar;
        return $this;
    }

    public function setSexoParlamentar($sexoParlamentar) {
        $this->sexoParlamentar = $sexoParlamentar;
        return $this;
    }

    public function setUrlFotoParlamentar($urlFotoParlamentar) {
        $this->urlFotoParlamentar = $urlFotoParlamentar;
        return $this;
    }

    public function setEmailParlamentar($emailParlamentar) {
        $this->emailParlamentar = $emailParlamentar;
        return $this;
    }

    public function setSiglaPartidoParlamentar($siglaPartidoParlamentar) {
        $this->siglaPartidoParlamentar = $siglaPartidoParlamentar;
        return $this;
    }

    public function setUfParlamentar($ufParlamentar) {
        $this->ufParlamentar = $ufParlamentar;
        return $this;
    }

    
    public function __clone() {
        
    }

    public function setClass(\SimpleXMLElement $xml) {
        $this->setCodigoParlamentar((int)$xml->CodigoParlamentar)
             ->setEmailParlamentar($xml->EmailParlamentar->__toString())
             ->setNomeCompletoParlamentar($xml->NomeCompletoParlamentar->__toString())
             ->setNomeParlamentar($xml->NomeParlamentar->__toString())
             ->setSexoParlamentar($xml->SexoParlamentar->__toString())
             ->setSiglaPartidoParlamentar($xml->SiglaPartidoParlamentar->__toString())
             ->setUfParlamentar($xml->UfParlamentar->__toString())
             ->setUrlFotoParlamentar($xml->UrlFotoParlamentar->__toString());
    }

}
