<?php 
require '../configODBC.php';
require '../php_library/biblioteca.php';
require 'dataAccessObject.php';

$myInput = $_POST['myInput'];
$myInput = strtoupper($myInput);
$radioValue = $_POST['radioValue'];

$dados = produtosAccessData($myInput, $radioValue);

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
