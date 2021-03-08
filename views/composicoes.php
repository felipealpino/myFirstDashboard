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

<title>Composições</title>
</head>

<body>

    <?php include 'all.php'; ?>

    <div class="right-side-dashboard">
        <div class="top-dashboard-mobile left-icon">
            <div class="top-dashboard">
                <i class="fas fa-shopping-cart"></i>
                <span>Composições</span>
            </div>
            <div class="open-close-mobile">
                <div class="open-close-mobile-icon">
                    <i class="fas fa-align-justify"></i>
                </div>
            </div>
        </div>


        <div class="container-main">
            <div class="header-produtos">
                <div class="header-pagina-produtos">
                    <h2 class="header_texto">Relatório de composições</h2>
                </div>
                <div class="form-busca-produtos-estoque">
                    <input id="myInput" class="form-control input-busca" autocomplete="off" type="text" placeholder="Buscar ficha técnica.." autofocus>
                    <button id="buscar-produto" class="btn btn-submit-forms">Buscar</button>
                </div>
            </div>

            <div class="tabela-produtos" id="dados-tabela-produtos">
                <span class="span-produto-estoque-sem-produto"> Utilize o filtro para localizar uma composição...</span>
                <script>
                    document.getElementById('buscar-produto').addEventListener('click', function() {
                        buscar($("#myInput").val())
                    }, false);

                    function buscar(myInput) {
                        //metodo ajax responsavel pela req
                        $.ajax({
                            //Configurações
                            type: 'POST', //metodo que está sendo utilizado
                            dataType: 'html', //tipo de dado que a página vai retornar
                            url: '../php_controller/busca_composicoes.php', //pagina que está sendo solicitada
                            beforeSend: function() {
                                $("#dados-tabela-produtos").html("Carregando....");
                            },
                            data: {
                                myInput: myInput
                            }, //Dados para consulta

                            //funcao que sera executada quando a solicitação for finalizada.
                            success: function(msg) {
                                $("#dados-tabela-produtos").html(msg);
                            },
                            complete: function() {
                                ascendingAndDescending();
                            }
                        });
                    }

                    // $("#buscar-produto").click(function () {
                    //     buscar($("#myInput").val())
                    // });
                </script>
            </div>
        </div>

    </div>

    <script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="../js/all.js"></script>
    <script src="../js/googleCharts.js"></script>
</body>

</html>