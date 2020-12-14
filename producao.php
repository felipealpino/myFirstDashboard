<?php
require 'config.php';

/* EXPLICAÇÃO DO CÓDIGO: 
1) inicialmente é pego o valor ano e mes via GET, caso nao setado, é setado automaticamente o mes e ano atual
2) é montado um array de objetos 'data' e 'quantidade' com a data escolhida (os filtros estão no 'if' dentro do 'while') 
3) é montado um array de 31 IDs ($pesoDia) e disponibilizado para o HTML, com isso pode ser acessado para adicionar os valores no gráfico
*/


$mes = filter_input(INPUT_GET,'mes_producao_name');
$ano = filter_input(INPUT_GET,'ano_producao_name');
$pesoDia = [];
if (!$mes && !$ano){
    $mes = date('m');
    $ano = date('Y');
}

if($mes && $ano) {
    $mvGeral = 'SELECT * FROM MVGERAL';
    $dados = odbc_exec($conn, $mvGeral)  or die('Erro no sql');
    $myArray = [];

    while(odbc_fetch_row($dados)){
        $arrayData = explode("-",odbc_result($dados,"DT_MOVIMENTO"));  

        if (odbc_result($dados,"CODEMPRESA") == "00" && $arrayData[1] == $mes && $arrayData[0] == $ano && odbc_result($dados,"TIPOMOV") == "11" && (odbc_result($dados,"CODPROD") == "000880" || odbc_result($dados,"CODPROD") == "000383")){
            array_push($myArray, (object)[
            'dia' => substr(($arrayData[2]),0,2),
            'quant' => odbc_result($dados, "QUANTIDADE"),
            // 'prod' => odbc_result($dados,"CODPROD"),
            ]);
        }
    }

    $myArraySize = (count($myArray)-1);
    $pesoDia = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];  //DECLAREI ASSIM PORQUE ESTAVA DANDO ERROR

    foreach($myArray as $value){
            switch($value->dia){
                case '01':
                    $pesoDia[0] += $value->quant;   
                    break;
                case '02':
                    $pesoDia[1] += $value->quant;
                    break;
                case '03':
                    $pesoDia[2] += $value->quant;
                    break;
                case '04':
                    $pesoDia[3] += $value->quant;
                    break;
                case '05':
                    $pesoDia[4] += $value->quant;
                    break;
                case '06':
                    $pesoDia[5] += $value->quant;
                    break;
                case '07':
                    $pesoDia[6] += $value->quant;
                    break;
                case '08':
                    $pesoDia[7] += $value->quant;
                    break;
                case '09':
                    $pesoDia[8] += $value->quant;
                    break;
                case '10':
                    $pesoDia[9] += $value->quant;
                    break;
                case '11':
                    $pesoDia[10] += $value->quant;
                    break;
                case '12':
                    $pesoDia[11] += $value->quant;
                    break;
                case '13':
                    $pesoDia[12] += $value->quant;
                    break;
                case '14':
                    $pesoDia[13] += $value->quant;
                    break;
                case '15':
                    $pesoDia[14] += $value->quant;
                    break;
                case '16':
                    $pesoDia[15] += $value->quant;
                    break;
                case '17':
                    $pesoDia[16] += $value->quant;
                    break;
                case '18':
                    $pesoDia[17] += $value->quant;
                    break;               
                case '19':
                    $pesoDia[18] += $value->quant;
                    break;
                case '20':
                    $pesoDia[19] += $value->quant;
                    break;
                case '21':
                    $pesoDia[20] += $value->quant;
                    break;
                case '22':
                    $pesoDia[21] += $value->quant;
                    break;
                case '23':
                    $pesoDia[22] += $value->quant;
                    break;
                case '24':
                    $pesoDia[23] += $value->quant;
                    break;
                case '25':
                    $pesoDia[24] += $value->quant;
                    break;
                case '26':
                    $pesoDia[25] += $value->quant;
                    break;
                case '27':
                    $pesoDia[26] += $value->quant;
                    break;
                case '28':
                    $pesoDia[27] += $value->quant;
                    break;
                case '29':
                    $pesoDia[28] += $value->quant;
                    break;
                case '30':
                    $pesoDia[29] += $value->quant;
                    break;
                case '31':
                    $pesoDia[30] += $value->quant;
                    break;
        }
    }

    // return $pesoDia;
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
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var x = 1;
        var data = google.visualization.arrayToDataTable([
        ['Dia', 'Quant.', { role: 'annotation' } ],
        <?php for($x=1; $x<=31; $x++): ?>   
            //Adicionando valores no gráfico:
            ['<?='0'.$x;?>' , <?=$pesoDia[$x - 1];?>, <?=$pesoDia[$x -1];?>],
        <?php endfor ?>

        ]);

        var options = {
          chart: {
            title: 'Production Performance',
            subtitle: 'Production / day',
          },
          hAxis:{
              maxValue: 3000,
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };
        var chart = new google.charts.Bar(document.getElementById('dashboard-grafico-producao'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      </script>

      
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard-content">
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
                            <a href="dashboard.html">Dashboard</a>
                        </li>
                        <li>
                            <i class="fas fa-user-alt"></i>
                            <a href="perfil.html">Perfil</a>
                        </li>
                        <li>
                            <i class="fas fa-boxes"></i>
                            <a href="estoque.html">estoque</a>
                        </li>
                        <li class="selected">
                            <i class="fas fa-hammer"></i>
                            <a href="producao.php">producao</a>
                        </li>
                        <li>
                            <i class="far fa-money-bill-alt"></i>
                            <a href="vendas.html">vendas</a>
                        </li>
                        <li>
                            <i class="fas fa-shopping-cart"></i>
                            <a href="compras.html">compras</a>
                        </li>
                        <li>
                            <i class="fas fa-sign-out-alt"></i>
                            <a href="index.html">Logout</a>    
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="right-side-dashboard">    
            <div class="top-dashboard-mobile">
                <div class="top-dashboard">
                    <i class="fas fa-hammer"></i>
                    <span>Produção</span>
                        
                    <form action="producao.php" method="GET" class="form-producao">
                        <span>Mês:</span>
                        <input type="number" value="<?=date("m");?>" name="mes_producao_name" min="1" max="12" id="mes_producao_id" required>
                        <span class="ano_form_span">Ano:</span>
                        <input type="number" value="<?=date("Y");?>" name="ano_producao_name" min="2019" max="2021" id="ano_producao_id" required>
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