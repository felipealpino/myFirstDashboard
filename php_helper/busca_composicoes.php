<?php 
require '../config.php';
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

$sqlFICHATECNICAI = "SELECT * FROM FICHATECNICAI WHERE IDFICHATECNICA LIKE '$myInput'";
$dados = odbc_exec($conn, $sqlFICHATECNICAI)  or die('Erro no sql');

$sqlVW_PRODUTO = "SELECT CODPROD,REFERENCIA,DESCRICAO FROM VW_PRODUTO";
$dadosVW_PRODUTO = odbc_exec($conn, $sqlVW_PRODUTO) or die('Erro no sql');
$myArray = [];
while(odbc_fetch_row($dadosVW_PRODUTO)){  
    array_push($myArray, (object)[
        'codprod' => odbc_result($dadosVW_PRODUTO,"CODPROD"),
        'referencia' => odbc_result($dadosVW_PRODUTO,"REFERENCIA"),
        'descricao' => odbc_result($dadosVW_PRODUTO,"DESCRICAO"),
    ]);
}
$prodReferencia = '';
$prodDescricao = '';

?>

<div class="content-table"> 
    <?php if(odbc_fetch_row($dados) > 0){ ?>
    <table class="table sortable table-sm table-bordered table-hover tabela-produtos">
            <thead class="thead_produtos_estoque">
                <tr>
                    <th data-column='ft' data-order='desc'>Ficha Tec</th>
                    <th data-column='cod' data-order='desc'>Código</th>
                    <th data-column='red' data-order='desc'>Referencia</th>
                    <th data-column='descri' data-order='desc'>Descrição</th>
                    <th data-column='custo' data-order='desc'>Custo (R$)</th>
                    <th data-column='estoque' data-order='desc'>Soma</th>
                </tr>
            </thead>

            <tbody id="myTable">
            <?php while(odbc_fetch_row($dados)): ?>
                <?php 
                    for ($c=0; $c<=(count($myArray)-1); $c++){
                        if(odbc_result($dados,"CODPROD") === $myArray[$c]->codprod){
                            $prodReferencia = $myArray[$c]->referencia;
                            $prodDescricao = $myArray[$c]->descricao;
                        }
                    }
                ?>
                <tr>
                    <td> <?=odbc_result($dados,"IDFICHATECNICA")?> </td>
                    <td> <?=odbc_result($dados,"CODPROD")?> </td>
                    <td> <?=$prodReferencia?> </td>
                    <td> <?=$prodDescricao?> </td>
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