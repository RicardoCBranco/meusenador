<?php
namespace Ufrpe\Senadores\Modules\Contato\Control;

class ContatoController{
    private $secret = "6LcWEmEUAAAAAOQvrAkKGx278xEJdmBXuMd2uM9Z";
    public function __construct(){}

    public function indexAction(){
        if(filter_input(INPUT_SERVER,"REQUEST_METHOD") == "POST"){
            $answer = \json_decode(\file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$this->secret.
            '&response='.filter_input(INPUT_POST,'g-recaptcha-response')));
            if($answer->success){
                $mensagem = filter_input(INPUT_POST,"mensagem")."<br>Nome: ".filter_input(INPUT_POST,"nome").
                "<br>Telefone: ".filter_input(INPUT_POST,"telefone");
                $contato = new \Ufrpe\Senadores\Modules\Contato\Model\Contato();
                $contato->envia(filter_input(INPUT_POST,"email"),$mensagem);
                $alert = "<div class = 'alert alert-success'>Email enviado com sucesso!</div>";
            }else{
                $alert = "<div class = 'alert alert-warning'>Por favor faça a verificação do captcha abaixo!</div>";
            }
            
            return array("mensagem" => $alert);
        }
    }
}