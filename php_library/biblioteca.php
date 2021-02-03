<?php

/**
 * Biblioteca para pegar o nome do vendedor pelo código (ainda não achei a table referente a isso)
 */
function findNomeVendedor($codVendedor){
  switch($codVendedor){
    case '0002':
      $nomeVendedor = 'Janaina';
      break;
    case '0012':
      $nomeVendedor = 'Rosangela';
      break;
    case '0057':
      $nomeVendedor = 'Lilas';
      break;
    case '0056':
      $nomeVendedor = 'Camila';
      break;
    case '0047':
      $nomeVendedor = 'Eduardo';
      break;
    case '0058':
      $nomeVendedor = 'Daniele';
      break;
    case '0055':
      $nomeVendedor = 'Dlucca';
      break;
    default:
      $nomeVendedor = $codVendedor;
      break;
  }
  return $nomeVendedor;
}




/**
 * Função para achar o nome do mês de acordo com um valor de 1 até 12
 */
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




/**
 * Função para achar nome da familia de um produto pelo código 
 */
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




/**
 * Função para facilitar busca pela ficha tecnica em composicoes.php
 */
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




/**
 * Funçao para inverter data que vem do banco de:
 * yyyy-MM-dd
 * para
 * dd-MM-yyyy
 */
function formatEuaDataToBrasilData($dataInvertida){
  $arrayData = explode('-', $dataInvertida);
  return (substr($arrayData[2],0,2).'/'.$arrayData[1].'/'.$arrayData[0]);
}




/**
 * Função para escrever um valor double para moeda brasileira
 * exemplo: 
 * entrada  - 12345.22334556
 * saida    - 12.345,22
 */
function formatNumberToReal($intValue){
  return number_format($intValue, 2, ',', '.');
}


?>