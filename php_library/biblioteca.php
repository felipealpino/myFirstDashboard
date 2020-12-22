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






?>