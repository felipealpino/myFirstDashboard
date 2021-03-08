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
<title>Carga</title>
</head>
<body>

    <?php include 'all.php'; ?>

    <div class="right-side-dashboard">
        <div class="top-dashboard-mobile left-icon">
            <div class="top-dashboard">
                <i class="fas fa-truck"></i>
                <span>Carga</span>
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
                    <h2 class="header_texto">Relatório de carga</h2>
                </div>

                <div class="inputs-select-filter-carga">
                    <div class="select-filter-carga">
                        <div class="select-filter-carga--data">
                            <div><span>Data inicial:</span></div>
                            <input type="date" name="" id="">
                        </div>

                        <div class="select-filter-carga--data">
                            <div><span>Data final:</span></div>
                            <input type="date" name="" id="">
                        </div>

                        <div class="select-filter-carga--option">
                            <div><label for="filterCarga" id="filterCargaId">Escolha o filtro</label></div>
                            <div><select name="filtragem-carga" id="filterCargaSelect">
                                    <option value="CLIENTE">Cliente ou CodCliente</option>
                                    <option value="CODPEDIDO">Código do pedido</option>
                                    <option value="STATUS">Situação</option>
                                    <option value="REFERENCIA">Referencia</option>
                                    <option value="DESCRICAO">Descrição</option>
                                </select></div>
                        </div>
                    </div>

                    <div class="form-busca-produtos-estoque">
                        <input id="myInput" class="form-control input-busca" autocomplete="off" type="text" placeholder="Buscar .." autofocus>
                        <button id="buscar-produto" class="btn btn-submit-forms">Buscar</button>
                    </div>
                </div>
            </div>

            <div class="tabela-produtos" id="dados-tabela-produtos">
                <span class="span-produto-estoque-sem-produto"> Utilize o filtro para localizar o desejado...</span>
                <script>
                    document.getElementById('buscar-produto').addEventListener('click', function() {
                        const selectedValue = document.querySelector('select').value
                        const settedDates = document.querySelectorAll('.select-filter-carga--data input');
                        buscar($("#myInput").val(), selectedValue, settedDates[0].value, settedDates[1].value)
                    }, false);

                    function buscar(myInput, selectionValue, dataInicial, dataFinal) {
                        $.ajax({
                            //Configurações
                            type: 'POST', //metodo que está sendo utilizado
                            dataType: 'html', //tipo de dado que a página vai retornar
                            url: '../php_controller/busca_carga.php', //pagina que está sendo solicitada
                            beforeSend: function() {
                                $("#dados-tabela-produtos").html("Carregando....");
                            },
                            data: {
                                myInput: myInput,
                                selectionValue: selectionValue,
                                dataInicial: dataInicial,
                                dataFinal: dataFinal,
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
    <script src="../js/carga.js"></script>
    <script src="../js/googleCharts.js"></script>
</body>

</html>