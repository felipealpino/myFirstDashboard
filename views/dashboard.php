<?php
// require '../php_controller/dataAccessObject.php';
require '../php_controller/UserDaoMysql.php';
require '../entities/ProdutoFactory.php';
require '../entities/Vendedor.php';
require '../entities/VendaFactory.php';
require '../entities/VendaVendedor.php';
require '../connections/configODBC.php';
require '../php_controller/ProducaoDaoODBC.php';
session_start();

$mes = date('m');
$ano = date('Y');

$UserDao = new UserDaoMysql($pdo);
$isLogged = $UserDao->isLogged($_SESSION['email']);
if (!$isLogged) {
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}

/**
 * TOTAL QUE DEVE PARA CLIENTE
 */
$produtoFactory = new ProdutoFactory;
$x = 0;
$dados = relDashValorDevendoCliente();
while (odbc_fetch_row($dados)) {
    $codProduto = odbc_result($dados, "CODPROD");
    $refProduto = odbc_result($dados, "REFERENCIA");
    $descProduto = odbc_result($dados, "DESCRICAO");
    $custoProduto = odbc_result($dados, "PRECO_CUSTO");
    $qtVendidaProduto = odbc_result($dados, "QUANTIDADE");

    $produtoFactory->thisExist($codProduto, $refProduto, $descProduto, $custoProduto, $qtVendidaProduto);
}


/**
 * RELATÓRIO DE VENDA NOS ULTIMOS 4 ANOS NO MES ATUAL
 */

$dados = relDashVendasPassadas($mes, $ano);
$vendasPorAno = new VendaFactory();
while (odbc_fetch_row($dados)) {
    $dataVenda = odbc_result($dados, "DT_MOVIMENTO");
    $valorVenda = odbc_result($dados, "VLRRECEBER");
    $arrayData = explode('-', $dataVenda);

    $vendasPorAno->vendasPorAno($arrayData[0], $valorVenda);
}
$arrVendaPorAno = $vendasPorAno->getListVendedor();


/**
 * RELATÓRIO ESTOQUE / FAMILIA 
 */
$dados = relDashFamiliaProdutos();
$totalFamilias = new ProdutoFactory();
while (odbc_fetch_row($dados)) {
    $estoque = odbc_result($dados, "ESTOQUE");
    $custo = odbc_result($dados, "PRECO_CUSTO");
    $codFamilia = odbc_result($dados, "CODFAMILIA");

    $totalFamilias->valorTotalPorFamilia($custo, $estoque, $codFamilia);
}
$list = $totalFamilias->getListaProd();


/**
 * RELATÓRIO PRODUÇÃO ULTIMOS 4 ANOS
 */
$producaoData = new ProducaoDaoODBC();
$arrayPesosMeses = $producaoData->getPesoPorDiaUltimosAnos($mes, $ano);

?>

<title>Dashboard</title>
<?php include 'all.php'; ?>

<div class="right-side-dashboard">
    <div class="top-dashboard-mobile left-icon">
        <div class="top-dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </div>
        <div class="open-close-mobile">
            <div class="open-close-mobile-icon">
                <i class="fas fa-align-justify"></i>
            </div>
        </div>
    </div>


    <?php if ($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2) : ?>

        <div class="content-dashboard">
            <div class="content-dashboard-grid">
                <!-- DEVENDO P/ CLIENTE -->
                <div class="dashboard_rel_carga"> <?php echo "Valor total não entregue: R$" . $produtoFactory->valorTotal() ?> </div>

                <!-- VENDAS MES/ANOS  -->
                <div class="dashboard_rel_vendas">
                    <span>
                        Vendas mês:
                        <?php echo findNomeMes($mes) ?>
                    </span> <br>
                    <?php for ($i = 0; $i < count($arrVendaPorAno); $i++) : ?>
                        <span>
                            Ano:
                            <?php
                            echo $arrVendaPorAno[$i]->getDataVenda() . " - R$ ";
                            echo formatNumberToReal($arrVendaPorAno[$i]->getSubTotal())
                            ?>
                        </span> <br>
                    <?php endfor; ?>
                </div>

                <!-- RELACAO VALOR - FAMILIA ESTOQUE -->
                <div class="dashboard_rel_estoque">
                    <div class="limit-relatorio">
                        <?php for ($i = 0; $i < count($totalFamilias->getListaProd()); $i++) : ?>

                                <?php
                                if(findNomeFamilia($list[$i]->getCodFamilia()) != 'ALUGUEL'
                                    && findNomeFamilia($list[$i]->getCodFamilia()) != 'ESCRITORIO'
                                    && findNomeFamilia($list[$i]->getCodFamilia()) != 'VEICULOS'
                                    && findNomeFamilia($list[$i]->getCodFamilia()) != 'FERRAMENTAS'
                                    && findNomeFamilia($list[$i]->getCodFamilia()) != 'SERVICOS'
                                    && findNomeFamilia($list[$i]->getCodFamilia()) != 'OUTROS'
                                    && findNomeFamilia($list[$i]->getCodFamilia()) != 'ADICIONAR FAMILIA'): ?>

                                <span>
                                Familia:
                                <?php
                                    echo findNomeFamilia($list[$i]->getCodFamilia())
                                    . " - ";
                                    echo "R$ " . formatNumberToReal($list[$i]->getValorEmEstoque());
                                ?>
                                </span> <br>
                                <?php endif ?>
                        <?php endfor ?>
                    </div>
                </div>


                <!-- RELAÇÃO PRODUCAO MES/ANOS -->
                <div class="dashboard_rel_producao">
                    <div class="limit-relatorio">
                        <?php
                        $a = 3;
                        for($i=0; $i<count($arrayPesosMeses); $i++): ?>
                            <span>Ano: <?= date('Y') - $a ?> - Peso <?= $arrayPesosMeses[$i]?> kg</span><br>
                        <?php
                        $a--;
                        endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else :
        echo "Em desenvolvimento.... ";
    endif
    ?>

</div>

<script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
<script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
<script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
<script src="../js/all.js"></script>
<script type="module" src="../js/script.js"></script>
<script src="../js/googleCharts.js"></script>
</body>

</html>