<?php 
require '../configODBC.php';~
require '../php_library/biblioteca.php';
// $myInput = filter_input(INPUT_GET,'busca-descricao');
$myInput = $_POST['myInput'];

$myInput = strtoupper($myInput);
if ($myInput === ''){
    goto notfound; //muitas linhas, sistema estava crachando 
}

// $sqlMVGERAL = "SELECT * FROM MVGERAL WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%') AND EMP LIKE '00'";
$sqlMVGERAL = "SELECT * FROM 
              (SELECT MVGERAL.CODEMPRESA, MVGERAL.DT_MOVIMENTO, MVGERAL.DOCUMENTO, MVGERAL.CODPROD, MVGERAL.TIPOMOV, MVGERAL.QUANTIDADE,VW_PRODUTO.EMP, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO
               FROM MVGERAL
               INNER JOIN VW_PRODUTO
               ON MVGERAL.CODPROD = VW_PRODUTO.CODPROD) 
               WHERE ((DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR DOCUMENTO LIKE '%$myInput%') AND (CODEMPRESA LIKE '00' AND EMP LIKE '00'))";

$dados = odbc_exec($conn, $sqlMVGERAL)  or die('Erro no sql');
?>

<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0) { ?>
    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
            <thead class="thead_produtos_estoque">
                <tr>
                    <th>Data Mov.</th>
                    <th>Documento</th>
                    <th>Situação</th>
                    <th>Código</th>
                    <th>Referencia</th>
                    <th>Descrição</th>
                    <th>Quantid.</th>
                    <!-- <th>Custo (R$)</th>
                    <th>Total (R$)</th>     -->
                </tr>
            </thead>
        <?php while(odbc_fetch_row($dados)): 
            $dataFormated = formatEuaDataToBrasilData(odbc_result($dados,"DT_MOVIMENTO"));
        ?> 
            <tbody id="myTable">
                <tr>
                    <td style="text-align: center;"> <?=$dataFormated?></td>
                    <td> <?=odbc_result($dados,"DOCUMENTO")?> </td>
                    <td> <?=odbc_result($dados,"TIPOMOV")?> </td>
                    <td> <?=odbc_result($dados,"CODPROD")?> </td>
                    <td> <?=odbc_result($dados,"REFERENCIA")?> </td>
                    <td> <?=odbc_result($dados,"DESCRICAO")?> </td>
                    <td style="text-align: center;"> <?=odbc_result($dados,"QUANTIDADE")?> </td>
                </tr>
            </tbody>
        <?php endwhile; ?>
    </table>
</div>
    <?php } else {
        notfound:
        echo "<span class=\"span-produto-estoque-sem-produto\">Nenhum resultado encontrado ....</span>";
    } ?>