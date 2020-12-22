<?php 
require '../configODBC.php';
// $myInput = filter_input(INPUT_GET,'busca-descricao');
$myInput = $_POST['myInput'];
switch(strlen($myInput)){
    case 1:
        $myInput = "000000000".$myInput; 
        break;
    case 2:
        $myInput = "00000000".$myInput;
        break;
    case 3:
        $myInput = "0000000".$myInput;
        break;
    case 4:
        $myInput = "000000".$myInput;
        break;
    case 5:
        $myInput = "00000".$myInput;
        break;
    case 6:
        $myInput = "0000".$myInput;
        break;
    case 7:
        $myInput = "000".$myInput;
        break;
    case 8:
        $myInput = "00".$myInput;
        break;
    case 9:
        $myInput = "0".$myInput;
        break;
}

$sqlVW_PRODUTO =   "SELECT * FROM 
                   (SELECT VW_PRODUTO.EMP, VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, FICHATECNICAI.IDFICHATECNICA, FICHATECNICAI.QUANTIDADE, FICHATECNICAI.PRECOCUSTO, FICHATECNICAI.SOMA
                    FROM VW_PRODUTO
                    INNER JOIN FICHATECNICAI
                    ON VW_PRODUTO.CODPROD = FICHATECNICAI.CODPROD) 
                    WHERE (IDFICHATECNICA LIKE '%$myInput%' AND EMP LIKE '00')";

$dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');


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