<?php

require 'configODBC.php';
require 'entities/Vendedor.php';
require 'entities/VendaDataValor.php';
require 'php_library/biblioteca.php';

$mes = filter_input(INPUT_GET,"mes_vendas_name");
$ano = filter_input(INPUT_GET,"ano_vendas_name");

if(!$mes && !$ano){
    $mes = date('m');
    $ano = date('Y');
}

if($mes && $ano){
    $sqlENCEFAT = 'SELECT CODVENDEDOR, VLRRECEBER, DT_MOVIMENTO FROM ENCEFAT '; 
    $dados = odbc_exec($conn, $sqlENCEFAT) or die('Erro no sql');
    $myArray = [];

    while(odbc_fetch_row($dados)){
        $arrayData = explode("-",odbc_result($dados,"DT_MOVIMENTO"));  
        if ($arrayData[1] == $mes && $arrayData[0] == $ano){
            $vendedor = new Vendedor(
                odbc_result($dados, "CODVENDEDOR"),
                [odbc_result($dados,"DT_MOVIMENTO"),odbc_result($dados, "VLRRECEBER")],
            );
            array_push($myArray, $vendedor);
        }
    }

    // var_dump($myArray);

    $somaVendas = [0,0,0,0,0,0]; //começa aqui o erro da OO    

    foreach ($myArray as $value){
        // var_dump($value->getVendaDataAndValor()->getValor_venda())."<br>";
        switch($value->getCodVendedor()){
            case '0002':
                $somaVendas[0] += $value->getVendaDataAndValor()->getValor_venda();   
                break;
            case '0012':
                $somaVendas[1] += $value->getVendaDataAndValor()->getValor_venda();
                break;
            case '0057':
                $somaVendas[2] += $value->getVendaDataAndValor()->getValor_venda();
                break;
            case '0056':
                $somaVendas[3] += $value->getVendaDataAndValor()->getValor_venda();
                break;
            case '0047':
                $somaVendas[4] += $value->getVendaDataAndValor()->getValor_venda();
                break;
            case '0058':
                $somaVendas[5] += $value->getVendaDataAndValor()->getValor_venda();
                break;
        }
    }

    $totalVendidoMes = 0;
    foreach($somaVendas as $item){
        $totalVendidoMes += $item;
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/package/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            
            var data = google.visualization.arrayToDataTable([
            ['Vendedor', 'Quantidade vendida'],
            ['Camila <?='R$ '.formatNumberToReal($somaVendas[3]);?>',<?=$somaVendas[3]?>],
            ['Daniele <?='R$ '.formatNumberToReal($somaVendas[5]);?>',<?=$somaVendas[5]?>],
            ['Eduardo <?='R$ '.formatNumberToReal($somaVendas[4]);?>',<?=$somaVendas[4]?>],
            ['Janaina <?='R$ '.formatNumberToReal($somaVendas[0]);?>',<?=$somaVendas[0]?>],
            ['Lilas <?='R$ '.formatNumberToReal($somaVendas[2]);?>', <?=$somaVendas[2]?>],
            ['Rosangela <?='R$ '.formatNumberToReal($somaVendas[1]);?>',<?=$somaVendas[1]?>]
            ]);

            <?php
                $mesNome = findNomeMes($mes);
            ?>

            var options = {
            title: 'Vendas por mês - <?=$mesNome?>'
            };

            var chart = new google.visualization.PieChart(document.getElementById('dashboard-grafico-vendas'));

            chart.draw(data, options);
        }
    </script>


        <?php include 'all.php';?>

        <div class="right-side-dashboard">    
            <div class="top-dashboard-mobile left-icon">
                <div class="top-dashboard">
                    <i class="far fa-money-bill-alt"></i>
                    <span>Vendas</span>

                    <form action="vendas.php" method="GET" class="form-top-dashboard-mes-ano">
                        <span>Mês:</span>
                        <input type="number" value="<?=date("m");?>" name="mes_vendas_name" min="1" max="12" id="mes_producao_id" required>
                        <span class="ano_form_span">Ano:</span>
                        <input type="number" value="<?=date("Y");?>" name="ano_vendas_name" min="2017" max="<?=(date('Y')+1);?>" id="ano_producao_id" required>
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
                <div>
                    <?php
                        echo "Total vendido no mês: R$ ".formatNumberToReal($totalVendidoMes)
                    ?>
                </div>
            </div>
            

        </div>
    </div>

    <script src="plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="plugins/jquery-validation-1.19.2/dist/localization/messages_pt_BR.min.js"></script>
    <script src="plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="plugins/package/dist/sweetalert2.all.min.js"></script>
    <script src="plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    <script src="js/all.js"></script>
    <script src="js/googleCharts.js"></script>
</body>
</html>