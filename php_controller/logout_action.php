<?php 
session_start();
// $_SESSION['flash'] = '';
// $_SESSION['user'] = '';
// $_SESSION['email'] = '';
// $_SESSION['token'] = '';
session_destroy();

header("Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php");

?>