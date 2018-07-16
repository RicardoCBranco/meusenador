<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gráfico de Gastos</title>
        <?php
            include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
			$ger = new \Ufrpe\Senadores\Modules\Categoria\Control\CategoriaController();
			$dados = $ger->detailAction();
        ?>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
         <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
        function dados(id){
            $.get("detail.php?start="+id,function(dados){
                $("#datatable").empty();
                $("#datatable").html(dados);
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
            });
        }
        </script>        

        <!-- Grãficos -->
        <script src="code/highcharts.js"></script>
        <script src="code/modules/data.js"></script>
        <script src="code/modules/exporting.js"></script>
        <script src="code/modules/export-data.js"></script>
	</head>
	<body>
<div class="content">
    <div class="container">
    <div class="row">
        <div class="col-md-11">
            <h2>Categorias de Gastos</h2>
        </div>
        <div class="col-md-1">
            <a href="/"><image src="../img/house-icon-green.png" title="Home" class="img-fluid"></a>
        </div>
    </div>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
</div>
<div class="btn-toolbar float-right" role="toolbar" aria-label="Navegador">
    <div class="btn-group mr-2" role="group" arial-label="Grupo">
    <button onclick="dados(0)" class="btn btn-secondary">Início</button>
        <?php for($i = 1; $i < ($dados['contador']['total']/4)-1; $i++):?>
            <button onclick="dados(<?=(4*$i)?>)" class="btn btn-secondary"><?=$i?></button>
        <?php endfor;?>
    </div>
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