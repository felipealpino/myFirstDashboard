<?php
    $conn = odbc_connect('ATS','SYSDBA','masterkey')
    or die('Falha na Conexão ');

    // $sql = 'select * from VW_PRODUTO';
    // $dados = odbc_exec($conn, $sql)
    //     or die('Erro no sql');

    // while (odbc_fetch_row($dados)) {
    //     echo odbc_result($dados,"REFERENCIA").'<br>' ; 
    // }
?>
