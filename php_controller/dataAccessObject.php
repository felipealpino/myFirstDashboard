<?php 
// require '../configODBC.php';

function cargaAccessData ($myInput, $selectedValue, $dataInicial, $dataFinal){
    require '../configODBC.php';

    $sqlCARGA2 =   "SELECT CARGA2.CODPEDIDO, CARGA2.CLIENTE, CARGA2.REFERENCIA, CARGA2.DESCRICAO, CARGA2.QUANTIDADE, CARGA2.DATAPENTREGA, CARGA2.CIDADE, CARGA2.STATUS, CARGA2.VENDEDOR
            FROM CARGA2
            WHERE ($selectedValue LIKE '%$myInput%') --AND (CONVERT(varchar(10), DATAPENTREGA, 105) <= $dataInicial AND CONVERT(varchar(10), DATAPENTREGA, 105) >= $dataFinal)
            ORDER BY DATAPENTREGA ASC";
    $dados = odbc_exec($conn, $sqlCARGA2)  or die('Erro no sql');
    return $dados;
}


function valorDevendoCliente(){
    require 'configODBC.php';

    $sqlVW_PRODUTO_ENTREGAI = "SELECT * FROM
                                (SELECT ENTREGAI.CODPROD, ENTREGAI.QUANTIDADE, ENTREGAI.STATUS, VW_PRODUTO.EMP, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, VW_PRODUTO.PRECO_CUSTO
                                FROM ENTREGAI
                                INNER JOIN VW_PRODUTO
                                ON ENTREGAI.CODPROD = VW_PRODUTO.CODPROD)
                                WHERE (EMP LIKE '00' AND STATUS LIKE '01')";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO_ENTREGAI) or die('Erro no sql');
    return $dados;
}


function composicoesAccessData($myInput){
    require '../configODBC.php';
    $sqlVW_PRODUTO =   "SELECT * FROM 
                    (SELECT VW_PRODUTO.EMP, VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, FICHATECNICAI.IDFICHATECNICA, FICHATECNICAI.QUANTIDADE, FICHATECNICAI.PRECOCUSTO, FICHATECNICAI.SOMA
                    FROM VW_PRODUTO
                    INNER JOIN FICHATECNICAI
                    ON VW_PRODUTO.CODPROD = FICHATECNICAI.CODPROD) 
                    WHERE (IDFICHATECNICA LIKE '%$myInput%' AND EMP LIKE '00')";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO) or die('Erro no sql');
    return $dados;
}



function kardexAccessData($myInput){
    require '../configODBC.php';
    // $sqlMVGERAL = "SELECT * FROM MVGERAL WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%') AND EMP LIKE '00'";
    $sqlMVGERAL = "SELECT * FROM 
    (SELECT MVGERAL.CODEMPRESA, MVGERAL.DT_MOVIMENTO, MVGERAL.DOCUMENTO, MVGERAL.CODPROD, MVGERAL.TIPOMOV, MVGERAL.QUANTIDADE,VW_PRODUTO.EMP, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO
    FROM MVGERAL
    INNER JOIN VW_PRODUTO
    ON MVGERAL.CODPROD = VW_PRODUTO.CODPROD) 
    WHERE ((DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR DOCUMENTO LIKE '%$myInput%') AND (CODEMPRESA LIKE '00' AND EMP LIKE '00'))";

    $dados = odbc_exec($conn, $sqlMVGERAL)  or die('Erro no sql');
    return $dados;
}



function produtosAccessData($myInput){
    require '../configODBC.php';
    $myInput = trim($myInput);
    $sqlVW_PRODUTO =   "SELECT VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, VW_PRODUTO.PRECO_CUSTO, VW_PRODUTO.ESTOQUE, PRODUTO.CODFAMILIA, PRODUTO.IDFICHATECNICA 
                    FROM VW_PRODUTO
                    INNER JOIN PRODUTO
                    ON VW_PRODUTO.CODPROD = PRODUTO.CODPROD 
                    WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR CODPROD LIKE '%$myInput%')";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');
    return $dados;
}



function producaoAccessData(){
    require 'configODBC.php';
    $sqlMVGERAL = 'SELECT DT_MOVIMENTO,TIPOMOV,CODPROD,QUANTIDADE FROM MVGERAL ORDER BY DT_MOVIMENTO ASC';
    $dados = odbc_exec($conn, $sqlMVGERAL) or die('Erro no sql');
    return $dados;
}



function vendasAccessData(){
    require 'configODBC.php';
    $sqlENCEFAT = 'SELECT CODVENDEDOR, VLRRECEBER, DT_MOVIMENTO FROM ENCEFAT '; 
    $dados = odbc_exec($conn, $sqlENCEFAT) or die('Erro no sql');
    return $dados;
}


?>