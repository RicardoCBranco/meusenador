<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista de Senadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <?php
        require_once filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/../vendor/autoload.php';
        $ctrl = new Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
        $ctlPr = new \Ufrpe\Senadores\Modules\Premiacao\Control\PremiacaoController();
        $dados = $ctrl->estadosAction();
    ?>
</head>
<body>
    <div class="container">
        <div class="content">

        <div class="row">
        <div class="col-md-11">
            <h2>Senadores/<?=filter_input(INPUT_GET,"uf")?></h2>
        </div>
        <div class="col-md-1">
            <a href="/"><image src="../img/house-icon-green.png" title="Home" width="40" height="40" class="img-fluid"></a>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Parlamentar</th>
                <th>Dados</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($dados['senadores'] as $ln): ?>
        <tr>
                
            <td>
                <div class="col-md-4">
                    <image class="img-thumbnail" src="<?=$ln['url_foto_parlamentar']?>"
                    alt="<?=$ln['nome_parlamentar']?>">
                    
                </div>
            </td>
            <td>
                Nome:<?=$ln['nome_parlamentar']?><br>   
                Email: <?=$ln['email_parlamentar']?><br>
                Partido: <?=$ln['sigla_partido_parlamentar']?><br>
                Homepage: <a href="<?=$ln['url_pagina_parlamentar']?>">Link</a><br>
                Gasto Médio por dia:R$ <?=number_format($ln['gastos'],2,",",".")?><br>
                <a href="../gastos/?id=<?=$ln['codigo_parlamentar']?>">Detalhamento dos gastos</a><br>
                <?php foreach($ctlPr->premioParlamentar($ln['codigo_parlamentar']) as $img):?>
                <img src="../img/<?=$img['img']?>" alt="<?=$ln['premio']?>" title="<?=$img['colocacao']?>º lugar entre os que mais gastam com <?=$img['titulo']?>">
                <?php endforeach; ?>
            </td>
    </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</body>
</html>