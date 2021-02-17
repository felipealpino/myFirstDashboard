<?php
require '../php_controller/UserDaoMysql.php';
session_start();

$UserDao = new UserDaoMysql($pdo);
$isLogged = $UserDao->isLogged($_SESSION['email']);
if(!$isLogged){
    header('Location:/dashboard/MGpiscinas/myFirstDashboard/views/login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../plugins/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/package/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 

    <?php include 'all.php'; ?>

    <div class="right-side-dashboard">    

        <div class="top-dashboard-mobile left-icon">
            <div class="top-dashboard">
                <i class="fas fa-boxes"></i>
                <span>Produtos Estoque</span>
            </div>
            <div class="open-close-mobile">
                <div class="open-close-mobile-icon">
                    <i class="fas fa-align-justify"></i>
                </div>
            </div>
        </div>

        <div class="container-main">
            <div class="header-produtos">
                <div class="header-pagina-produtos">
                    <h2 class="header_texto">Relatório de produtos</h2>
                </div>
                <div class="form-busca-produtos-estoque">
                    <input id="myInput" class="form-control input-busca" autocomplete="off" type="text" placeholder="Buscar referencia ou descrição.." autofocus> 
                    <button id="buscar-produto" class="btn btn-submit-forms">Buscar</button>
                </div>
            </div>
            
            <div class="tabela-produtos" id="dados-tabela-produtos">
                <span class="span-produto-estoque-sem-produto"> Utilize o filtro para localizar os produtos...</span>
                <script>
                    document.getElementById('buscar-produto').addEventListener('click', function(){
                        ascendingAndDescending();
                        buscar($("#myInput").val())
                        
                    }, false);

                    function buscar(myInput){
                        //metodo ajax responsavel pela req
                        $.ajax  ({
                                    //Configurações
                                    type:'POST',    //metodo que está sendo utilizado
                                    dataType: 'html',   //tipo de dado que a página vai retornar
                                    url: '../php_controller/busca_produto_estoque.php',    //pagina que está sendo solicitada
                                    beforeSend: function(){
                                        $("#dados-tabela-produtos").html("Carregando....");
                                    },
                                    data: {myInput: myInput}, //Dados para consulta

                                    //funcao que sera executada quando a solicitação for finalizada.
                                    success: function(msg){
                                        $("#dados-tabela-produtos").html(msg);
                                    },
                                    complete : function () {
                                        ascendingAndDescending();
                                    }        
                                });
                    }
                </script>
            </div>
        </div>

    </div>

    <script src="../plugins/jquery-3.5.1/jquery-3.5.1.js"></script>
    <script src="../plugins/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome5.15.1/js/all.min.js"></script>
    <script src="../js/googleCharts.js"></script>
    <script src="../js/all.js"></script>

</body>
</html>