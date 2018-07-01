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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
         integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"/>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <script language="JavaScript" src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
        <script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <script>
            $(document).ready(function(){
                $("#gastos").DataTable();
            });
        </script>
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
                        <b>Nome: </b><?=$dados['senador']['nome_completo_parlamentar']?><br>
                        <b>Partido: </b><?=$dados['senador']['sigla_partido_parlamentar']?><br>
                        <b>UF: </b><?=$dados['senador']['uf_parlamentar']?><br>
                        <b>Email: </b><?=$dados['senador']['email_parlamentar']?><br>
                        <b>Gasto médio por dia: </b>R$ <?=\number_format($dados['senador']['gastos'],2,",",".")?><br>
                        <b>Soma dos gastos: </b>R$ <?=\number_format($dados['senador']['total'],2,",",".")?>
                    </div>
                </div>
                <table class="table table-striped table-bordered" id="gastos" style="width:100%">
                    <thead>
                        <tr>
                            <th>Data (Mês/Ano)</th>
                            <th>Tipo de Despesa</th>
                            <th>Fornecedor</th>
                            <th>Valor Reembolsado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados['gastos'] as $row):?>
                            <tr>
                                <td><?=\date("d/m/Y",\strtotime($row['data']))?></td>
                                <td><?=$row['tipo_despesa']?></td>    
                                <td><?=$row['fornecedor']?></td>
                                <td>R$ <?=\number_format($row['valor_reembolsado'],2,",",".")?></td>
                                <?php $soma += floatval(str_replace(",",".",$row[10])); ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
