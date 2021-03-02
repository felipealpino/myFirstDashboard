<title>Dashboard</title>
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

                        <?php if($_SESSION['permissao'] != 4):?>
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

                        <?php if($_SESSION['permissao'] != 4):?>
                        <li>
                            <i class="fas fa-clipboard-check"></i>
                            <a href="kardex.php">Kardex</a>
                        </li>
                        <?php endif ?>

                        <?php if($_SESSION['permissao'] != 4):?>
                        <li>
                            <i class="fas fa-boxes"></i>
                            <a href="estoque.php">estoque</a>
                        </li>
                        <?php endif ?>
                        

                        <?php if($_SESSION['permissao'] != 4):?>
                        <li>
                            <i class="fas fa-hammer"></i>
                            <a href="producao.php">produção</a>
                        </li>
                        <?php endif ?>

                        <?php if($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2):?>
                        <li>
                            <i class="far fa-money-bill-alt"></i>
                            <a href="vendas.php">vendas</a>
                        </li>
                        <?php endif; ?>

                        <?php if($_SESSION['permissao'] != 4):?>
                        <li>
                            <i class="fas fa-shopping-cart"></i>
                            <a href="compras.php">compras</a>
                        </li>   
                        <?php endif; ?>

                        <li>
                            <i class="fas fa-sign-out-alt"></i>
                            <a href="../php_controller/logout_action.php">Logout</a>    
                        </li>
                        <li>
                            <?php
                                echo "Usuário: <br>";
                                echo $_SESSION['nome']."<br>";
                                // $ip = file_get_contents('https://api.ipify.org');
                                // echo "public IP address : " . $ip;
                            ?>
                        </li>
                        <?php if (strtoupper($_SESSION['permissao']) == 1): ?>
                        <li>
                                <a href="cadastrar.php">Cadastrar usuário</a>
                        </li>
                        <?php endif ?>

                        <!--                         
                        <li>
                            <?php
                                echo $_SERVER['REMOTE_ADDR'];
                            ?>
                        </li> -->
                        
                        

                        
                    </ul>
                </div>
            </div>
        </div>

        