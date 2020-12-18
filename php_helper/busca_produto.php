<?php 
require '../config.php';
// $myInput = filter_input(INPUT_GET,'busca-descricao');
$myInput = $_POST['myInput'];
$myInput = strtoupper($myInput);

$radioValue = $_POST['radioValue'];
if ($radioValue !== 'ASC'){
    $radioValue = 'DESC';
} else {
    $radioValue = 'ASC';
}


$sqlVW_PRODUTO =   "SELECT * FROM 
                   (SELECT VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, VW_PRODUTO.PRECO_CUSTO, VW_PRODUTO.ESTOQUE, PRODUTO.CODFAMILIA, PRODUTO.IDFICHATECNICA 
                    FROM VW_PRODUTO
                    INNER JOIN PRODUTO
                    ON VW_PRODUTO.CODPROD = PRODUTO.CODPROD) 
                    WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR CODPROD LIKE '%$myInput%')
                    ORDER BY ESTOQUE $radioValue";

$dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');

// $sqlVW_PRODUTO = "SELECT * FROM VW_PRODUTO WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%') AND EMP LIKE '00'";
// $dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');

// $sqlPRODUTO = 'SELECT CODPROD,CODFAMILIA,IDFICHATECNICA from PRODUTO';
// $dadosFamilia = odbc_exec($conn, $sqlPRODUTO) or die('Erro no sql');
// $myArray = [];
// while(odbc_fetch_row($dadosFamilia)){  
//     array_push($myArray, (object)[
//         'codprod' => odbc_result($dadosFamilia,"CODPROD"),
//         'codfamilia' => odbc_result($dadosFamilia,"CODFAMILIA"),
//         'idfichatec' =>odbc_result($dadosFamilia,"IDFICHATECNICA"),
//     ]);
// }
// $idFichaTec = '';
// $codFamilia = '';


?>

<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0){ ?>
    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
            <thead class="thead_produtos_estoque">
                <tr>
                    <th>Ficha Tec</th>
                    <th>Código</th>
                    <th>Referencia</th>
                    <th>Descrição</th>
                    <th>Custo (R$)</th>
                    <th>Estoque</th>
                    <th>Total (R$)</th>
                    <th>Familia</th>    
                </tr>
            </thead>
        
            <?php while(odbc_fetch_row($dados)): ?>
            <?php switch (odbc_result($dados,"CODFAMILIA")){
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
            } //endswitch ?> 

                <tbody id="myTable">
                    <tr>
                        <td> <?=odbc_result($dados,"IDFICHATECNICA") ?> </td>
                        <td> <?=odbc_result($dados,"CODPROD")?> </td>
                        <td> <?=odbc_result($dados,"REFERENCIA")?></td>
                        <td> <?=odbc_result($dados,"DESCRICAO")?></td>
                        <td> <?="R$ ".number_format(odbc_result($dados,"PRECO_CUSTO"),2)?></td>
                        <td style="text-align: center;"> <?=number_format(odbc_result($dados,"ESTOQUE"),2)?></td>
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
