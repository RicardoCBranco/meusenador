<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
         integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" 
         crossorigin="anonymous" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
         <?php
        require_once filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/../vendor/autoload.php';
        $ctrl = new Ufrpe\Senadores\Modules\Contato\Control\ContatoController();
        $dados = $ctrl->indexAction();
        ?>
</head>
<body>
    <div class="content">
        <div class="container">
        <div class="row">
                <div class="col-md-11">
                </div>
                <div class="col-md-1">
                    <a href="/"><image src="../img/house-icon-green.png" title="Home" class="img-fluid"></a>
                </div>
            </div>
        <?php if(isset($dados['mensagem'])): ?>
        <div class = "alert alert-success">
        <?=$dados['mensagem']?>
        </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Contato</h4>
                </div>
                <div class="card-body">
                <form class="form-sign" method="post" action="">
                <div class="form-group">
                    <label for="nome" class="sr">NOME*</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email" class="sr">EMAIL*</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telefone" class="sr">TELEFONE</label>
                    <input type="tel" name="telefone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mensagem" class="sr">MENSAGEM</label>
                    <textarea name="mensagem" class="form-control"></textarea>
                </div>
                <div class="g-recaptcha" data-sitekey="6LcWEmEUAAAAACK5YWNlF5H6jwF76SjY44ku3VZF"></div>
                <input type="submit" value="Enviar" class="button btn-success">
            </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>