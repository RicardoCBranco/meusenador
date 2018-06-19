<?php
namespace Ufrpe\Senadores\Modules\Contato\Model;

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

class Contato{
    public function envia($de, $mensagem){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        try{
            $mail->SMTPAuth = true;
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Username = "meusenador@gmail.com";
            $mail->Password = "ufrpe2018";
            $mail->AddAddress("meusenador@gmail.com");
            $mail->AddReplyTo($de);
            $mail->SetFrom($de);
            $mail->Subject = "Contato";
            $mail->MsgHTML($mensagem);
            $mail->Send();
        } catch(Exception $e){
            echo "Error: ".$e->getMessage();
        }
    }
}