<?php 
require '../connections/configMySQL.php';
require '../php_controller/UserDaoMysql.php';
session_start();

$UserDao = new UserDaoMysql($pdo);

$email = filter_input(INPUT_POST, 'formIndexEmail', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'formIndexSenha');

if ($email && $senha){
    $user = $UserDao->login($email, $senha);
    
    if($user){
        $_SESSION['id'] = $user->getId();
        $_SESSION['nome'] = $user->getNome();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['permissao'] = $user->getPermissaoId();
        $_SESSION['token'] = $user->getToken();
        header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/dashboard.php");
        exit;
    }
} 

$_SESSION['flash'] = "Email e/ou senha incorretos";
header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php");
exit;





?>