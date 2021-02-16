<?php
require '../connections/configMySQL.php';
require '../php_controller/UserDaoMysql.php';
session_start();
$UserDao = new UserDaoMysql($pdo);

$nome = filter_input(INPUT_POST, 'formPerfilNome');
$senha = filter_input(INPUT_POST, 'formPerfilSenha');
$senhaConfirma = filter_input(INPUT_POST, 'formPerfilNovaSenha');

if($nome == ''){
    $nome = $_SESSION['nome'];
}
if($senha == '' || $senhaConfirma == '') {
    $senha = $_SESSION['senha'];
    $senhaConfirma = $_SESSION['senha'];
}

if ($nome && $senha && $senhaConfirma){
    if($senha === $senhaConfirma){
        $UserDao->updateUsuario($nome, $senha, $_SESSION['id']);
        $_SESSION['flash'] = "Usuário alterado com sucesso !";
        header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/perfil.php");
        exit;
    }
} else {
    $_SESSION['flash'] = "Algo deu errado no update, tente novamente !";
    header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/perfil.php");
    exit;
}


?>