<?php
require '../php_library/biblioteca.php';
require '../php_controller/UserDaoMysql.php';

session_start();

$UserDao = new UserDaoMysql($pdo);
$isLogged = $UserDao->isLogged($_SESSION['email']);
if (!$isLogged) {
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}
?>

<title>Estoque</title>
<?php include 'all.php'; ?>


<div class="right-side-dashboard">
    <div class="top-dashboard-mobile left-icon">
        <div class="top-dashboard">
            <i class="fas fa-boxes"></i>
            <span>Estoque</span>
        </div>
        <div class="open-close-mobile">
            <div class="open-close-mobile-icon">
                <i class="fas fa-align-justify"></i>
            </div>
        </div>
    </div>

    <span>Em desenvolvimento.... </span>

</div>
</div>

<script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
<script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
<script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
<script src="../js/all.js"></script>
<script type="module" src="../js/script.js"></script>
<script src="../js/googleCharts.js"></script>
</body>

</html>