<?php
    include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
	$ger = new \Ufrpe\Senadores\Modules\Categoria\Control\CategoriaController();
	$dados = $ger->detailAction();
?>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Senador</th>
            <th>Contratos</th>
            <th>Combustíveis</th>
            <th>Passagens</th>
            <th>Aluguel</th>
            <th>Material p/ Escritório</th>
            <th>Divulgação</th>
            <th>Segurança</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados['detailpage'] as $ln):?>
        <tr>
            <td><?=$ln['senador']?></td>
            <td><?=$ln['contratos']?></td>
            <td><?=$ln['combustiveis']?></td>
            <td><?=$ln['passagens']?></td>
            <td><?=$ln['aluguel']?></td>
            <td><?=$ln['material']?></td>
            <td><?=$ln['divulgacao']?></td>
            <td><?=$ln['seguranca']?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>