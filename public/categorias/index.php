<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gráfico de Gastos dos Senadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
         integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"/>
    <?php
        include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
        $ctrl = new \Ufrpe\Senadores\Modules\Categoria\Control\CategoriaController();
        $dados = $ctrl->indexAction();
    ?>
</head>
<body>
    <div class="content">
        <div class="container">
        <div class="row justify-content-center">
                <div class="col-md-11">
                <h2>Categoria de Gastos</h2>
                </div>
                <div class="col-md-1">
                    <a href="/"><image src="../img/house-icon-green.png" title="Home" class="img-fluid"></a>
                </div>
                <hr>
            </div>
            <div class="links">
                <ol>
                    <?php foreach($dados['categorias'] as $ln):?>
                        <li><a href="detail.php?id=<?=$ln['idcategoria']?>" target="graficos">
                        <?=$ln['tipo_despesa']?></a></li>
                    <?php endforeach;?>
                </ol>
            </div>
            <div class="embed-responsive embed-responsive-4by3">
                <iframe class="embed-responsive-item" name="graficos"></iframe>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>