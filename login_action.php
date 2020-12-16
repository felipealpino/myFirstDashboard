<?php 
$email = filter_input(INPUT_POST,'formIndexEmail',FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST,'formIndexSenha');


if ($email && $senha){
    header("Location:dashboard.php");
} else {
    header("Location:index.php");
    $errorLogin = 'Login ou senha incorretos';
}

?>