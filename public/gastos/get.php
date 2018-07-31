<?php
require_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT").'/../vendor/autoload.php';
$ctrl = new \Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
$dados = $ctrl->showAction();
$parlamentar = $dados['parlamentar'];
?>
<div class="col-md-6">
<input type="hidden" name="id[]" value="<?=$parlamentar['codigo_parlamentar']?>">
<?=$parlamentar['nome_parlamentar']?></div>
<div class="col-md-6"><?=$parlamentar['sigla_partido_parlamentar']."/".$parlamentar['uf_parlamentar']?></div>