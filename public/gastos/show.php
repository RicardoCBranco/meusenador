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
            <h3>Relação dos Parlamentares por Gastos nos últimos 08 anos</h3><a href="/" class="btn btn-success">Home</a>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Senador</th><th>Gastos (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['gastos'] as $row): ?>
                    <tr>
                        <td><?=$row[1]?></td>
                        <td><?=\number_format($row[3],2,",",".")?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>