<?php
require 'config.php';

$sqlVW_PRODUTO = 'SELECT * from VW_PRODUTO';
$sqlPRODUTO = 'SELECT * from PRODUTO';


$dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');
$dadosFamilia = odbc_exec($conn, $sqlPRODUTO)   or die('Erro no sql');

$nLinhas = 1;
$myArray = [];

while(odbc_fetch_row($dadosFamilia)){  
    array_push($myArray, (object)[
        // 'id' => $nLinhas,
        'codprod' => odbc_result($dadosFamilia,"CODPROD"),
        'codfamilia' => odbc_result($dadosFamilia,"CODFAMILIA"),
        'idfichatec' =>odbc_result($dadosFamilia,"IDFICHATECNICA"),
    ]);
    $nLinhas = $nLinhas + 1;
}

// print_r($myArray[1]->codprod);
// echo count($myArray);

// while(odbc_fetch_row($dadosFamilia)) {
//     echo $nLinhas." - ".odbc_result($dadosFamilia,"CODPROD")." ".odbc_result($dadosFamilia,"CODFAMILIA").'<br>';
//     $nLinhas += 1;
// }

$idFichaTec = '';
$codFamilia = '';
$soma = '';
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

    <?php include 'all.php'; ?>

        <div class="right-side-dashboard">    
            <div class="top-dashboard-mobile">
                <div class="top-dashboard">
                    <i class="fas fa-boxes"></i>
                    <span>Produtos Estoque</span>
                </div>
                <div class="open-close-mobile">
                    <div class="open-close-mobile-icon">
                        <i class="fas fa-align-justify"></i>
                    </div>
                </div>
            </div>

        <div class="container-main">
            <div class="header-produtos">
                <div class="header-pagina-produtos">
                    <h2 class="produtos_estoque_h2">Relatório numérico de produtos</h2>
                </div>
                <input class="form-control input-busca" id="myInput" type="text" placeholder="Search..">
            </div>

            <div class="content-table"> 
                <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
                    <thead class="thead_produtos_estoque">
                        <tr>
                            <th data-column='ft' data-order='desc'>Ficha Tec</th>
                            <th data-column='cod' data-order='desc'>Código</th>
                            <th data-column='red' data-order='desc'>Referencia</th>
                            <th data-column='descri' data-order='desc'>Descrição</th>
                            <th data-column='custo' data-order='desc'>Custo (R$)</th>
                            <th data-column='estoque' data-order='desc'>Estoque</th>
                            <th data-column='estoque-final' data-order='desc'>$ Total</th>
                            <th data-column='familia' data-order='desc'>Familia</th>    
                    </tr>
                </thead>

            <?php while (odbc_fetch_row($dados)): ?>
                <?php for ($c=0; $c<=(count($myArray)-1); $c++){
                            if($myArray[$c]->codprod === odbc_result($dados,"CODPROD")){
                                $idFichaTec = $myArray[$c]->idfichatec;
                                $codFamilia = $myArray[$c]->codfamilia;
                                $c=0;  
                                break;
                                // echo odbc_result($dados,"REFERENCIA")." ".$codFamilia."<br>";
                            }
                        }

                        switch ($codFamilia) {
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
                ?>

                <?php if(odbc_result($dados,"EMP") == '00'): ?>
                    <tbody id="myTable">
                        <tr>
                            <td> <?=$idFichaTec?> </td>
                            <td> <?=odbc_result($dados,"CODPROD")?> </td>
                            <td> <?=odbc_result($dados,"REFERENCIA")?></td>
                            <td> <?=odbc_result($dados,"DESCRICAO")?></td>
                            <td> <?="R$ ".number_format(odbc_result($dados,"PRECO_CUSTO"),2)?></td>
                            <td class="table-produtos-estoque"> <?=number_format(odbc_result($dados,"ESTOQUE"),2)?></td>
                            <td> <?="R$ ".number_format(odbc_result($dados,"ESTOQUE") * odbc_result($dados,"PRECO_CUSTO"),2); ?></td>
                            <td> <?=$nomeFamilia;?> </td>
                        </tr>
                    </tbody>
                <?php endif; ?>
            <?php endwhile ?>
            
            </table>
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