<?php 
require '../configODBC.php';
require '../php_library/biblioteca.php';
$myInput = $_POST['myInput'];
$myInput = strtoupper($myInput);

$radioValue = $_POST['radioValue'];

$sqlVW_PRODUTO =   "SELECT VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, VW_PRODUTO.PRECO_CUSTO, VW_PRODUTO.ESTOQUE, PRODUTO.CODFAMILIA, PRODUTO.IDFICHATECNICA 
                    FROM VW_PRODUTO
                    INNER JOIN PRODUTO
                    ON VW_PRODUTO.CODPROD = PRODUTO.CODPROD 
                    WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR CODPROD LIKE '%$myInput%')
                    ORDER BY ESTOQUE $radioValue ";
 

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
        
            <?php while(odbc_fetch_row($dados)): 
                $nomeFamilia = findNomeFamilia(odbc_result($dados,"CODFAMILIA"));
            ?> 

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
