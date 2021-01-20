<?php 
require '../configODBC.php';~
require '../php_library/biblioteca.php';
require 'dataAccessObject.php';
// $myInput = filter_input(INPUT_GET,'busca-descricao');
$myInput = $_POST['myInput'];

$myInput = strtoupper($myInput);
if ($myInput === ''){
    goto notfound; //muitas linhas, sistema estava crachando 
}

$dados = kardexAccessData($myInput);

?>

<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0) { ?>
    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
            <thead class="thead_produtos">
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