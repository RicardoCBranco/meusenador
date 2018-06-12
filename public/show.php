<?php
require_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT").'/../vendor/autoload.php';
$ctrl = new \Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
$dados = $ctrl->showAction();
$parlamentar = $dados['parlamentar'];
?>
<div class="row">
    <div class="col-sm-4">
        <img src="<?=$parlamentar->url_foto_parlamentar?>"
            class="img-thumbnail" style="width:100%">
    </div>
    <div class="col-lg-6">
        <a href="gastos/?nome=<?=$parlamentar->nome_parlamentar?>">
    <img class="img-fluid img-thumbnail" src="img/Dinheiro1.png"
         title="Gastos" width="50px" height="50px">
    </a>
    </div>
    <div class="col-lg-10">
  <h3><?=$parlamentar->nome_parlamentar?></h3>
<h4><?=$parlamentar->sigla_partido_parlamentar." - "
        .$parlamentar->uf_parlamentar?></h4>  
</div>
    
</div>


