<?php

function findNomeMes($c){
    $mesNome = '';
    switch($c):
        case 1:
          $mesNome = 'Janeiro';
          break;
        case 2:
          $mesNome = 'Fevereiro';
          break;
        case 3:
          $mesNome = 'Março';
          break;
        case 4:
          $mesNome = 'Abril';
          break;
        case 5:
          $mesNome = 'Maio';
          break;
        case 6:
          $mesNome = 'Junho';
          break;
        case 7:
          $mesNome = 'Julho';
          break;
        case 8:
          $mesNome = 'Agosto';
          break;
        case 9:
          $mesNome = 'Setem.';
          break;
        case 10:
          $mesNome = 'Outubro';
          break;
        case 11:
          $mesNome = 'Novem.';
          break;
        case 12:
          $mesNome = 'Dezem.';
          break;
        default:
          $mesNome = 'Error';
    endswitch;
    return $mesNome;
}

function findNomeFamilia($codFam){
  switch ($codFam){
    case '01':
        $nomeFamilia = "INSUMO";
        break;
    case '02':
        $nomeFamilia = "REVENDA";
        break;
    case '03':
        $nomeFamilia = "TRANSFORMACAO";
        break;
    case '04':
        $nomeFamilia = "MONTAGEM";
        break;
    case '05':
        $nomeFamilia = "SERVICOS";
        break;
    case '06':
        $nomeFamilia = "ESCRITÓRIO";
        break;
    case '07':
        $nomeFamilia = "INFORMATICA";
        break;
    case '08':
        $nomeFamilia = "ELETRODOMESTICOS";
        break;
    case '09':
        $nomeFamilia = "MOVEIS";
        break;
    case '10':
        $nomeFamilia = "TELEFONIA";
        break;
    case '11':
        $nomeFamilia = "IMOBILIZADOS";
        break;
    case '12':
        $nomeFamilia = "FERRAMENTAS";
        break;
    case '13':
        $nomeFamilia = "CAMINHOES";
        break;
    case '14':
        $nomeFamilia = "VEICULOS";
        break;
    case '15':
        $nomeFamilia = "MAQUINARIO";
        break;
    case '16':
        $nomeFamilia = "OUTROS";
        break;
    case '17':
        $nomeFamilia = "ALUGUEL";
        break;
    case '18':
        $nomeFamilia = "MATERIA PRIMA";
        break;
    case '19':
        $nomeFamilia = "PRODUTO LD";
        break;
    case '20':
        $nomeFamilia = "MOSTRUARIO";
        break;
    default:
         $nomeFamilia = "ADICIONAR FAMILIA";
  }
  return $nomeFamilia;
}

function getIdFIchaTecnicaSintaxe($input){
  $myInput = '';
  switch(strlen($input)){
    case 1:
        $myInput = "000000000".$input; 
        break;
    case 2:
        $myInput = "00000000".$input;
        break;
    case 3:
        $myInput = "0000000".$input;
        break;
    case 4:
        $myInput = "000000".$input;
        break;
    case 5:
        $myInput = "00000".$input;
        break;
    case 6:
        $myInput = "0000".$input;
        break;
    case 7:
        $myInput = "000".$input;
        break;
    case 8:
        $myInput = "00".$input;
        break;
    case 9:
        $myInput = "0".$input;
        break;  
  }
  return $myInput;
}

function formatEuaDataToBrasilData($dataInvertida){
  $arrayData = explode('-', $dataInvertida);
  return (substr($arrayData[2],0,2).'/'.$arrayData[1].'/'.$arrayData[0]);
}

?>