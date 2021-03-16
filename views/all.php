<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../images/dash.ico" />
    <link rel="stylesheet" type="text/css" href="../node_modules/chart.js/dist/Chart.min.css">
</head>
<body>
    <div class="dashboard-content">

        <div class="left-side-dashboard">
            <div class="sidebar-dashboard">
                <div class="icone-top-leftside">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </div>
                <div class="list-left-side">
                    <ul>
                        <li>
                            <i class="fas fa-home"></i>
                            <a href="dashboard.php">Dashboard</a>
                        </li>

                        <?php if ($_SESSION['permissao'] != 4) : ?>
                            <!-- 4=vendas -->
                            <li>
                                <i class="fas fa-user-alt"></i>
                                <a href="perfil.php">Perfil</a>
                            </li>
                        <?php endif ?>

                        <li>
                            <i class="fab fa-product-hunt"></i>
                            <a href="produtos_estoque.php">Produtos Estoque</a>
                        </li>

                        <li>
                            <i class="fas fa-layer-group"></i>
                            <a href="composicoes.php">Composições</a>
                        </li>

                        <li>
                            <i class="fas fa-truck"></i>
                            <a href="carga.php">Carga</a>
                        </li>

                        <?php if ($_SESSION['permissao'] != 4) : ?>
                            <!-- 4=vendas -->
                            <li>
                                <i class="fas fa-clipboard-check"></i>
                                <a href="kardex.php">Kardex</a>
                            </li>
                        <?php endif ?>

                        <?php if ($_SESSION['permissao'] != 4) : ?>
                            <!-- 4=vendas -->
                            <li>
                                <i class="fas fa-boxes"></i>
                                <a href="estoque.php">estoque</a>
                            </li>
                        <?php endif ?>

                        <?php if ($_SESSION['permissao'] != 4) : ?>
                            <!-- 4 = vendas -->
                            <li>
                                <i class="fas fa-hammer"></i>
                                <a href="producao.php">produção</a>
                            </li>
                        <?php endif ?>

                        <?php if ($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2) : ?>
                            <!-- 1=admin & 2=gerencia -->
                            <li>
                                <i class="far fa-money-bill-alt"></i>
                                <a href="vendas.php">vendas</a>
                            </li>
                        <?php endif; ?>

                        <?php if ($_SESSION['permissao'] != 4) : ?>
                            <!-- 4=vendas -->
                            <li>
                                <i class="fas fa-shopping-cart"></i>
                                <a href="compras.php">compras</a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <i class="fas fa-sign-out-alt"></i>
                            <a href="" data-modal="modalLogout">Logout</a>
                        </li>

                        <li>
                            <?php
                            echo "Usuário: <br>";
                            echo $_SESSION['nome'] . "<br>";

                            ?>
                        </li>

                        <?php if (strtoupper($_SESSION['permissao']) == 1) : ?>
                            <!-- 1=admin -->
                            <li>
                                <a href="cadastrar.php">Cadastrar usuário</a>
                            </li>

                            <li>
                                <a href="" id="listar_usuarios_link">
                                    Listar usuários
                                </a>
                            </li>
                        <?php endif ?>

                        <!--<li>
                            <?php
                            echo $_SERVER['REMOTE_ADDR'];
                            // $ip = file_get_contents('https://api.ipify.org');
                            // echo "public IP address : " . $ip;
                            ?>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>



        <!-- ULTIMO LOGIN MODAL  -->
        <?php
        $UserDao = new UserDaoMysql($pdo);
        $dados = $UserDao->getAllUsers();
        ?>
        <div class="container-popup-usuarios closepopup-usuarios"">
            <div class="popup-usuarios data-modal="ModalListarUsuarios">
                <button class="logout-fecharListarUsuarios-botao">X</button>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Ultimo login</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $dado) : ?>
                            <tr>
                                <td> <?php echo $dado['id']; ?> </td>
                                <td> <?php echo $dado['nome']; ?> </td>
                                <td> <?php echo $dado['email']; ?></td>
                                <td>
                                    <?php
                                    $time = explode(' ', $dado['ultimo_login']);
                                    $dataBR = formatEuaDataToBrasilData($dado['ultimo_login']);
                                    echo $dataBR . ' ' . $time[1];
                                    ?>
                                </td>
                                <td>
                                    <a href="../php_controller/editar_action.php/<?= $dado['id'] ?>">[Editar]</a>
                                    <a href="../php_controller/excluir_action.php/<?= $dado['id'] ?>">[Excluir]</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>



        <!-- LOGOUT MODAL  -->
        <div class="logout-modal" data-modal="logout">
            <div class="logout-container">
                <button class="logout-fechar-botao" data-modal="modalLogout">X</button>
                <span class="logout-container-span">Deseja realmente sair, <?= $_SESSION['nome'] ?> ?</span>
                <div class="logout-botoes">
                    <a href="../php_controller/logout_action.php" class="logout-link">Fazer logoff</a>
                </div>
            </div>
        </div>