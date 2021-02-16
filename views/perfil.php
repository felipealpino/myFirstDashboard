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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/package/dist/sweetalert2.min.css">


        <?php include 'all.php';?>

        <div class="right-side-dashboard">    
            <div class="top-dashboard-mobile left-icon">
                <div class="top-dashboard">
                    <i class="fas fa-user-alt"></i>
                    <span>Perfil</span>
                </div>
                <div class="open-close-mobile">
                    <div class="open-close-mobile-icon">
                        <i class="fas fa-align-justify"></i>
                    </div>
                </div>
            </div>
            <div class="content-dashboard content-perfil">
                <div class="perfil-usuario">
                    <div class="perfil-usuario-foto">
                        <!-- img cachorro -->
                    </div>

                    <div class="perfil-usuario-dados">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email-input-index">Nome</label>
                                <input type="text" name="formPerfilNome" class="form-control" id="nome-form-perfil" placeholder="Edite seu nome">
                            </div>
                            <div class="form-group">
                                <label for="cpf-input-perfil">Cpf</label>
                                <input type="text" name="formPerfilCpf" class="form-control" id="cpf-form-perfil" placeholder="Edite seu CPF">
                            </div>
                            <div class="form-group">
                                <label for="senha-input-perfil">Nova senha</label>
                                <input type="password" name="formPerfilSenha" class="form-control" id="senha-form-perfil" placeholder="Digite uma nova senha">
                            </div>
                            <div class="form-group">
                                <label for="nova-senha-input-perfil">Repita a nova senha</label>
                                <input type="email" name="formPerfilNovaSenha" class="form-control" id="nova-senha-form-index" placeholder="Repita a nova senha">
                            </div>
                            <button type="submit" class="btn btn-submit-forms btn-submit-cadastrar" onclick="event.preventDefault()">Editar</button>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>

    <script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/localization/messages_pt_BR.min.js"></script>
    <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="../plugins/package/dist/sweetalert2.all.min.js"></script>
    <script src="../plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    <script src="../js/all.js"></script>
</body>
</html>