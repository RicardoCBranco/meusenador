<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gastos</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <?php
            include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
            $ctrl = new \Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
            $dados = $ctrl->gastosAction();
            $soma = 0;
        ?>
    </head>
    <body>
        <div class="container container-fluid">
            <div class="content">
                <h2>Gastos do Senador <?=filter_input(INPUT_GET,"nome")?></h2><a href="/" class="btn btn-success">Home</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo de Despesa</th><th>CNPJ/CPF</th>
                            <th>Fornecedor</th>
                            <th>Detalhamento</th>
                            <th>Valor Reembolsado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados['gastos'] as $row):?>
                            <tr>
                                <td><?=$row[7]?></td>
                                <td><?=utf8_encode($row[3])?></td>
                                <td><?=$row[4]?></td>
                                <td><?=utf8_encode($row[5])?></td>
                                <td><?=utf8_encode($row[8])?></td>
                                <td>R$ <?=$row[9]?></td>
                                <?php $soma += floatval(str_replace(",",".",$row[9])); ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="footer">
                        <tr>
                            <td colspan="5">Total de Gastos: </td>
                            <td>R$ <?=number_format($soma,2,',','.')?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </body>
</html>
