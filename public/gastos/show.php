<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista dos Senadores por Gastos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <?php
            include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
            $ctrl = new \Ufrpe\Senadores\Modules\Gastos\Control\GastosController();
            $dados = $ctrl->showAction();
        ?>
</head>
<body>
    <div class="container">
        <div class="content">
        <div class="row">
                    <div class="col-md-11">
                        <h2>Relação dos Parlamentares por Gastos nos últimos 8 anos</h2>
                    </div>
                    <div class="col-md-1">
                        <a href="/"><image src="../img/house-icon-green.png" title="Home" class="img-fluid"></a>
                    </div>
                </div>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Senador</th><th>Partido</th><th>Média de Gastos Diários (R$)</th><th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['gastos'] as $row): ?>
                    <tr>
                        <td><?=$row['senador']?></td>
                        <td><?=$row['sigla_partido_parlamentar']."/".$row['uf_parlamentar']?></td>
                        <td><?=\number_format($row['soma'],2,",",".")?></td>
                        <td><a href="/gastos?id=<?=$row['codigo_parlamentar']?>">Gastos</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>