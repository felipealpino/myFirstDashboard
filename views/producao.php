<?php
require '../connections/configODBC.php';
require '../php_library/biblioteca.php';
require '../php_controller/dataAccessObject.php';

$mes = filter_input(INPUT_GET,'mes_producao_name');
$ano = filter_input(INPUT_GET,'ano_producao_name');

// Adicionando valores a $mes e $ano caso não setados
if (!$mes && !$ano){
    $mes = date('m');
    $ano = date('Y');
}

// Manipulando valores $mes e $ano caso passados pelo form
if($mes && $ano) {
    $dados = producaoAccessData($mes, $ano);

    /**
    * Declarando array $pesoDia de [0] até [30]
    */
    $pesoDia = array_fill(0, 31, 0);


    /**
    * TIPOMOV = 11 = ENTRADA ACABADO
    * CODPROD = 000880 = QUILO ISOFTALICO BRANCO
    * CODPROD = 000383 = QUILO ISOFTALICO 
    */
    while(odbc_fetch_row($dados)){
        $arrayData = explode("-",odbc_result($dados,"DT_MOVIMENTO"));  
        if (odbc_result($dados,"TIPOMOV") == "11" 
            && (odbc_result($dados,"CODPROD") == "000880" 
            || odbc_result($dados,"CODPROD") == "000383")) {
            
            $dia = substr(($arrayData[2]),0 , 2);
            $quant = odbc_result($dados, "QUANTIDADE");

            /**
             * Se o dia é 1, soma quantidade no $pesoDia[0]
             * Se o dia é 2, soma quantidade no $pesoDia[1] ...... 
             */
            $pesoDia[$dia - 1] += $quant;
        }
    }
}


/**
 * Descobrindo quantos dias da semana tiveram 0kg produzidos
 * Esse valor armazenado em $z será util para fazer a média do mês
 */
$z= 0;
for($contador=0; $contador<count($pesoDia); $contador++){
    if($pesoDia[$contador] !== 0 ){
        $z += 1; 
    }
}

/**
 * Descobrindo média produzia no mês
 */
$pesoTotal = array_sum($pesoDia);
if($z !== 0){
    $mediaMes = ($pesoTotal/$z);
} else {
    $mediaMes = 0;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/package/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        <?php $nomeMes = findNomeMes($mes); ?> ///php_library/biblioteca.php
      function drawChart() {
        var x = 1;
        var data = google.visualization.arrayToDataTable([
        ['Dia', 'Quant.'],
        <?php for($x=1; $x<=31; $x++): ?>   
            <?php if($x<9):?> 
                ['<?='0'.$x;?>', <?=$pesoDia[$x - 1];?>],
            <?php else: ?>
                ['<?=$x;?>', <?=$pesoDia[$x - 1];?>],
            <?php endif ?> 
        <?php endfor ?>
        ]);

        var options = {
            legend: { position: 'none' },
            chart: {
                title: 'Production Performance',
                subtitle: ' <?=$nomeMes;?> / <?=$ano;?>',
            },
            hAxis:{
                maxValue: 3000,
            },
            bars: 'vertical', // Required for Material Bar Charts.
            annotations: {
            style: 'line',
          }
        };
        var chart = new google.charts.Bar(document.getElementById('dashboard-grafico-producao'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      </script>
</head>
      
    <?php include 'all.php'; ?>  

        <div class="right-side-dashboard">    
            <div class="top-dashboard-mobile left-icon">
                <div class="top-dashboard">
                    <i class="fas fa-hammer"></i>
                    <span>Produção</span>
                        
                    <form action="producao.php" method="GET" class="form-top-dashboard-mes-ano">
                        <span>Mês:</span>
                        <input type="number" value="<?=date("m");?>" name="mes_producao_name" min="1" max="12" id="mes_producao_id" required>
                        <span class="ano_form_span">Ano:</span>
                        <input type="number" value="<?=date("Y");?>" name="ano_producao_name" min="2017" max="<?=(date('Y')+1);?>" id="ano_producao_id" required>
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
                <div id="dashboard-grafico-producao" class="dashboard-grafico-producao" ></div>
                
                <div class="producao-table-values">
                    <div class="dados_finais_producao_mes">
                        <div><?='Total produzido no mês: '.formatNumberToReal($pesoTotal).' kg'?></div>
                        <div><?='Total dias trabalhados no mês: '.$z.' dias'?></div>
                        <div><?='Média produzida por dia: '.formatNumberToReal($mediaMes).' kg' ?></div>
                    </div>
                    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
                        <thead class="thead_produtos">
                            <tr>
                                <th style="text-align: center;">Dia</th>
                                <th style="text-align: center;">Quant.</th>

                            </tr>
                        </thead>
                    
                    <?php //Fazendo consulta SQL novamente (não estava funcionando com a do inicio da página) 
                        $dados = producaoAccessData($mes, $ano);
                        while(odbc_fetch_row($dados)): 
                            $dataFormated = formatEuaDataToBrasilData(odbc_result($dados,"DT_MOVIMENTO"));
                            $arrayData = explode("-",odbc_result($dados,"DT_MOVIMENTO")); 
                            if ($arrayData[1] == $mes && $arrayData[0] == $ano && odbc_result($dados,"TIPOMOV") == "11" && (odbc_result($dados,"CODPROD") == "000880" || odbc_result($dados,"CODPROD") == "000383")):
                    ?>

                        <tbody>
                            <tr>
                                <td style="text-align: center;"> <?= $dataFormated ?></td>
                                <td style="text-align: center;"> <?= odbc_result($dados,"QUANTIDADE").' kg' ?> </td>
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
    <script src="../plugins/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/additional-methods.min.js"></script>
    <script src="../plugins/jquery-validation-1.19.2/dist/localization/messages_pt_BR.min.js"></script>
    <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="../plugins/package/dist/sweetalert2.all.min.js"></script>
    <script src="../plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    <script src="../js/all.js"></script>
    <script src="../js/googleCharts.js"></script>
</body>
</html>