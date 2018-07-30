<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
         <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <script language="JavaScript" src="../js/jquery-3.3.1.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap4.min.css">

        <!-- Grãficos -->
        <script src="../categorias/code/highcharts.js"></script>
        <script src="../categorias/code/modules/data.js"></script>
        <script src="../categorias/code/modules/exporting.js"></script>
        <script src="../categorias/code/modules/export-data.js"></script>

        <script>
            $(document).ready(function(){
                $("#gastos").DataTable();
            });
        </script>
        <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
        <?php
            include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
            $ctrl = new \Ufrpe\Senadores\Modules\Gastos\Control\GastosController();
            $dados = $ctrl->indexAction();
            $soma = 0;
        ?>
        <title>Gastos do Senador <?=$dados['senador']['nome_parlamentar']?></title>
        <meta property="og:url"           content="http://meusenador<?=filter_input(INPUT_SERVER,"REQUEST_URI")?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="Gastos do Senador <?=$dados['senador']['nome_parlamentar']?>" />
        <meta property="og:description"   content="Quadro com os gastos relativo ao senador <?=$dados['senador']['nome_parlamentar']?>
        com base nos dados existentes no portal da Transparência do Senado Federal" />
        <meta property="og:image"         content="../img/logo meu senador 2.png" />

    </head>
    <body>
        <div class="container container-fluid">
            <div class="content">
                <div class="row">
                    <div class="col-md-11">
                        <h2><?=$dados['senador']['nome_parlamentar']?></h2>
                    </div>
                    <div class="col-sm-1 col-md-1">
                        <a href="/"><image src="../img/house-icon-green.png" title="Home" class="img-thumbnail"></a>
                    </div>
                    <hr>
                    <div class="col-md-2">
                        <image src="<?=$dados['senador']['url_foto_parlamentar']?>" title="foto parlamentar"
                        class="image img-thumbnail" alt="<?=$dados['senador']['nome_parlamentar']?>">
                    </div>
                    <div class="col-md-1">
                        <?php foreach($dados['premios'] as $premio):?>
                            <img src="../img/<?=$premio['img']?>" class="image img-thumbnail"
                            alt="<?=$premio['tipo_despesa']?>" title="<?=$premio['colocacao']?>º lugar entre os que mais gastam com <?=$premio['titulo']?>">
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-4">
                        <b>Nome: </b><?=$dados['senador']['nome_completo_parlamentar']?><br>
                        <b>Partido: </b><?=$dados['senador']['sigla_partido_parlamentar']?><br>
                        <b>UF: </b><?=$dados['senador']['uf_parlamentar']?><br>
                        <b>Email: </b><?=$dados['senador']['email_parlamentar']?><br>
                        <b>Gasto médio por dia:<image src="../img/info.png" alt="info.png" title="Calculo dos gastos através da soma dos gastos totais dividido pela diferença entre a data maior e a data menor registrada" height="20"> </b>R$ <?=\number_format($dados['senador']['gastos'],2,",",".")?><br>
                        <b>Soma dos gastos: </b>R$ <?=\number_format($dados['senador']['total'],2,",",".")?>
                        <!-- Load Facebook SDK for JavaScript -->
                        <div id="fb-root"></div>
                        <!-- Your share button code -->
                        <div class="fb-share-button";
                            data-href="http://meusenador<?=filter_input(INPUT_SERVER,"REQUEST_URI")?>" 
                            data-layout="button_count">
                        </div>
                    </div>
                    <div id="container" style="min-width: 160px; height: 320px; margin: 0 auto" class="col-md-5"></div>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Período</th>
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
            <td>Categorias</td>
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
</div>
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
        <script type="text/javascript">
Highcharts.chart('container', {
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Gastos por Categorias'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Valores(R$)'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>
    </body>
</html>
