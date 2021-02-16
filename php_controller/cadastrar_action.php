<?php
require '../connections/configMySQL.php';
require '../php_controller/UserDaoMysql.php';
session_start();
$UserDao = new UserDaoMysql($pdo);

$nome = filter_input(INPUT_POST, 'formCadastrarNome');
$email = filter_input(INPUT_POST, 'formCadastrarEmail', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'formCadastrarSenha');
$confirmSenha = filter_input(INPUT_POST, 'formCadastrarConfirmarSenha');

$nome = trim($nome);
$email = trim($email);
$senha = trim($senha);
$confirmSenha = trim($confirmSenha);

if($nome && $email && $senha && $confirmSenha){
    $cadastrado = $UserDao->emailExists($email);
    if(!$cadastrado){
        if($senha === $confirmSenha){
            $UserDao->addUsuario($nome, $email, $senha);
            $_SESSION['flash'] = "Usuário cadastrado com sucesso !";
            header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/cadastrar.php");
        } else {
            $_SESSION['flash'] = "As senhas precisam ser iguais !";
            header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/cadastrar.php");
            exit;
        }
    } else {
        $_SESSION['flash'] = "Este E-mail já foi cadastrado !";
        header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/cadastrar.php");
        exit;
    }
} else {
    $_SESSION['flash'] = "Preencha todos os campos !";
    header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/cadastrar.php");
    exit;
}

?>