<html>
    <head>
        <title>Meu Senador</title>
        <?php
        require_once filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/../vendor/autoload.php';
        $ctrl = new Ufrpe\Senadores\Modules\Senador\Control\SenadorController();
        $dados = $ctrl->indexAction();
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
         integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" 
         crossorigin="anonymous"/>
        <link rel="stylesheet" href="css/main.css" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-default bg-white mb-4">
        <div class="row">
            <div class="col-md-2">
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="img/logo meu senador 2.png" class="img-thumbnail size"/>
                    <h5 class="caption center-block">Meu Senador</h5>
                </a>
            </div>
        </div>
        <div class="links">
            <a href="">Home</a>
            <a href="/contato">Contato</a>
            <a href="" onload="disabled" data-toggle="modal" data-target="#modalSobre">Sobre</a>
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
                                <option value="<?= $opt['0'] ?>"
                                <?php if (filter_input(INPUT_POST, "parlamentares") == $opt['0']): ?>
                                            selected
                                        <?php endif; ?>
                                        ><?= $opt['1'] ?></option>
                                    <?php endforeach; ?>
                            </select>
                            </div>
                    <input type="button" name="btnOk" value="Confirma" onload="disabled" 
                           data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-success">
                        </form>
                    </div>
                    <!-- Tabela de Gastos -->
                    <div class="col-md-8">
                    <h5>Tabela de Gastos - Atualizado até 17/06/2018</h5><a href="gastos/show.php">Listar todos</a>
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Senador</th><th>Gastos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dados['gastos'] as $row): ?>
                            <tr>
                                <td><a href="gastos/?id=<?=$row[0]?>"><?=$row[1]?></a></td><td>R$ <?=\number_format($row[3],2,",",".")?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Fonte: Senado Federal (http:www.senado.gov.br/transparencia)</td>
                        </tr>
                    </tfoot>
                    </table>
                    </div>
                    <!-- Fim da tabela de gastos -->
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
            <!-- Estrutura do modal Sobre-->
            <div class="modal" id="modalSobre">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Titulo -->
                        <div class="modal-header">
                            <h4 class="modal-title">Sobre</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Corpo -->
                        <div class="modal-body" id="modal">
                        <h5>Meu Senador</h5>
                        <p>Somos um projeto de tecnologia com a finalidade de compartilhar informações
                        acessíveis a qualquer pessoa sobre gastos de senadores em exercício do mandato.
                        Meu Senador trata da análise dos gastos da cota para exercício da atividade parlamentar
                        dos senadores eleitos através do acesso dos dados abertos do Senado Federal e do tratamento
                        desses dados de forma a se tornarem dados facilmente acessados e interpretados pela população.
                        A idéia do sistema surgiu através do envolvimento de três discentes do curso de Licenciatura
                        da Computação da Universidade Federal Rural de Pernambuco com a disciplina de projeto de desenvolvimento
                        de software, como forma de desenvolver um sistema para fiscalizar gastos públicos.</p>
                        <span>v.1.1.0</span>
                        <ul>Autores:
                        <li>Antonio Ricardo A Castelo Branco</li>
                        <li>Wellington Eugênio</li>
                        <li>Verônica M C Santos</li>
                        </ul>
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

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="js/select_dinamico.js" type="text/javascript"></script>
    </body>
</html>