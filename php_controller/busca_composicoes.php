<?php 
require '../connections/configODBC.php';
require '../php_library/biblioteca.php';
require 'dataAccessObject.php';
$myInput = $_POST['myInput'];
$myInput = getIdFIchaTecnicaSintaxe($myInput); 
session_start();
$dados = composicoesAccessData($myInput);

?>

<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0){ ?>
    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
            <thead class="thead_produtos">
                <tr>
                    <th>Ficha Tec</th>
                    <th>Código</th>
                    <th>Referencia</th>
                    <th>Descrição</th>
                    <th style="text-align: center;">Quant.</th>
                    <?php if($_SESSION['permissao'] != 4 && $_SESSION['permissao'] != 6): ?>  <!-- 4 vendas | 6 teste_usuario --> 
                        <th>Custo (R$)</th>
                        <th>Soma (R$)</th>
                    <?php endif ?>
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
                    <?php if($_SESSION['permissao'] != 4 && $_SESSION['permissao'] != 6): ?>  <!-- 4 vendas | 6 teste_usuario -->
                        <td> <?="R$ ".number_format(odbc_result($dados,"PRECOCUSTO"),2)?></td>
                        <td> <?="R$ ".number_format(odbc_result($dados,"SOMA"),2)?></td>
                    <?php endif ?>
                </tr>
            <?php endwhile ?>
            </tbody>
    </table>
</div>
        <?php } else {
            echo "<span class=\"span-produto-estoque-sem-produto\">Nenhum resultado encontrado ....</span>";
        } ?>