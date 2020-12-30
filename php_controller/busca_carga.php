<?php 
require '../configODBC.php';
require '../php_library/biblioteca.php';
$myInput = $_POST['myInput'];
$myInput = strtoupper($myInput);
$selectedValue = $_POST['selectionValue'];

// $sqlAll =   "SELECT ENTREGAC.CODEMPRESA, ENTREGAC.DOCUMENTO, CLIENTE.NOME, VW_PRODUTO.EMP, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, ENTREGAI.CODEMPRESA, ENTREGAI.QUANTIDADE, ENTREGAI.DATAPENTREGA, ENTREGAI.STATUS, CLIENTE.CODCIDADE, ENTREGAC.FRETETOTAL, CARGA2.VENDEDOR
//             FROM ENTREGAI
//             INNER JOIN FICHATECNICAI
//             ON ENTREGAI.CODPROD = FICHATECNICAI.CODPROD
//             INNER JOIN VW_PRODUTO
//             ON ENTREGAI.CODPROD = VW_PRODUTO.CODPROD
//             INNER JOIN ENTREGAC 
//             ON ENTREGAI.IDENTREGAC = ENTREGAC.IDENTREGAC
//             INNER JOIN CLIENTE
//             ON ENTREGAC.CODCLIENTE = CLIENTE.CODCLIENTE
//             INNER JOIN CARGA2
//             ON ENTREGAC.DOCUMENTO = CARGA2.CODPEDIDO
//             WHERE (($selectedValue LIKE '%$myInput%') AND (EMP LIKE '00' AND ENTREGAC.CODEMPRESA LIKE '00' AND ENTREGAI.CODEMPRESA LIKE '00' ))
//             ORDER BY NOME ASC";

$sqlAll =   "SELECT CARGA2.CODPEDIDO, CARGA2.CLIENTE, CARGA2.REFERENCIA, CARGA2.DESCRICAO, CARGA2.QUANTIDADE, CARGA2.DATAPENTREGA, CARGA2.CIDADE, CARGA2.STATUS, CARGA2.VENDEDOR
            FROM CARGA2
            -- INNER JOIN FICHATECNICAI
            -- ON CARGA2.CODPROD = FICHATECNICAI.CODPROD
            WHERE ($selectedValue LIKE '%$myInput%')
            ORDER BY DATAPENTREGA ASC";

$dados = odbc_exec($conn,$sqlAll)  or die('Erro no sql');
?>


<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0){ ?>
    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
            <thead class="thead_produtos_estoque">
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
            echo "<span class=\"span-produto-estoque-sem-produto\">Nenhum resultado encontrado ....</span>";
        } ?>