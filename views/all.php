<title>Dashboard</title>
    <style>
        .popup-usuarios {
            width: 850px; 
            height: 400px; 
            border: 1px solid black;
            border-radius: 5px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            overflow-y: auto;
            background-color: #BFE4F3;
            transition: all 0.6s;
            opacity: 1;
            visibility: visible;
        }  
        .closepopup-usuarios{
            opacity: 0;
            visibility: hidden;
        }
    </style>

</head>
<body>
    <div class="dashboard-content">
        <?php 
            $UserDao = new UserDaoMysql($pdo);
            $dados = $UserDao->getAllUsers();
        ?>
        <div class="popup-usuarios closepopup-usuarios"> 
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
                    <?php foreach($dados as $dado): ?>
                    <tr>
                        <td> <?php echo $dado['id']; ?> </td>
                        <td> <?php echo $dado['nome']; ?> </td>
                        <td> <?php echo $dado['email']; ?></td>
                        <td> 
                        <?php
                            $time = explode(' ',$dado['ultimo_login']);
                            $dataBR = formatEuaDataToBrasilData($dado['ultimo_login']);
                            echo $dataBR.' '.$time[1];
                        ?> 
                        </td>
                        <td>  
                            <a href="../php_controller/editar_action.php/<?=$dado['id'] ?>">[Editar]</a>
                            <a href="../php_controller/excluir_action.php/<?=$dado['id'] ?>">[Excluir]</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

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

                        <?php if($_SESSION['permissao'] != 4):?><!-- 4=vendas -->
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

                        <?php if($_SESSION['permissao'] != 4):?><!-- 4=vendas -->
                        <li>
                            <i class="fas fa-clipboard-check"></i>
                            <a href="kardex.php">Kardex</a>
                        </li>
                        <?php endif ?>

                        <?php if($_SESSION['permissao'] != 4):?><!-- 4=vendas -->
                        <li>
                            <i class="fas fa-boxes"></i>
                            <a href="estoque.php">estoque</a>
                        </li>
                        <?php endif ?>

                        <?php if($_SESSION['permissao'] != 4):?><!-- 4 = vendas -->
                        <li>
                            <i class="fas fa-hammer"></i>
                            <a href="producao.php">produção</a>
                        </li>
                        <?php endif ?>

                        <?php if($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2):?><!-- 1=admin & 2=gerencia -->
                        <li>
                            <i class="far fa-money-bill-alt"></i>
                            <a href="vendas.php">vendas</a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if($_SESSION['permissao'] != 4):?><!-- 4=vendas -->
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

                            ?>
                        </li>

                        <?php if (strtoupper($_SESSION['permissao']) == 1): ?><!-- 1=admin -->
                        <li>
                            <a href="cadastrar.php">Cadastrar usuário</a>
                        </li>

                        <li>
                            <a href="" id="listar_usuarios_link" onclick="checkDisplayUsuarioList(event)">
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

        

        