<?php
require '../connections/configODBC.php';
require '../entities/Vendedor.php';
require '../entities/VendaFactory.php';
require '../entities/VendaVendedor.php';
require '../php_library/biblioteca.php';
require '../php_controller/dataAccessObject.php';

require '../php_controller/UserDaoMysql.php';
session_start();
if ($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2) {

    $UserDao = new UserDaoMysql($pdo);
    $isLogged = $UserDao->isLogged($_SESSION['email']);
    if (!$isLogged) {
        header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
        exit;
    }

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
    }
} else {
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}
?>

<title>Vendas</title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Vendedor', 'Quantidade vendida'],
            <?php for ($i = 0; $i < count($totalPorVendedor->getListVendedor()); $i++) : ?>['<?= $listaVendedores[$i]->getNomeVendedor() . ' R$ ' . formatNumberToReal($listaVendedores[$i]->getSubTotal()) ?>', <?= $listaVendedores[$i]->getSubTotal() ?>],
            <?php endfor ?>
        ]);

        var options = {
            <?php $mesNome = findNomeMes($mes); ?>
            title: 'Vendas por mês- <?= $mesNome.'/'.$ano?>',
            fontName: 'IBM Plex Mono',
        };
            

        var chart = new google.visualization.PieChart(document.getElementById('dashboard-grafico-vendas'));

        chart.draw(data, options);
    }
</script>
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
        <div id="dashboard-grafico-vendas" class="dashboard-grafico-vendas"></div>
        <div class="total-vendido-mes">
            <?php echo "Total vendido no mês: R$ " . formatNumberToReal($totalVendido) ?>
        </div>
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