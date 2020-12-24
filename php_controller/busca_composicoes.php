<?php 
require '../configODBC.php';
require '../php_library/biblioteca.php';
$myInput = $_POST['myInput'];
$myInput = getIdFIchaTecnicaSintaxe($myInput); 

$sqlVW_PRODUTO =   "SELECT * FROM 
                   (SELECT VW_PRODUTO.EMP, VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, FICHATECNICAI.IDFICHATECNICA, FICHATECNICAI.QUANTIDADE, FICHATECNICAI.PRECOCUSTO, FICHATECNICAI.SOMA
                    FROM VW_PRODUTO
                    INNER JOIN FICHATECNICAI
                    ON VW_PRODUTO.CODPROD = FICHATECNICAI.CODPROD) 
                    WHERE (IDFICHATECNICA LIKE '%$myInput%' AND EMP LIKE '00')";

$dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');

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
                    <th style="text-align: center;">Quant.</th>
                    <th>Custo (R$)</th>
                    <th>Soma (R$)</th>
                </tr>
            </thead>

            <tbody id="myTable">
            <?php while(odbc_fetch_row($dados)): ?>
                <tr>
                    <td> <?=odbc_result($dados,"IDFICHATECNICA")?> </td>
                    <td> <?=odbc_result($dados,"CODPROD")?> </td>
                    <td> <?=odbc_result($dados,"REFERENCIA")?> </td>
                    <td> <?=odbc_result($dados,"DESCRICAO")?> </td>
                    <td style="text-align: center;"> <?=odbc_result($dados,"QUANTIDADE") ?> </td>
                    <td> <?="R$ ".number_format(odbc_result($dados,"PRECOCUSTO"),2)?></td>
                    <td> <?="R$ ".number_format(odbc_result($dados,"SOMA"),2)?></td>
                </tr>
            <?php endwhile ?>
            </tbody>
    </table>
</div>
        <?php } else {
            echo "<span class=\"span-produto-estoque-sem-produto\">Nenhum resultado encontrado ....</span>";
        } ?>