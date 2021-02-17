<?php 
require '../php_controller/UserDaoMysql.php';
session_start();

$UserDao = new UserDaoMysql($pdo);

if(isset($_SESSION['email'])){
    $isLogged = $UserDao->isLogged($_SESSION['email']);
    if($isLogged){
        header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/dashboard.php');
        exit;
    } 
}

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <title>My Dashboard</title>
</head>

<body>
    <div class="flex-page">
        <div class="side-bar">
            <form  method="POST" action="../php_controller/login_action.php" class="form-index-login" id="form-index-login">
                <div class="form-group">
                    <?php 
                        if(isset($_SESSION['flash']) && $_SESSION['flash'] != ''){
                            echo '<div class="flash-warning">';
                            print_r($_SESSION['flash']);
                            $_SESSION['flash'] = '';
                            echo '</div>'; 
                        }
                    ?>

                    <label for="email-input-index">Email address</label>
                    <input type="email" name="formIndexEmail" class="form-control" id="email-form-index" placeholder="Digite seu email" autofocus>
                </div>
                <div class="senha-input-index">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" name="formIndexSenha" class="form-control" id="senha-form-index" placeholder="Digite sua senha">
                </div>
                <button type="submit"  class="btn btn-submit-forms">Entrar</button>
            </form>
        </div>
        <!-- <div class="main-content"> </div>  -->
    </div>
    <script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="js/validate/validate-index.js"></script>
    <script src="../js/all.js"></script>

</body>
</html>