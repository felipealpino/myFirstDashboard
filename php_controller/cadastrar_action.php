<?php
require '../connections/configMySQL.php';
require '../php_controller/UserDaoMysql.php';
session_start();
$UserDao = new UserDaoMysql($pdo);

$nome = filter_input(INPUT_POST, 'formCadastrarNome');
$email = filter_input(INPUT_POST, 'formCadastrarEmail', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'formCadastrarSenha');
$confirmSenha = filter_input(INPUT_POST, 'formCadastrarConfirmarSenha');
$permissao = filter_input(INPUT_POST, 'formCadastrarOption');


$nome = trim($nome);
$email = trim($email);
$senha = trim($senha);
$confirmSenha = trim($confirmSenha);
$permissao = trim($permissao);


if($nome && $email && $senha && $confirmSenha && $permissao){
    $cadastrado = $UserDao->emailExists($email);
    $idPermissao = $UserDao->findPermissaoIdByName($permissao);

    if(!$idPermissao){
        $_SESSION['flash'] = "Grupo permissão nao encontrado !";
        header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/cadastrar.php");
        exit;
    }

    if(!$cadastrado){
        if($senha === $confirmSenha){
            $UserDao->addUsuario($nome, $email, $senha, $idPermissao);
            $_SESSION['flash'] = "Usuário cadastrado com sucesso !";
            header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/cadastrar.php");
            exit;
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