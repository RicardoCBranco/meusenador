<?php
require_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT").'/../vendor/autoload.php';
$ctrl = new \Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
$dados = $ctrl->showAction();
$parlamentar = $dados['parlamentar'];
?>
<div class="row">
    <div class="col-sm-4">
        <img src="<?=$parlamentar['url_foto_parlamentar']?>"
            class="img-thumbnail" style="width:100%">
    </div>
    <div class="col-lg-8">
  <h3><?=$parlamentar['nome_parlamentar']?></h3>
<h4><?=$parlamentar['sigla_partido_parlamentar']." - "
        .$parlamentar['uf_parlamentar']?></h4>  
</div>
    <div class="col-lg-12">
        <span><b>Nome Completo: </b><?=$parlamentar['nome_completo_parlamentar']?></span><br>
        <span><b>Email: </b><?=$parlamentar['email_parlamentar']?></span><br>
        <span><b>Homepage: </b><a href="<?=$parlamentar['url_pagina_parlamentar']?>" target="__blank">Link</a></span><br>
        <span></span><b>Gastos: </b>R$ <a href="/gastos/?id=<?=$parlamentar['codigo_parlamentar']?>">
        <?=number_format($parlamentar['gastos'],2,",",".")?></span>
        </a>
    </div>
</div>


