<?php 
session_start();
require '../php_controller/UserDaoMysql.php';
$UserDao = new UserDaoMysql($pdo);

$UserDao->logOut();

header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php");

?>