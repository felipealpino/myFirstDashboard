<?php
require '../php_controller/UserDaoMysql.php';
require '../php_library/biblioteca.php';

session_start();

$UserDao = new UserDaoMysql($pdo);
$isLogged = $UserDao->isLogged($_SESSION['email']);
if (!$isLogged) {
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}
?>

<title>Perfil</title>
<?php include 'all.php'; ?>

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
                <form action="../php_controller/perfil_action.php" method="POST">
                    <?php
                    if (isset($_SESSION['flash']) && $_SESSION['flash'] != '') {
                        echo '<div class="flash-warning">';
                        print_r($_SESSION['flash']);
                        $_SESSION['flash'] = '';
                        echo '</div>';
                    }
                    ?>

                    <div class="form-group">
                        <label for="email-input-index">Nome</label>
                        <input type="text" name="formPerfilNome" class="form-control" id="nome-form-perfil" placeholder="Edite seu nome" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="senha-input-perfil">Nova senha</label>
                        <input type="password" name="formPerfilSenha" class="form-control" id="senha-form-perfil" placeholder="Digite uma nova senha">
                    </div>
                    <div class="form-group">
                        <label for="nova-senha-input-perfil">Repita a nova senha</label>
                        <input type="password" name="formPerfilNovaSenha" class="form-control" id="nova-senha-form-index" placeholder="Repita a nova senha">
                    </div>
                    <button type="submit" class="btn btn-submit-forms btn-submit-cadastrar">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
<script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
<script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
<script src="../js/all.js"></script>
<script type="module" src="../js/script.js"></script>
</body>

</html>