<?php
require '../connections/configODBC.php';
require '../php_library/biblioteca.php';
// require '../php_controller/dataAccessObject.php';
require '../php_controller/UserDaoMysql.php';
require '../php_controller/ProducaoDaoODBC.php';

session_start();
if ($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2 || $_SESSION['permissao'] == 3 || $_SESSION['permissao'] == 6) {
    $UserDao = new UserDaoMysql($pdo);
    $isLogged = $UserDao->isLogged($_SESSION['email']);
    if (!$isLogged) {
        header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
        exit;
    }

    $mes = filter_input(INPUT_GET, 'mes_producao_name');
    $ano = filter_input(INPUT_GET, 'ano_producao_name');

    // Adicionando valores a $mes e $ano caso não setados
    if (!$mes && !$ano) {
        $mes = date('m');
        $ano = date('Y');
    }

    $producaoData = new ProducaoDaoODBC();
    $pesoDia = $producaoData->getPesoPorDia($mes, $ano);
    $diasProduzido = $producaoData->getDiasProduzidos($pesoDia);
    $mediaMes = $producaoData->getMediaKgProdPorDia($pesoDia, $diasProduzido);
} else {
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}

?>

<title>Produção</title>
     <?php $nomeMes = findNomeMes($mes); ?> <!-- php_library/biblioteca.php -->
 

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"> </script> -->
<script src="../node_modules/chart.js/dist/Chart.js"></script>

<?php include 'all.php'; ?>

<div class="right-side-dashboard">
    <div class="top-dashboard-mobile left-icon">
        <div class="top-dashboard">
            <i class="fas fa-hammer"></i>
            <span>Produção</span>

            <form action="producao.php" method="GET" class="form-top-dashboard-mes-ano">
                <span>Mês:</span>
                <input type="number" value="<?= $mes; ?>" name="mes_producao_name" min="1" max="12" id="mes_producao_id" required>
                <span class="ano_form_span">Ano:</span>
                <input type="number" value="<?= $ano; ?>" name="ano_producao_name" min="2017" max="<?= (date('Y')); ?>" id="ano_producao_id" required>
                <input type="submit" value="Modificar" class="submit_form_input">
            </form>

        </div>

        <div class="open-close-mobile">
            <div class="open-close-mobile-icon">
                <i class="fas fa-align-justify"></i>
            </div>
        </div>
    </div>

    <div class="content-dashboard producao">

        <canvas id="dashboard-grafico-producao" class="dashboard-grafico-producao"></canvas>
        <!-- CANVAS CHART JS  -->
        <script>
            var ctx = document.querySelector('#dashboard-grafico-producao').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {

                    labels: [
                        <?php for($x=1; $x<=31; $x++):?>
                        '<?=$x?>',
                        <?php endfor ?>
                    ],
                    datasets: [{
                        label: '<?=$nomeMes?> / <?=$ano?>',
                        data: [
                            <?php for($x=1; $x<=31; $x++):?>
                                <?=$pesoDia[$x - 1]; ?>,
                            <?php endfor ?>
                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    animation: {
                        duration:1000,
                        easing:'linear'
                    },
                    defaultFontFamily:'IBM Plex Mono',
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

        <div class="producao-table-values">
            <div class="dados_finais_producao_mes">
                <div><?= 'Total produzido no mês: ' . formatNumberToReal(array_sum($pesoDia)) . ' kg' ?></div>
                <div><?= 'Total dias trabalhados no mês: ' . $diasProduzido . ' dias' ?></div>
                <div><?= 'Média produzida por dia: ' . formatNumberToReal($mediaMes) . ' kg' ?></div>
            </div>
            <table class="table sortable table-sm table-bordered table-hover tabela-produtos tabela-producao-detalhada">
                <thead class="thead_produtos">
                    <tr>
                        <th style="text-align: center;">Dia</th>
                        <th style="text-align: center;">Quant.</th>

                    </tr>
                </thead>

                <?php //Fazendo consulta SQL novamente (não estava funcionando com a do inicio da página) 
                $dados = producaoAccessData($mes, $ano);
                while (odbc_fetch_row($dados)) :
                    $dataFormated = formatEuaDataToBrasilData(odbc_result($dados, "DT_MOVIMENTO"));
                    $arrayData = explode("-", odbc_result($dados, "DT_MOVIMENTO"));
                    if ($arrayData[1] == $mes && $arrayData[0] == $ano && odbc_result($dados, "TIPOMOV") == "11" && (odbc_result($dados, "CODPROD") == "000880" || odbc_result($dados, "CODPROD") == "000383")) :
                ?>

                        <tbody>
                            <tr>
                                <td style="text-align: center;"> <?= $dataFormated ?></td>
                                <td style="text-align: center;"> <?= odbc_result($dados, "QUANTIDADE") . ' kg' ?> </td>
                            </tr>
                        </tbody>
                    <?php endif ?>
                <?php endwhile; ?>

            </table>
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