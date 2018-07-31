<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
            include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
			$ger = new \Ufrpe\Senadores\Modules\Categoria\Control\CategoriaController();
			$dados = $ger->detailAction();
        ?>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
         <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

        <!-- Grãficos -->
        <script src="code/highcharts.js"></script>
        <script src="code/modules/data.js"></script>
        <script src="code/modules/exporting.js"></script>
        <script src="code/modules/export-data.js"></script>
        <!-- Script para facebook -->
        <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
        </script>

        <title>Comparativo de Gastos:<?=implode(" - ",(array_column($dados['detailpage'],"nome_parlamentar")))?></title>
        <meta property="og:url"           content="http://meusenador<?=filter_input(INPUT_SERVER,"REQUEST_URI")?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="Comparativo de Gastos: <?=implode(" - ",(array_column($dados['detailpage'],"senador")))?>" />
        <meta property="og:description"   content="Gráfico comparativo de gastos dos senadores <?=implode(" - ",(array_column($dados['detailpage'],"senador")))?>
        com base nos dados existentes no portal da Transparência do Senado Federal" />
        <meta property="og:image"         content="../img/logo meu senador 2.png" />
	</head>
	<body>
        
<div class="content">
    <div class="container">
    <div class="row">
        <div class="col-md-11">
            <h2>Comparativo de Gastos: <?=implode(" - ",(array_column($dados['detailpage'],"nome_parlamentar")))?></h2>
        </div>
        <div class="col-md-1">
            <a href="/"><image src="../img/house-icon-green.png" title="Home" class="img-responsive" width="20" height="20"></a>
        </div>
    </div>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<!-- Your share button code -->
<div class="fb-share-button";
    data-href="http://meusenador<?=filter_input(INPUT_SERVER,"REQUEST_URI")?>" 
    data-layout="button_count">
</div>

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
            <td><?=$ln['nome_parlamentar']?></td>
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