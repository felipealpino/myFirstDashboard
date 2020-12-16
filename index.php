<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <title>My Dashboard</title>

</head>
<body>
    <div class="flex-page">
        <div class="side-bar">
            <form  method="POST" action="login_action.php" class="form-index-login" id="form-index-login">
                <div class="form-group">
                    <label for="email-input-index">Email address</label>
                    <input type="email" name="formIndexEmail" class="form-control" id="email-form-index" placeholder="Digite seu email">
                </div>
                <div class="senha-input-index">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" name="formIndexSenha" class="form-control" id="senha-form-index" placeholder="Digite sua senha">
                </div>
                <div class="form-goto-cadastro">
                    <button type="submit"  class="btn btn-submit-forms">Entrar</button>
                    <a href="cadastrar.php">Cadastre-se</a>
                </div>
            </form>
        </div>
        <div class="main-content"> </div> <!--  Imagem que não está aparecendo -->
    </div>
    <script src="plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/localization/messages_pt_BR.min.js"></script>
    <script src="plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="js/validate/validate-index.js"></script>
    <script src="js/all.js"></script>


</body>
</html>