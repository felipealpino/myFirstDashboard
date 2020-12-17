<?php 
require '../config.php';
// $myInput = filter_input(INPUT_GET,'busca-descricao');
$myInput = $_POST['myInput'];

$sqlENTREGACxCLIENTE =        "SELECT ENTREGAC.DOCUMENTO, ENTREGAC.IDENTREGAC, ENTREGAC.CODCLIENTE, ENTREGA.FRETETOTAL, CLIENTE.NOME, CLIENTE.CIDADE
                               FROM ENTREGAC
                               INNER JOIN CLIENTE
                               ON ENTREGAC.CODCLIENTE = CLIENTE.CODCLIENTE";

$sqlENTREGACxCLIENTExCARGA2 = "SELECT sqlENTREGACxCLIENTE.DOCUMENTO, sqlENTREGACxCLIENTE.IDENTREGAC, sqlENTREGACxCLIENTE.CODCLIENTE, sqlENTREGACxCLIENTE.FRETETOTAL, sqlENTREGACxCLIENTE.NOME, sqlENTREGACxCLIENTE.CIDADE, CARGA2.VENDEDOR
                               FROM sqlENTREGACxCLIENTE
                               INNER JOIN CARGA2
                               ON sqlENTREGACxCLIENTE.DOCUMENTO = CARGA2.DOCUMENTO";

$sqlVW_PRODUTOxFICHATECNICAI = 
                              "SELECT VW_PRODUTO.EMP, VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, FICHATECNICAI.IDFICHATECNICA
                               FROM VW_PRODUTO
                               INNER JOIN FICHATECNICAI
                               ON VW_PRODUTO.CODPROD = FICHATECNICAI.CODPROD"; 

$sqlENTREGACxCLIENTExCARGA2xENTREGAI = 
                              "SELECT sqlENTREGACxCLIENTExCARGA2.DOCUMENTO, sqlENTREGACxCLIENTExCARGA2.FRETETOTAL, sqlENTREGACxCLIENTExCARGA2.NOME, sqlENTREGACxCLIENTExCARGA2.CIDADE, sqlENTREGACxCLIENTExCARGA2.VENDEDOR, ENTREGAI.CODEMPRESA, ENTREGAI.CODPROD, ENTREGAI.QUANTIDADE, ENTREGAI.DATAPENTREGA, ENTREGAI.STATUS
                               FROM sqlENTREGACxCLIENTExCARGA2
                               INNER JOIN ENTREGAI
                               ON sqlENTREGACxCLIENTExCARGA2.IDENTREGAC = ENTREGAI.IDENTREGAC";

$sqlALL = 
       "SELECT sqlENTREGACxCLIENTExCARGA2xENTREGAI.DOCUMENTO, sqlENTREGACxCLIENTExCARGA2xENTREGAI.FRETETOTAL, sqlENTREGACxCLIENTExCARGA2xENTREGAI.NOME, sqlENTREGACxCLIENTExCARGA2xENTREGAI.CIDADE, sqlENTREGACxCLIENTExCARGA2xENTREGAI.VENDEDOR, sqlENTREGACxCLIENTExCARGA2xENTREGAI.CODEMPRESA, sqlENTREGACxCLIENTExCARGA2xENTREGAI.CODPROD, sqlENTREGACxCLIENTExCARGA2xENTREGAI.QUANTIDADE, sqlENTREGACxCLIENTExCARGA2xENTREGAI.DATAPENTREGA, sqlENTREGACxCLIENTExCARGA2xENTREGAI.STATUS
        FROM sqlENTREGACxCLIENTExCARGA2xENTREGAI
        INNER JOIN $sqlVW_PRODUTOxFICHATECNICAI
        ON sqlENTREGACxCLIENTExCARGA2xENTREGAI.CODPROD = sqlVW_PRODUTOxFICHATECNICAI.CODPROD";


$dados = odbc_exec($conn, $sqlALL)  or die('Erro no sql');
while(odbc_fetch_row($dados)){
    echo (odbc_result($sqlALL,"CODPROD")).'---'.(odbc_result($sqlALL,"REFERENCIA")).'---'.(odbc_result($sqlALL,"DESCRICAO"));
};

// $sqlFICHATECNICAI = "SELECT * FROM FICHATECNICAI WHERE IDFICHATECNICA LIKE '$myInput'";
// $dados = odbc_exec($conn, $sqlFICHATECNICAI)  or die('Erro no sql');

// $sqlVW_PRODUTO = "SELECT CODPROD,REFERENCIA,DESCRICAO FROM VW_PRODUTO";
// $dadosVW_PRODUTO = odbc_exec($conn, $sqlVW_PRODUTO) or die('Erro no sql');
// $myArray = [];
// while(odbc_fetch_row($dadosVW_PRODUTO)){  
//     array_push($myArray, (object)[
//         'codprod' => odbc_result($dadosVW_PRODUTO,"CODPROD"),
//         'referencia' => odbc_result($dadosVW_PRODUTO,"REFERENCIA"),
//         'descricao' => odbc_result($dadosVW_PRODUTO,"DESCRICAO"),
//     ]);
// }
// $prodReferencia = '';
// $prodDescricao = '';

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
                <?php 
                    // for ($c=0; $c<=(count($myArray)-1); $c++){
                    //     if(odbc_result($dados,"CODPROD") === $myArray[$c]->codprod){
                    //         $prodReferencia = $myArray[$c]->referencia;
                    //         $prodDescricao = $myArray[$c]->descricao;
                    //     }
                    // }
                ?>
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