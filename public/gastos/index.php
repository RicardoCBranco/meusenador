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
            $ctrl = new \Ufrpe\Senadores\Modules\Gastos\Control\GastosController();
            $dados = $ctrl->indexAction();
            $soma = 0;
        ?>
    </head>
    <body>
        <div class="container container-fluid">
            <div class="content">
                <div class="row">
                    <div class="col-md-11">
                        <h2><?=$dados['senador']['nome_parlamentar']?></h2>
                    </div>
                    <div class="col-md-1">
                        <a href="/"><image src="../img/house-icon-green.png" title="Home" class="img-fluid"></a>
                    </div>
                    <hr>
                    <div class=col-md-2>
                        <image src="<?=$dados['senador']['url_foto_parlamentar']?>" title="foto.jpg"
                        class="image img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        Nome: <?=$dados['senador']['nome_completo_parlamentar']?><br>
                        Partido: <?=$dados['senador']['sigla_partido_parlamentar']?><br>
                        UF: <?=$dados['senador']['uf_parlamentar']?><br>
                        Email: <?=$dados['senador']['email_parlamentar']?><br>
                        Gasto médio por dia: R$ <?=\number_format($dados['senador']['gastos'],2,",",".")?><br>
                    </div>
                </div>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Data (Mês/Ano)</th>
                            <th>Tipo de Despesa</th><th>CNPJ/CPF</th>
                            <th>Fornecedor</th>
                            <th>Detalhamento</th>
                            <th>Valor Reembolsado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados['gastos'] as $row):?>
                            <tr>
                                <td><?=\date("d/m/Y",\strtotime($row['data']))?></td>
                                <td><?=$row['tipo_despesa']?></td>
                                <td><?=$row['cnpj_cpf']?></td>    
                                <td><?=$row['fornecedor']?></td>
                                <td><?=$row['detalhamento']?></td>
                                <td>R$ <?=\number_format($row['valor_reembolsado'],2,",",".")?></td>
                                <?php $soma += floatval(str_replace(",",".",$row[10])); ?>
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
