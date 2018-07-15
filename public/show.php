<?php
require_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT").'/../vendor/autoload.php';
$ctrl = new \Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
$dados = $ctrl->showAction();
$parlamentar = $dados['parlamentar'];
?>
<div class="row">
    <div class="col-md-4">
        <img src="<?=$parlamentar['url_foto_parlamentar']?>"
            class="img-thumbnail" style="width:100%">
    </div>
    <div class="col-md-8">
        <h3><?=$parlamentar['nome_parlamentar']?></h3>
        <h4><?=$parlamentar['sigla_partido_parlamentar']." - "
            .$parlamentar['uf_parlamentar']?></h4>  
    </div>
    <div class="col-md-6">
        <?php foreach($dados['premios'] as $premio): ?>
        <img src="img/<?=$premio['img']?>" class="image img-thumbnail"
        alt="<?=$premio['categoria_despesa']?>" title="<?=$premio['titulo']?>">
        <?php endforeach; ?>
    </div>
    <div class="col-md-12">
        <span><b>Nome Completo: </b><?=$parlamentar['nome_completo_parlamentar']?></span><br>
        <span><b>Email: </b><?=$parlamentar['email_parlamentar']?></span><br>
        <span><b>Homepage: </b><a href="<?=$parlamentar['url_pagina_parlamentar']?>" target="__blank">Link</a></span><br>
        <span><b>Gastos Médios por dia: </b>R$ <?=number_format($parlamentar['gastos'],2,",",".")?></span><br>
        <span><b>Soma dos gastos: </b>R$ <?=number_format($parlamentar['total'],2,",",".")?></span><br>
        <a href="/gastos/?id=<?=$parlamentar['codigo_parlamentar']?>">Detalhamento dos gastos</a>
    </div>
</div>


