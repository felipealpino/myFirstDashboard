<?php 
// require '../configODBC.php';

function cargaAccessData ($myInput, $selectedValue){
    require '../configODBC.php';
    $sqlAll =   "SELECT CARGA2.CODPEDIDO, CARGA2.CLIENTE, CARGA2.REFERENCIA, CARGA2.DESCRICAO, CARGA2.QUANTIDADE, CARGA2.DATAPENTREGA, CARGA2.CIDADE, CARGA2.STATUS, CARGA2.VENDEDOR
            FROM CARGA2
            -- INNER JOIN FICHATECNICAI
            -- ON CARGA2.CODPROD = FICHATECNICAI.CODPROD
            WHERE ($selectedValue LIKE '%$myInput%')
            ORDER BY DATAPENTREGA ASC";
    $dados = odbc_exec($conn, $sqlAll)  or die('Erro no sql');
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
    $dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');
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

function produtosAccessData($myInput, $radioValue){
    require '../configODBC.php';
    $sqlVW_PRODUTO =   "SELECT VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, VW_PRODUTO.PRECO_CUSTO, VW_PRODUTO.ESTOQUE, PRODUTO.CODFAMILIA, PRODUTO.IDFICHATECNICA 
                    FROM VW_PRODUTO
                    INNER JOIN PRODUTO
                    ON VW_PRODUTO.CODPROD = PRODUTO.CODPROD 
                    WHERE (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR CODPROD LIKE '%$myInput%')
                    ORDER BY ESTOQUE $radioValue ";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO)  or die('Erro no sql');
    return $dados;
}

function producaoAccessData(){
    require 'configODBC.php';
    $sqlMVGERAL = 'SELECT DT_MOVIMENTO,TIPOMOV,CODPROD,QUANTIDADE FROM MVGERAL';
    $dados = odbc_exec($conn, $sqlMVGERAL) or die('Erro no sql');
    return $dados;
}




?>