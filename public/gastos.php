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
        <style  type="text/css"><?php include_once filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/../vendor/twbs/bootstrap/dist/css/bootstrap.css"; ?></style>
        <style  type="text/css"><?php include_once filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/../vendor/twbs/bootstrap/docs/4.1/examples/navbar-static/navbar-top.css"; ?></style>
    </head>
    <body>
        <?php
        include_once filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/../vendor/autoload.php";
        $ctrl = new \Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
        $dados = $ctrl->gastosAction();
        $soma = 0;
        ?>
        <div class="container container-fluid">
            <div class="content">
                <h2><?= filter_input(INPUT_GET, "nome")?></h2><a href="index.php" class="btn btn-success">Home</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo de Despesa</th><th>CNPJ/CPF</th>
                            <th>Fornecedor</th>
                            <th>Detalhamento</th>
                            <th>Valor Reembolsado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados['gastos'] as $row): ?>
                            <tr>
                                <td><?= $row[7] ?></td>
                                <td><?= utf8_decode($row[3]) ?></td>
                                <td><?= $row[4] ?></td>
                                <td><?= utf8_decode($row[5]) ?></td>
                                <td><?= utf8_decode($row[8]) ?></td>
                                <td>R$ <?= number_format($row[9], 2, ',', '.') ?></td>
                                <?php $soma += $row[9] ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="footer">
                        <tr>
                            <td colspan="5">Total de Gastos: </td>
                            <td>R$ <?= number_format($soma, 2, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="js/select_dinamico.js" type="text/javascript"></script>
    </body>
</html>
