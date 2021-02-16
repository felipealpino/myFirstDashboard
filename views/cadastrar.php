<?php
require '../php_controller/UserDaoMysql.php';
session_start();

$UserDao = new UserDaoMysql($pdo);
$isLogged = $UserDao->isLogged($_SESSION['email']);
if(!$isLogged){
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/package/dist/sweetalert2.min.css">
    <title>Cadastre-se</title>
</head>
<body>



    <div class="form-width-cadastro">
        <form method="POST" action="../php_controller/cadastrar_action.php" class="form-cadastrar-login" id="form-cadastrar-login">
            
        <?php
            if(isset($_SESSION['flash']) && $_SESSION['flash'] != ''){
                echo '<div class="flash-warning">';
                print_r($_SESSION['flash']);
                $_SESSION['flash'] = '';
                echo '</div>'; 
            }
        ?>

            <div class="form-group">
                <label for="email-input-cadastrar">Nome Completo</label>
                <input type="text" name="formCadastrarNome" class="form-control" id="nome-form-cadastrar" placeholder="Digite um nome">
            </div>
            
            <div class="form-group">
                <label for="email-input-cadastrar">Email</label>
                <input type="email" name="formCadastrarEmail" class="form-control" id="emailf-form-cadastrar" placeholder="Digite um email válido">
            </div>

            <div class="senha-input-cadastrar">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" name="formCadastrarSenha" class="form-control" id="senha-form-cadastrar" placeholder="Digite sua senha">
            </div>

            <div class="confirmar-senha-input-cadastrar">
                <label for="exampleInputPassword1">Confirmar enha</label>
                <input type="password" name="formCadastrarConfirmarSenha" class="form-control" id="confirmar-senha-form-cadastrar" placeholder="Digine novamente a senha">
            </div>
            
            <button type="submit" class="btn btn-submit-forms btn-submit-cadastrar">Cadastrar</button>

        </form>
    </div>

    <script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/localization/messages_pt_BR.min.js"></script>
    <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="../plugins/package/dist/sweetalert2.all.min.js"></script>
    <script src="../js/validate/validate-cadastrar.js"></script>
    <script src="../plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    <script src="../js/all.js"></script>
</body>
</html>