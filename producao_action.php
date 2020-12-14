<?php
// require 'config.php';

// $mes = filter_input(INPUT_GET,'mes_producao_name');
// $ano = filter_input(INPUT_GET,'ano_producao_name');
// $pesoDia = [];
// // echo $mes.'<br>';
// // echo $ano.'<br>';

// if($mes && $ano) {
//     $mvGeral = 'SELECT * FROM MVGERAL';
//     $dados = odbc_exec($conn, $mvGeral)  or die('Erro no sql');
//     $myArray = [];

//     while(odbc_fetch_row($dados)){
//         $arrayData = explode("-",odbc_result($dados,"DT_MOVIMENTO"));  

//         if (odbc_result($dados,"CODEMPRESA") == "00" && $arrayData[1] == $mes && $arrayData[0] == $ano && odbc_result($dados,"TIPOMOV") == "11" && (odbc_result($dados,"CODPROD") == "000880" || odbc_result($dados,"CODPROD") == "000383")){
//             array_push($myArray, (object)[
//             'dia' => substr(($arrayData[2]),0,2),
//             'quant' => odbc_result($dados, "QUANTIDADE"),
//             // 'prod' => odbc_result($dados,"CODPROD"),
//             ]);
//         }
//     }

//     $myArraySize = (count($myArray)-1);
//     $pesoDia = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

//     foreach($myArray as $value){
//             switch($value->dia){
//                 case '01':
//                     $pesoDia[0] = $pesoDia[0] + $value->quant;
//                     break;
//                 case '02':
//                     $pesoDia[1] = $pesoDia[1] + $value->quant;
//                     break;
//                 case '03':
//                     $pesoDia[2] = $pesoDia[2] + $value->quant;
//                     break;
//                 case '04':
//                     $pesoDia[3] = $pesoDia[3] + $value->quant;
//                     break;
//                 case '05':
//                     $pesoDia[4] = $pesoDia[4] + $value->quant;
//                     break;
//                 case '06':
//                     $pesoDia[5] = $pesoDia[5] + $value->quant;
//                     break;
//                 case '07':
//                     $pesoDia[6] = $pesoDia[6] + $value->quant;
//                     break;
//                 case '08':
//                     $pesoDia[7] = $pesoDia[7] + $value->quant;
//                     break;
//                 case '09':
//                     $pesoDia[8] = $pesoDia[8] + $value->quant;
//                     break;
//                 case '10':
//                     $pesoDia[9] = $pesoDia[9] + $value->quant;
//                     break;
//                 case '11':
//                     $pesoDia[10] = $pesoDia[10] + $value->quant;
//                     break;
//                 case '12':
//                     $pesoDia[11] = $pesoDia[11] + $value->quant;
//                     break;
//                 case '13':
//                     $pesoDia[12] = $pesoDia[12] + $value->quant;
//                     break;
//                 case '14':
//                     $pesoDia[13] = $pesoDia[13] + $value->quant;
//                     break;
//                 case '15':
//                     $pesoDia[14] = $pesoDia[14] + $value->quant;
//                     break;
//                 case '16':
//                     $pesoDia[15] = $pesoDia[15] + $value->quant;
//                     break;
//                 case '17':
//                     $pesoDia[16] = $pesoDia[16] + $value->quant;
//                     break;
//                 case '18':
//                     $pesoDia[17] = $pesoDia[17] + $value->quant;
//                     break;               
//                 case '19':
//                     $pesoDia[18] = $pesoDia[18] + $value->quant;
//                     break;
//                 case '20':
//                     $pesoDia[19] = $pesoDia[19] + $value->quant;
//                     break;
//                 case '21':
//                     $pesoDia[20] = $pesoDia[20] + $value->quant;
//                     break;
//                 case '22':
//                     $pesoDia[21] = $pesoDia[21] + $value->quant;
//                     break;
//                 case '23':
//                     $pesoDia[22] = $pesoDia[22] + $value->quant;
//                     break;
//                 case '24':
//                     $pesoDia[23] = $pesoDia[23] + $value->quant;
//                     break;
//                 case '25':
//                     $pesoDia[24] = $pesoDia[24] + $value->quant;
//                     break;
//                 case '26':
//                     $pesoDia[25] = $pesoDia[25] + $value->quant;
//                     break;
//                 case '27':
//                     $pesoDia[26] = $pesoDia[26] + $value->quant;
//                     break;
//                 case '28':
//                     $pesoDia[27] = $pesoDia[27] + $value->quant;
//                     break;
//                 case '29':
//                     $pesoDia[28] = $pesoDia[28] + $value->quant;
//                     break;
//                 case '30':
//                     $pesoDia[29] = $pesoDia[29] + $value->quant;
//                     break;
//                 case '31':
//                     $pesoDia[30] = $pesoDia[30] + $value->quant;
//                     break;
//         }
//     }

//     // return $pesoDia;
//     header("Location:producao.php");

// } else {
//     header("Location:dashboard.php");
// }

// print_r($myArray);
// print_r($pesoDia);

?>