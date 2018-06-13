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
</head>
<body>

    <div class="content">
        <div class="container">
        <div class="row right">
        <div class="col-sm-12">
        <a href="/" class="btn btn-success">Home</a>
        </div>
        </div>
        <div class="row justify-content-center"> 
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Contato
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