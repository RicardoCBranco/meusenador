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
    <script language="JavaScript" src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="../js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap4.min.css">

    <script>
            $(document).ready(function(){
                $("#gastos").DataTable();
            });
    </script>

    <!-- Seleciona Senador para gerar gráfico -->
    <script>
        var i = 0;
        function seleciona(id){
            if(i == 5){
                alert("Somente é possível escolher até 5 senadores!");
            }else{
                $.get("get.php?parlamentar="+id,function(dados){
                 $("#seleciona"+i).html(dados);
                 i++;
                });
            }
        }
    </script>

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
                    <div class="col-md-11">
                        <h2>Tabela com média dos gastos diários dos senadores nos últimos 8 anos</h2>
                    </div>
                    <div class="col-md-1 col-md-offset-1">
                        <a href="/"><image src="../img/house-icon-green.png" title="Home"
                        width="40" height="40" class="img-fluid"></a>
                    </div>
        </div>
        <div>
        </div>
        <div class="card">
                <form method="post" action="" class="form">
                <div class="card-header">
                    <h5>Senadores selecionados:</h5>
                </div>
                <div class="card-body">
                    <div class="form-control"><label class="sr col-md-6">Senador</label><label class="sr col-md-6">Partido</label></div>
                    <div id="seleciona0" class="row">
                    </div>
                    <div id="seleciona1" class="row">
                    </div>
                    <div id="seleciona2" class="row">
                    </div>
                    <div id="seleciona3" class="row">
                    </div>
                    <div id="seleciona4" class="row">
                    </div>
                    <div>
                        <input type="submit" name="btn" value="Comparar" class="btn btn-success">
                    </div>
            </div>
            </form>
            </div>
        </div>
        <div class="mb-5">
        <span>Selecione até 05 senadores na tabela abaixo clicando no botão "Sel." o nome e o partido aparecerão acima,
        após selecionar os senadores desejados aperte no botão "Comparar" para gerar o gráfico comparativo. </span>
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
                        <td><input type="button" name="btn" onclick="seleciona(<?=$row['codigo_parlamentar']?>)"
                        value="Sel." class="btn btn-outline-primary"></td>
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
        </div>
    </div>
</body>
</html>