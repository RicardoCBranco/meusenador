<html>
    <head>
        <title>Meu Senador</title>
        <?php
        require_once filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/../vendor/autoload.php';
        $ctrl = new Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
        $dados = $ctrl->indexAction();
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-default bg-white mb-4">
        <div class="row">
            <div class="col-md-2">
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="img/logo meu senador 2.png" class="img-thumbnail size">
                    <h5 class="caption center-block">Meu Senador</h5>
                </a>
            </div>
        </div>
        <div class="links">
            <a href="">Home</a>
            <a href="">Contato</a>
            <a href="">Sobre</a>
        </div>
        </nav>
        
        <div class="container">
            <div class="content">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                    <form method="post" action="" class="form-signin">
                    <div class="form-group">
                        <label for="parlamentares" class="sr">Parlamentar:</label>
                        <select name="parlamentares" class="form-control"
                                id="parlamentares" onchange="dados(this.id, 'modal')">
                            <option>Selecione um político</option>
                            <?php foreach ($dados['senadores'] as $opt): ?>
                                <option value="<?= $opt->getCodigoParlamentar() ?>"
                                <?php if (filter_input(INPUT_POST, "parlamentares") == $opt->getCodigoParlamentar()): ?>
                                            selected
                                        <?php endif; ?>
                                        ><?= $opt->getNomeParlamentar() ?></option>
                                    <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="button" name="btnOk" value="Confirma" onload="disabled" 
                           data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-success">
                </form>
                    </div>
                </div>
            </div>
            <!-- Estrutura do modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Titulo -->
                        <div class="modal-header">
                            <h4 class="modal-title">Meu Senador</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Corpo -->
                        <div class="modal-body" id="modal">
                        </div>
                        <!-- Rodapé -->
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        <!-- Fim do modal-content -->
                    </div>
                    <!-- Fim do modal -->
                </div>
            </div>
            <!-- Fim do Container -->
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="js/select_dinamico.js" type="text/javascript"></script>
    </body>
</html>