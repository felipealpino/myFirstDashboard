<?php 
require '../configODBC.php';
require '../php_library/biblioteca.php';
require 'dataAccessObject.php';

$myInput = $_POST['myInput'];
$myInput = strtoupper($myInput);
$selectedValue = $_POST['selectionValue'];
$dataInicial = $_POST['dataInicial'];
$dataFinal = $_POST['dataFinal'];

if ($myInput === ''){
    goto notfound; //muitas linhas, sistema estava crachando 
}

$dados = cargaAccessData($myInput, $selectedValue, $dataInicial, $dataFinal);
?>


<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0 && $myInput !== ""){ ?>
    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
        <thead class="thead_produtos">
            <tr>
                <th style="text-align: center;">Doc.</th>
                <th>Nome do cliente</th>
                <th>Referen.</th>
                <th>Descricao</th>
                <th style="text-align: center;">Quant.</th>
                <th>Data entrega</th>
                <th>Situação</th>
                <th>Cidade</th>
                <th>Vendedor</th>
            </tr>
        </thead>

        <tbody id="myTable">
        <?php while(odbc_fetch_row($dados)): 
            $dataFormated = formatEuaDataToBrasilData(odbc_result($dados,"DATAPENTREGA")); 
        ?>

            <tr>
                <td> <?=odbc_result($dados,"CODPEDIDO")?> </td>
                <td> <?=odbc_result($dados,"CLIENTE")?> </td>
                <td> <?=odbc_result($dados,"REFERENCIA")?> </td>
                <td> <?=odbc_result($dados,"DESCRICAO")?> </td>
                <td style="text-align: center;"> <?=odbc_result($dados,"QUANTIDADE")?> </td>
                <td style="text-align: center;"> <?=$dataFormated?> </td>
                <td> <?=odbc_result($dados,"STATUS")?> </td>
                <td> <?=odbc_result($dados,"CIDADE")?> </td>
                <td> <?=odbc_result($dados,"VENDEDOR")?> </td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</div>

    <?php } else {
        notfound:
        echo "<span class=\"span-produto-estoque-sem-produto\">Nenhum resultado encontrado ....</span>";
    } ?>