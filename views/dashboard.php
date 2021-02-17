<?php 
require '../php_controller/dataAccessObject.php';
require '../entities/ProdutoFactory.php';
require '../entities/Vendedor.php';
require '../entities/VendaFactory.php';
require '../entities/VendaVendedor.php';
require '../connections/configODBC.php';
require '../php_controller/UserDaoMysql.php';
session_start();

$UserDao = new UserDaoMysql($pdo);
$isLogged = $UserDao->isLogged($_SESSION['email']);
if(!$isLogged){
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}


/**
 * TOTAL QUE DEVE PARA CLIENTE
 */
$produtoFactory = new ProdutoFactory;
$x=0;
$dados = relDashValorDevendoCliente();
while(odbc_fetch_row($dados)){
    $codProduto = odbc_result($dados,"CODPROD");
    $refProduto = odbc_result($dados,"REFERENCIA");
    $descProduto = odbc_result($dados,"DESCRICAO");
    $custoProduto = odbc_result($dados,"PRECO_CUSTO");
    $qtVendidaProduto = odbc_result($dados, "QUANTIDADE");

    $produtoFactory->thisExist($codProduto, $refProduto, $descProduto, $custoProduto, $qtVendidaProduto);
}


/**
 * RELATÓRIO DE VENDA NOS ULTIMOS 4 ANOS NO MES ATUAL
 */
$mes = date('m');
$ano = date('Y');
$dados = relDashVendasPassadas($mes, $ano);
$vendasPorAno = new VendaFactory();
while (odbc_fetch_row($dados)){
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
while(odbc_fetch_row($dados)){
    $estoque = odbc_result($dados, "ESTOQUE");
    $custo = odbc_result($dados,"PRECO_CUSTO");
    $codFamilia = odbc_result($dados, "CODFAMILIA");

    $totalFamilias->valorTotalPorFamilia($custo, $estoque, $codFamilia);
}
$list = $totalFamilias->getListaProd();

?>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <?php include 'all.php';?>

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


     <?php if ($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2):?>

        <div class="content-dashboard">
            <div class="content-dashboard-grid">
                <!-- DEVENDO P/ CLIENTE -->
                <div class="dashboard_rel_carga"> <?php echo "Valor total não entregue: R$".$produtoFactory->valorTotal() ?> </div>

                <!-- VENDAS MES/ANOS  -->
                <div class="dashboard_rel_vendas">
                    <span>
                        Vendas mês: 
                        <?php echo findNomeMes($mes)?> 
                    </span> <br> 
                    <?php for ($i=0; $i < count($arrVendaPorAno); $i++): ?>
                        <span>
                            Ano: 
                            <?php 
                                echo $arrVendaPorAno[$i]->getDataVenda()." - R$ ";
                                echo formatNumberToReal($arrVendaPorAno[$i]->getSubTotal()) 
                            ?>         
                        </span> <br>
                    <?php endfor; ?>
                </div>

                <!-- RELACAO VALOR - FAMILIA ESTOQUE -->
                <div class="dashboard_rel_estoque">
                    <?php for ($i=0; $i <count($totalFamilias->getListaProd()) ; $i++): ?>
                        <span>
                            Familia: 
                                <?php 
                                    echo findNomeFamilia($list[$i]->getCodFamilia())
                                    ." - ";
                                    echo "R$ ".formatNumberToReal($list[$i]->getValorEmEstoque());  
                                ?> 
                        </span> <br>
                    <?php endfor ?>
                </div>


                <!-- RELAÇÃO PRODUCAO MES/ANOS -->
                <div class="dashboard_rel_producao">producao</div>
            </div>
        </div>
     <?php else:
        echo "Em desenvolvimento.... ";   
        endif
     ?>

    </div>
    
    <script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="../js/all.js"></script>
    <script src="../js/googleCharts.js"></script>
</body>
</html>