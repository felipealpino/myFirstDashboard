<?php 
require '../connections/configODBC.php';
require '../php_library/biblioteca.php';
require 'dataAccessObject.php';
session_start();
$myInput = $_POST['myInput'];
$myInput = strtoupper($myInput);

$dados = produtosAccessData($myInput);

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
                    <?php if($_SESSION['permissao'] != 4): ?> 
                        <th>Custo (R$)</th>
                    <?php endif ?>
                    <th>Estoque</th>
                    <?php if($_SESSION['permissao'] != 4): ?> 
                        <th>Total (R$)</th>
                    <?php endif ?>
                    <th>Familia</th>    
                </tr>
            </thead>
        
            
            <tbody id="myTable">

            <?php while(odbc_fetch_row($dados)): 
                $nomeFamilia = findNomeFamilia(odbc_result($dados,"CODFAMILIA"));
            ?> 
                <tr>
                    <td> <?=odbc_result($dados,"IDFICHATECNICA") ?> </td>
                    <td> <?=odbc_result($dados,"CODPROD")?> </td>
                    <td> <?=odbc_result($dados,"REFERENCIA")?></td>
                    <td> <?=odbc_result($dados,"DESCRICAO")?></td>
                    <?php if($_SESSION['permissao'] != 4): ?> 
                        <td> <?="R$ ".number_format(odbc_result($dados,"PRECO_CUSTO"),2)?></td>
                    <?php endif ?>
                    <td style="text-align: center;"> <?=number_format(odbc_result($dados,"ESTOQUE"),2)?></td>
                    <?php if($_SESSION['permissao'] != 4): ?> 
                        <td> <?="R$ ".number_format(odbc_result($dados,"ESTOQUE") * odbc_result($dados,"PRECO_CUSTO"),2); ?></td>
                    <?php endif ?>    
                    <td> <?=$nomeFamilia ?> </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
    </table>
</div>

    <?php } else {
        echo "<span class=\"span-produto-estoque-sem-produto\">Nenhum resultado encontrado ....</span>";
    } ?>
