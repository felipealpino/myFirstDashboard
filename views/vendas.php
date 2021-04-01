<?php
require '../connections/configODBC.php';
require '../entities/Vendedor.php';
require '../entities/VendaFactory.php';
require '../entities/VendaVendedor.php';
require '../php_library/biblioteca.php';
require '../php_controller/dataAccessObject.php';

require '../php_controller/UserDaoMysql.php';
session_start();

// 1 admin | 2 gerencia | 6 user_teste
if ($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2 || $_SESSION['permissao'] == 6) {

    $UserDao = new UserDaoMysql($pdo);
    $isLogged = $UserDao->isLogged($_SESSION['email']);
    if (!$isLogged) {
        header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
        exit;
    }

    //3 usuario
    if ($_SESSION['permissao'] == 3) {
        header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/dashboard.php');
        exit;
    }

    $mes = filter_input(INPUT_GET, "mes_vendas_name");
    $ano = filter_input(INPUT_GET, "ano_vendas_name");

    if (!$mes && !$ano) {
        $mes = date('m');
        $ano = date('Y');
    }

    if ($mes && $ano) {
        $dados = vendasAccessData($mes, $ano);
        $totalPorVendedor = new VendaFactory();

        while (odbc_fetch_row($dados)) {
            $codVendedor = odbc_result($dados, "CODVENDEDOR");
            $valorVenda = odbc_result($dados, "VLRRECEBER");
            $dataVenda = odbc_result($dados, "DT_MOVIMENTO");

            $totalPorVendedor->thisExists($codVendedor, $valorVenda);
        }

        $totalVendido = $totalPorVendedor->totalVendasVendedores();
        $listaVendedores = $totalPorVendedor->getListVendedor();
        $mesNome = findNomeMes($mes);
    }
} else {
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}
?>

<title>Vendas</title>
<script src="../node_modules/chart.js/dist/Chart.js"></script>

<?php include 'all.php'; ?>

<div class="right-side-dashboard">
    <div class="top-dashboard-mobile left-icon">
        <div class="top-dashboard">
            <i class="far fa-money-bill-alt"></i>
            <span>Vendas</span>

            <form action="vendas.php" method="GET" class="form-top-dashboard-mes-ano">
                <span>Mês:</span>
                <input type="number" value="<?= $mes; ?>" name="mes_vendas_name" min="1" max="12" id="mes_producao_id" required>
                <span class="ano_form_span">Ano:</span>
                <input type="number" value="<?= $ano; ?>" name="ano_vendas_name" min="2017" max="<?= (date('Y')); ?>" id="ano_producao_id" required>
                <input type="submit" value="Modificar" class="submit_form_input">
            </form>

        </div>

        <div class="open-close-mobile">
            <div class="open-close-mobile-icon">
                <i class="fas fa-align-justify"></i>
            </div>
        </div>
    </div>

    <div class="content-dashboard vendas">
        
        <div class="total-vendido-mes">
            <?php echo "Total faturado no mês: R$ " . (($_SESSION['permissao'] == 6) ? "10.000" : formatNumberToReal($totalVendido)) ?>
        </div>

        <!-- <div id="dashboard-grafico-vendas" class="dashboard-grafico-vendas"></div> -->
        <canvas id="dashboard-grafico-vendas" class="dashboard-grafico-vendas"></canvas>
        <!-- CANVAS CHART JS  -->
        <script>
        var ctx = document.getElementById('dashboard-grafico-vendas');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    <?php for($i = 0; $i < count($totalPorVendedor->getListVendedor()); $i++):?>
                    '<?= $listaVendedores[$i]->getNomeVendedor().
                    ' | R$'.
                    formatNumberToReal($listaVendedores[$i]->getSubTotal()).
                    ' | '.
                    formatNumberToReal(($listaVendedores[$i]->getSubTotal() * 100)/$totalVendido).'%'
                    ?>',
                    <?php endfor ?>
                ],
                datasets: [{
                    label: '<?=$mesNome?> / <?=$ano?>',
                    data: [
                        <?php for($i = 0; $i < count($totalPorVendedor->getListVendedor()); $i++):?>
                        <?= $listaVendedores[$i]->getSubTotal()?>,
                        <?php endfor ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(33, 33, 41, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(33, 33, 41, 1)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    labels: {
                        defaultFontFamily: 'IBM Plex Mono',
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>

    </div>

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