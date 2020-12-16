<?php 
require '../config.php';
// $myInput = filter_input(INPUT_GET,'busca-descricao');
$myInput = $_POST['myInput'];
$myInput = strtoupper($myInput);
$sqlVW_PRODUTO = "SELECT * FROM VW_PRODUTO WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%') AND EMP LIKE '00'";
$dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');



$sqlPRODUTO = 'SELECT CODPROD,CODFAMILIA,IDFICHATECNICA from PRODUTO';
$dadosFamilia = odbc_exec($conn, $sqlPRODUTO) or die('Erro no sql');
$myArray = [];
while(odbc_fetch_row($dadosFamilia)){  
    array_push($myArray, (object)[
        'codprod' => odbc_result($dadosFamilia,"CODPROD"),
        'codfamilia' => odbc_result($dadosFamilia,"CODFAMILIA"),
        'idfichatec' =>odbc_result($dadosFamilia,"IDFICHATECNICA"),
    ]);
}
$idFichaTec = '';
$codFamilia = '';


?>

<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0){ ?>
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
        
            <?php while(odbc_fetch_row($dados)): ?>
                <?php for($c=0; $c<=(count($myArray)-1); $c++){
                if ($myArray[$c]->codprod === odbc_result($dados,"CODPROD")){
                    $idFichaTec = $myArray[$c]->idfichatec;
                    $codFamilia = $myArray[$c]->codfamilia;
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
            }
            ?>
                <tbody id="myTable">
                    <tr>
                        <td> <?=$idFichaTec ?> </td>
                        <td> <?=odbc_result($dados,"CODPROD")?> </td>
                        <td> <?=odbc_result($dados,"REFERENCIA")?></td>
                        <td> <?=odbc_result($dados,"DESCRICAO")?></td>
                        <td> <?="R$ ".number_format(odbc_result($dados,"PRECO_CUSTO"),2)?></td>
                        <td class="table-produtos-estoque"> <?=number_format(odbc_result($dados,"ESTOQUE"),2)?></td>
                        <td> <?="R$ ".number_format(odbc_result($dados,"ESTOQUE") * odbc_result($dados,"PRECO_CUSTO"),2); ?></td>
                        <td> <?=$nomeFamilia ?> </td>
                    </tr>
                </tbody>
            <?php endwhile; ?>
    </table>
</div>
        <?php } else {
            echo "<span class=\"span-produto-estoque-sem-produto\">Nenhum resultado encontrado ....</span>";
        } ?>