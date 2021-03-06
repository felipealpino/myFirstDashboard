<?php 

/**
 * Query que alimenta aba carga.php
*/
function cargaAccessData ($myInput, $selectedValue, $dataInicial, $dataFinal){
    require '../connections/configODBC.php';
    if($dataInicial === ""){
        $dataInicial = '1970-01-01';
    }
    if($dataFinal === ""){
        $dataFinal = date("Y-m-d");
    }

    $sqlCARGA2 =    "SELECT 
                        CARGA2.CODPEDIDO, CARGA2.CLIENTE, CARGA2.REFERENCIA, CARGA2.DESCRICAO, CARGA2.QUANTIDADE, CARGA2.DATAPENTREGA, CARGA2.CIDADE, CARGA2.STATUS, CARGA2.VENDEDOR
                    FROM 
                        CARGA2
                    WHERE 
                        $selectedValue LIKE '%$myInput%' AND DATAPENTREGA BETWEEN '$dataInicial' AND '$dataFinal'
                    ORDER BY 
                        DATAPENTREGA ASC";
    $dados = odbc_exec($conn, $sqlCARGA2) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta dashboard.php - quantidade que deve para cliente
 */
function relDashValorDevendoCliente(){
    require '../connections/configODBC.php';
    $sqlVW_PRODUTO_ENTREGAI =   "SELECT * FROM
                                (SELECT 
                                    ENTREGAI.CODPROD, ENTREGAI.QUANTIDADE, ENTREGAI.STATUS, VW_PRODUTO.EMP, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, VW_PRODUTO.PRECO_CUSTO
                                FROM 
                                    ENTREGAI
                                INNER JOIN 
                                    VW_PRODUTO
                                ON 
                                    ENTREGAI.CODPROD = VW_PRODUTO.CODPROD)
                                WHERE 
                                    EMP LIKE '00' AND STATUS LIKE '01' ";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO_ENTREGAI) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta dashboard.php - vendas nos ultimos 3 anos daquele mês
 */
function relDashVendasPassadas($mes, $ano){
    require '../connections/configODBC.php';
    $rangeAno = $ano-3;
    $sqlENCEFAT =   "SELECT 
    CODVENDEDOR, VLRRECEBER, DT_MOVIMENTO 
    FROM 
        ENCEFAT 
    WHERE 
        EXTRACT(YEAR FROM DT_MOVIMENTO) <= '$ano' AND EXTRACT(YEAR FROM DT_MOVIMENTO) >= '$rangeAno' AND EXTRACT(MONTH FROM DT_MOVIMENTO) = '$mes' "; 
    $dados = odbc_exec($conn, $sqlENCEFAT) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta dashboard.php - quantidade em estoque por familia
 */
function relDashFamiliaProdutos(){
    require '../connections/configODBC.php';
    $sqlVW_PRODUTO =    "SELECT 
                            VW_PRODUTO.EMP, VW_PRODUTO.CODPROD, VW_PRODUTO.PRECO_CUSTO, VW_PRODUTO.ESTOQUE, PRODUTO.CODFAMILIA 
                        FROM 
                            VW_PRODUTO
                        INNER JOIN 
                            PRODUTO
                        ON 
                            VW_PRODUTO.CODPROD = PRODUTO.CODPROD 
                        WHERE 
                            EMP LIKE '00' ";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO) or die('Erro no sql');
    return $dados;
}


function relDashProducao(){
    require '../connections/configODBC.php';
    
}


/**
 * Query que alimenta composicoes.php
 */
function composicoesAccessData($myInput){
    require '../connections/configODBC.php';
    $sqlVW_PRODUTO =    "SELECT * FROM 
                        (SELECT 
                            VW_PRODUTO.EMP, VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, FICHATECNICAI.IDFICHATECNICA, FICHATECNICAI.QUANTIDADE, FICHATECNICAI.PRECOCUSTO, FICHATECNICAI.SOMA
                        FROM 
                            VW_PRODUTO
                        INNER JOIN 
                            FICHATECNICAI
                        ON 
                            VW_PRODUTO.CODPROD = FICHATECNICAI.CODPROD) 
                        WHERE 
                            IDFICHATECNICA LIKE '%$myInput%' AND EMP LIKE '00' ";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta kardex.php
 */
function kardexAccessData($myInput){
    require '../connections/configODBC.php';
    $sqlMVGERAL =   "SELECT * FROM 
                    (SELECT 
                        MVGERAL.CODEMPRESA, MVGERAL.DT_MOVIMENTO, MVGERAL.DOCUMENTO, MVGERAL.CODPROD, MVGERAL.TIPOMOV, MVGERAL.QUANTIDADE,VW_PRODUTO.EMP, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO
                    FROM 
                        MVGERAL
                    INNER JOIN 
                        VW_PRODUTO
                    ON 
                        MVGERAL.CODPROD = VW_PRODUTO.CODPROD) 
                    WHERE 
                        (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR DOCUMENTO LIKE '%$myInput%') AND (CODEMPRESA LIKE '00' AND EMP LIKE '00')";

    $dados = odbc_exec($conn, $sqlMVGERAL) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta produtos_estoque.php
 */
function produtosAccessData($myInput){
    require '../connections/configODBC.php';
    $myInput = trim($myInput);
    $sqlVW_PRODUTO =    "SELECT 
                            VW_PRODUTO.CODPROD, VW_PRODUTO.REFERENCIA, VW_PRODUTO.DESCRICAO, VW_PRODUTO.PRECO_CUSTO, VW_PRODUTO.ESTOQUE, PRODUTO.CODFAMILIA, PRODUTO.IDFICHATECNICA 
                        FROM 
                            VW_PRODUTO
                        INNER JOIN 
                            PRODUTO
                        ON 
                            VW_PRODUTO.CODPROD = PRODUTO.CODPROD 
                        WHERE 
                            (DESCRICAO LIKE '%$myInput%' OR REFERENCIA LIKE '%$myInput%' OR CODPROD LIKE '%$myInput%') 
                            AND EMP LIKE '00' ";
    $dados = odbc_exec($conn, $sqlVW_PRODUTO) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta producao.php
 */
function producaoAccessData($mes, $ano){
    require '../connections/configODBC.php';
    $sqlMVGERAL =   "SELECT 
                        DT_MOVIMENTO,TIPOMOV,CODPROD,QUANTIDADE 
                    FROM 
                        MVGERAL 
                    WHERE 
                        EXTRACT(MONTH FROM DT_MOVIMENTO) = '$mes' AND EXTRACT(YEAR FROM DT_MOVIMENTO) = '$ano'
                    ORDER BY 
                        DT_MOVIMENTO ASC";
    $dados = odbc_exec($conn, $sqlMVGERAL) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta vendas.php
 */
function vendasAccessData($mes, $ano){
    require '../connections/configODBC.php';
    $sqlENCEFAT =   "SELECT 
                        CODVENDEDOR, VLRRECEBER, DT_MOVIMENTO 
                    FROM 
                        ENCEFAT 
                    WHERE 
                        EXTRACT(MONTH FROM DT_MOVIMENTO) = '$mes' AND EXTRACT(YEAR FROM DT_MOVIMENTO) = '$ano' "; 
    $dados = odbc_exec($conn, $sqlENCEFAT) or die('Erro no sql');
    return $dados;
}



/**
 * Query que alimenta compras.php
 */
function comprasAccessData(){
    require '../connections/configODBC.php';
    $sqlCOMPRAS = "SELECT EMP, TOTAL, DT_ENTRADA FROM COMPRAS";
    $dados = (odbc_exec($conn, $sqlCOMPRAS));
    return $dados;
}


?>