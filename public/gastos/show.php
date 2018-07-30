<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista dos Senadores por Gastos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
         <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <script language="JavaScript" src="../js/jquery-3.3.1.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <?php
            include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
            $ctrl = new \Ufrpe\Senadores\Modules\Gastos\Control\GastosController();
            $dados = $ctrl->showAction();
            $ctlPr = new \Ufrpe\Senadores\Modules\Premiacao\Control\PremiacaoController();
        ?>
</head>
<body>
    <div class="container">
        <div class="content">
        <div class="row">
                    <div class="col-md-6">
                        <h2>Relação dos Parlamentares por Gastos nos últimos 8 anos</h2>
                    </div>
                    <div class="col-md-3 col-md-offset-3">
                        <a href="/"><image src="../img/house-icon-green.png" title="Home"
                        width="40" height="40" class="img-fluid"></a>
                    </div>
        </div>
        <div>
        </div>
            <form method="post" action="">
            <div>
            <input type="submit" name="btn" value="Gerar Gráfico" class="btn btn-success">
            </div>
            <table class="table table-condensed table-hover" id="gastos">
                <thead>
                    <tr>
                        <th>Sel.</th><th>Senador</th><th>Partido</th><th>Média de Gastos Diários (R$)</th>
                        <th>Prêmio</th><th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['gastos'] as $row): ?>
                    <tr>
                        <td><input type="checkbox" name="id[]" value="<?=$row['codigo_parlamentar']?>"></td>
                        <td><?=$row['nome_parlamentar']?></td>
                        <td><?=$row['sigla_partido_parlamentar']."/".$row['uf_parlamentar']?></td>
                        <td><?=\number_format($row['soma'],2,",",".")?></td>
                        <td><?php foreach($ctlPr->premioParlamentar($row['codigo_parlamentar']) as $img):?>
                            <img src="../img/<?=$img['img']?>" alt="<?=$ln['premio']?>" 
                            title="<?=$img['colocacao']?>º lugar entre os que mais gastam com <?=$img['titulo']?>"
                            width="20" height="20">
                            <?php endforeach; ?>
                        </td>
                        <td><a href="/gastos?id=<?=$row['codigo_parlamentar']?>">Gastos</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </form>
        </div>
    </div>
</body>
</html>