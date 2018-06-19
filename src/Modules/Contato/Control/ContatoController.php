<?php
namespace Ufrpe\Senadores\Modules\Contato\Control;

class ContatoController{
    public function __construct(){}

    public function indexAction(){
        if(filter_input(INPUT_SERVER,"REQUEST_METHOD") == "POST"){
            $mensagem = filter_input(INPUT_POST,"mensagem")."<br>Nome: ".filter_input(INPUT_POST,"nome").
            "<br>Telefone: ".filter_input(INPUT_POST,"telefone");
            $contato = new \Ufrpe\Senadores\Modules\Contato\Model\Contato();
            $contato->envia(filter_input(INPUT_POST,"email"),$mensagem);
            return array("mensagem" => "Mensagem enviada!");
        }
    }
}